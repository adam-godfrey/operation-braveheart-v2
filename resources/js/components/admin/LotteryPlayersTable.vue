<template>
    <div class="users-style">
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
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="row">
                        <th :class="column.width" v-for="column in columns" :key="column.name" @click="sortBy(column.name)"
                            
                            style="cursor:pointer;">
                           <span :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'">{{column.label}}</span>
                        </th>
                        <th class="col-md-1">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="row" v-for="user in paginatedUsers" :key="user.id">
                        <td class="col-md-2">{{user.name}}</td>
                        <td class="col-md-2">{{user.telephone}}</td>
                        <td class="col-md-2">{{user.email}}</td>
                        <td class="col-md-2">{{user.lottery_number}}</td>
                        <td class="col-md-1">
                            <span class="badge badge-pill badge-primary" v-if="user.draw_type === 'UK'">{{user.draw_type}}</span>
                            <span class="badge badge-pill badge-success" v-else>{{user.draw_type}}</span>
                        </td>
                        <td class="col-md-2">{{user.created_at}}</td>
                        <td class="col-md-1">
                            <a class="btn btn-secondary btn-sm" v-bind:href="'/admin/lottery/players/' + user.id + '/edit'"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="#" @click="deleteUser(user.id)"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
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
                    {{pagination.from}} - {{pagination.to}} of {{filteredUsers.length}}
                    <span v-if="`filteredUsers.length < pagination.total`"></span>
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
    props: {
        result: {
            type: Array
        }
    },
    created() {
        // this.getUsers();
        this.users = this.result;
    },
    data() {
        let sortOrders = {};
        let columns = [
            {label: 'Name', name: 'name', 'width': 'col-md-2'},
            {label: 'Telephone', name: 'telephone', 'width': 'col-md-2'},
            {label: 'Email', name: 'email', 'width': 'col-md-2'},
            {label: 'Lottery Number', name: 'lottery_number', 'width': 'col-md-2'},
            {label: 'Draw Type', name: 'type', 'width': 'col-md-1'},
            {label: 'Date Added', name: 'created_at', 'width': 'col-md-2'},
        ];
        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        
        return {
            users: [],
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
        deleteUser(id) {
            const swalWithBootstrapButtons = this.$swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Delete this player?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    this.$snotify.async('Deleting the lottery player', 'Deleting', () => new Promise((resolve, reject) => {
                        axios.delete(`/admin/lottery/player/${id}/delete`).then(response => {
                            if(response.status === 200) {
                                setTimeout(() => resolve({
                                    title: 'Success!!!',
                                    body: 'Email successfully deleted!',
                                    config: {
                                        timeout: 2000,
                                        closeOnClick: true
                                    }}, 
                                    this.getEmails()
                                ), 2000);
                               
                            }
                        }).catch(error => {
                            if (error.response.status === 422) {
                                setTimeout(() => reject({
                                    title: 'Error!!!',
                                    body: 'There was a problem deleting the email!',
                                    config: {
                                        timeout: 2000,
                                        closeOnClick: true
                                    }},
                                    this.errors = error.response.data.errors || {}
                                ), 1000);
                            }
                        });
                    }));
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // swalWithBootstrapButtons.fire(
                    //     'Cancelled',
                    //     'Your imaginary file is safe :)',
                    //     'error'
                    // )
                }
            });
        },
        
        getUsers() {
            axios.get('/admin/lottery/players/get', {params: this.tableShow})
                .then(response => {
                    this.users = response.data;
                    this.pagination.total = this.users.length;
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
        filteredUsers() {
            let users = this.users;
            if (this.search) {
                users = users.filter((row) => {
                    return Object.keys(row).some((key) => {
                        return String(row[key]).toLowerCase().indexOf(this.search.toLowerCase()) > -1;
                    })
                });
            }
            let sortKey = this.sortKey;
            let order = this.sortOrders[sortKey] || 1;
            if (sortKey) {
                users = users.slice().sort((a, b) => {
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
            return users;
        },
        paginatedUsers() {
            return this.paginate(this.filteredUsers, this.length, this.pagination.currentPage);
        }
    }
};
</script>