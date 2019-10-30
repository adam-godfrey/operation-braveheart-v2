<template>
    <div class="News-style">
    	<div class="row justify-content-between">
		    <div class="col-4">
		      	<div class="select-container">
		            <label class="dropdown">
		                <select v-model="length" @change="resetPagination()">
		                    <option value="10">10</option>
		                    <option value="20">20</option>
		                    <option value="30">30</option>
		                </select>
		            </label>
		        </div>
		    </div>
		    <div class="col-3">
		      	<div class="form-group">
		      		<input class="form-control" type="text" v-model="search" placeholder="Search..." @input="resetPagination()">
		      	</div>
		    </div>
		</div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th v-for="column in columns" :key="column.name" @click="sortBy(column.name)"
                        
                        style="width: 40%; cursor:pointer;">
                       <span :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'">{{column.label}}</span>
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="News in paginatedNews" :key="News.id">
                    <td>{{News.title}}</td>
                    <td>{{News.subtitle}}</td>
                    <td>{{News.created_at}}</td>
                    <td><a class="btn btn-danger btn-sm" href="#" @click="deleteNews(News.id)">Remove</a></td>
                </tr>
            </tbody>
        </table>
        <div>
            <nav class="pagination" v-if="!tableShow.showdata">
                <span class="page-stats">{{pagination.from}} - {{pagination.to}} of {{pagination.total}}</span>
                <a v-if="pagination.prevPageUrl" class="btn btn-sm btn-secondary pagination-previous" @click="--pagination.currentPage">
                    Prev
                </a>
                <a class="btn btn-sm btn-secondary pagination-previous" v-else disabled>
                Prev
                </a>
                <a v-if="pagination.nextPageUrl" class="btn btn-sm pagination-next" @click="++pagination.currentPage">
                    Next
                </a>
                <a class="btn btn-sm btn-secondary pagination-next" v-else disabled>
                    Next
                </a>
            </nav>
            <nav class="pagination" v-else>
                <span class="page-stats">
                    {{pagination.from}} - {{pagination.to}} of {{filteredNews.length}}
                    <span v-if="`filteredNews.length < pagination.total`"></span>
                </span>
                <a v-if="pagination.prevPage" class="btn btn-sm btn-secondary pagination-previous" @click="--pagination.currentPage">
                    Prev
                </a>
                <a class="btn btn-sm pagination-previous btn-secondary" v-else disabled>
                Prev
                </a>
                <a v-if="pagination.nextPage" class="btn btn-sm btn-secondary pagination-next" @click="++pagination.currentPage">
                    Next
                </a>
                <a class="btn btn-sm pagination-next btn-secondary"  v-else disabled>
                    Next
                </a>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    created() {
        this.getNews();
        Fire.$on('reloadNews', () => {
            this.getNews();
        })
    },
    data() {
        let sortOrders = {};
        let columns = [
            {label: 'Title', name: 'title' },
            {label: 'Subtitle', name: 'subtitle' },
            {label: 'Date Added', name: 'created_at'},
        ];
        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        
        return {
            News: [],
            columns: columns,
            sortKey: 'created_at',
            sortOrders: sortOrders,
            length: 10,
            search: '',
            tableShow: {
                showdata: true,
            },
            pagination: {
                currentPage: 1,
                total: '',
                nextPage: '',
                prevPage: '',
                from: '',
                to: ''
            },
        }
    },
    methods: {
        // deleteNews(id) {
        //     axios.delete(`/News/${id}/delete`).then(() => {
        //         Fire.$emit('reloadNews')
        //         swal(
        //             'Success!',
        //             'News deleted',
        //             'success'
        //         )
        //     }).catch(() => {
        //         swal('Failed', 'There was something wrong', 'warning');
        //     });
        // },
        deleteNews(id){
            swal({
                title: 'Delete this News Articke?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete(`/news/${id}/delete`).then(()=>{
                            Fire.$emit('reloadNews')
                                swal(
                                'Deleted!',
                                'News Deleted.',
                                'success'
                                )
                            Fire.$emit('AfterCreate');
                        }).catch(()=> {
                            swal("Failed!", "There was something wronge.", "warning");
                        });
                    }
                })
        },
        
        getNews() {
            axios.get('/admin/news/aticles/', {params: this.tableShow})
                .then(response => {
                    this.News = response.data;
                    this.pagination.total = this.News.length;
                })
                .catch(errors => {
                });
        },
        paginate(array, length, pageNumber) {
            this.pagination.from = array.length ? ((pageNumber - 1) * length) + 1 : ' ';
            this.pagination.to = pageNumber * length > array.length ? array.length : pageNumber * length;
            this.pagination.prevPage = pageNumber > 1 ? pageNumber : '';
            this.pagination.nextPage = array.length > this.pagination.to ? pageNumber + 1 : '';
            return array.slice((pageNumber - 1) * length, pageNumber * length);
        },
        resetPagination() {
            this.pagination.currentPage = 1;
            this.pagination.prevPage = '';
            this.pagination.nextPage = '';
        },
        sortBy(key) {
            this.resetPagination();
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },
    },
    computed: {
        filteredNews() {
            let News = this.News;
            if (this.search) {
                News = News.filter((row) => {
                    return Object.keys(row).some((key) => {
                        return String(row[key]).toLowerCase().indexOf(this.search.toLowerCase()) > -1;
                    })
                });
            }
            let sortKey = this.sortKey;
            let order = this.sortOrders[sortKey] || 1;
            if (sortKey) {
                News = News.slice().sort((a, b) => {
                    let index = this.getIndex(this.columns, 'name', sortKey);
                    a = String(a[sortKey]).toLowerCase();
                    b = String(b[sortKey]).toLowerCase();
                    if (this.columns[index].type && this.columns[index].type === 'date') {
                        return (a === b ? 0 : new Date(a).getTime() > new Date(b).getTime() ? 1 : -1) * order;
                    } else if (this.columns[index].type && this.columns[index].type === 'number') {
                        return (+a === +b ? 0 : +a > +b ? 1 : -1) * order;
                    } else {
                        return (a === b ? 0 : a > b ? 1 : -1) * order;
                    }
                });
            }
            return News;
        },
        paginatedNews() {
            return this.paginate(this.filteredNews, this.length, this.pagination.currentPage);
        }
    }
};
</script>