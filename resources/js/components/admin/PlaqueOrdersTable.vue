<template>
    <div class="orders-style">
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
                    <tr class="row" v-for="order in paginatedorders" :key="order.id">
                        <td class="col-md-1">{{order.order.orderid}}</td>
                        <td class="col-md-2">{{order.contact}}</td>
                        <td class="col-md-2">{{order.telephone}}</td>
                        <td class="col-md-2">{{order.email}}</td>
                        <td class="col-md-1">{{order.postcode}}</td>
                        <td class="col-md-2">{{order.created_at}}</td>
                        <td class="col-md-1">{{order.order.status}}</td>
                        <td class="col-md-1">
                            <a class="btn btn-secondary btn-sm" v-bind:href="'/admin/memorial-garden/plaque-orders/' + order.id + '/edit'"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-success btn-sm" href="#" @click="sendToEngraver(order.id)"><i class="fa fa-hammer"></i></a>
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
                    {{pagination.from}} - {{pagination.to}} of {{filteredorders.length}}
                    <span v-if="`filteredorders.length < pagination.total`"></span>
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
        this.orders = this.result;
    },
    data() {
        let sortOrders = {};
        let columns = [
            {label: 'Order ID', name: 'type', 'width': 'col-md-1'},
            {label: 'Name', name: 'name', 'width': 'col-md-2'},
            {label: 'Telephone', name: 'telephone', 'width': 'col-md-2'},
            {label: 'Email', name: 'email', 'width': 'col-md-2'},
            {label: 'Postcode', name: 'postcode', 'width': 'col-md-1'},
            {label: 'Date Added', name: 'created_at', 'width': 'col-md-2'},
            {label: 'Status', name: 'status', 'width': 'col-md-1'},
        ];
        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        
        return {
            orders: [],
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
        sendToEngraver(id) {

            console.log(id)
            const swalWithBootstrapButtons = this.$swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Send to engraver?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, send!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    this.$snotify.async('Sending the plaque to engraver', 'Sending', () => new Promise((resolve, reject) => {
                        axios.post(`/admin/memorial-garden/plaque-orders/send`, {id: id}).then(response => {
                            if(response.status === 200) {
                                setTimeout(() => resolve({
                                    title: 'Success!!!',
                                    body: 'Plaque successfully sent!',
                                    config: {
                                        timeout: 2000,
                                        closeOnClick: true
                                    }}, 
                                ), 2000);
                               
                            }
                        }).catch(error => {
                            if (error.response.status === 422) {
                                setTimeout(() => reject({
                                    title: 'Error!!!',
                                    body: 'There was a problem sending the plaque!',
                                    config: {
                                        timeout: 2000,
                                        closeOnClick: true
                                    }},
                                    this.errors = error.response.data.errors || {}
                                ), 1000);
                            }
                        });
                    }));
                }
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
        filteredorders() {
            let orders = this.orders;
            if (this.search) {
                orders = orders.filter((row) => {
                    return Object.keys(row).some((key) => {
                        return String(row[key]).toLowerCase().indexOf(this.search.toLowerCase()) > -1;
                    })
                });
            }
            let sortKey = this.sortKey;
            let order = this.sortOrders[sortKey] || 1;
            if (sortKey) {
                orders = orders.slice().sort((a, b) => {
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
            return orders;
        },
        paginatedorders() {
            return this.paginate(this.filteredorders, this.length, this.pagination.currentPage);
        }
    }
};
</script>