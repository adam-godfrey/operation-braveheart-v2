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
            <div class="col-4">
                <div>
                    <label class="dropdown">
                        <select v-model="selectedDate" @change="getPaidPlayers($event.target)">
                            <option v-for="(date, index) in dates" :key="index" :value="date.draw_date">{{ date.formattedDate }}</option>
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
                           <span :class="sortKey === column.name ? (sortPlayers[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'">{{column.label}}</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="row" v-for="(player, i) in paginatedPlayers" :key="player.id">
                        <td class="col-md-5">{{player.name}}</td>
                        <td class="col-md-3">
                            <span class="badge badge-pill badge-primary" v-if="player.draw_type === 'UK'">{{player.draw_type}}</span>
                            <span class="badge badge-pill badge-success" v-else>{{player.draw_type}}</span>
                        </td>
                        <td class="col-md-4">
                            <toggle-button 
                                :value="player.paid"
                                :sync="true"
                                :labels="{checked: 'Paid', unchecked: 'Unpaid'}" 
                                v-model="player.paid"
                                :color="{checked: '#858796', unchecked: '#e74a3b', disabled: '#CCCCCC'}"
                                :width="65"
                                :key="i"
                                @change="updateStatus(player.id)">
                            </toggle-button>
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
                    {{pagination.from}} - {{pagination.to}} of {{filteredPlayers.length}}
                    <span v-if="`filteredPlayers.length < pagination.total`"></span>
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
            type: Object
        },
        dates: {
            type: Array
        }
    },
    created() {
        this.players =  Object.keys(this.result).map(item => this.result[item]);
    },
    data() {
        let sortPlayers = {};
        let columns = [
            {label: 'Name', name: 'name', 'width': 'col-md-5'},
            {label: 'Draw Type', name: 'telephone', 'width': 'col-md-3'},
            {label: 'Status', name: 'status', 'width': 'col-md-4'},
        ];
        columns.forEach((column) => {
           sortPlayers[column.name] = -1;
        });
        
        return {
            players: [],
            draw_dates: this.dates,
            columns: columns,
            sortKey: 'name',
            sortPlayers: sortPlayers,
            length: 10,
            search: '',
            tableShow: {
                showdata: true,
                draw_date: ''
            },
            pagination: {
                currentPage: 1,
                total: '',
                nextPage: '',
                prevPage: '',
                from: '',
                to: ''
            },
            selectedDate: ''
        }
    },
    mounted() {
        this.selectedDate = this.draw_dates[0].draw_date
    },
    methods: {
        updateStatus(index) {
            axios.put(`/admin/lottery/players/update-paid`, {player: this.players.find(x => x.id === index), date: this.selectedDate}).then(response => {
                if(response.status === 200) {
                    this.$root.$emit('chart-update', response.data);                
                }
            }).catch(error => {
                if (error.response.status === 422) {
                    
                }
            }); 
        },
        getPaidPlayers(event) {
            this.tableShow.draw_date = this.selectedDate;
            axios.get('/admin/lottery/players/paid', {params: this.tableShow })
                .then(response => {
                    this.players = response.data;
                    this.pagination.total = this.players.length;
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
            this.sortPlayers[key] = this.sortPlayers[key] * -1;
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },
    },
    computed: {
        filteredPlayers() {
            let players = this.players;
            if (this.search) {
                players = players.filter((row) => {
                    return Object.keys(row).some((key) => {
                        return String(row[key]).toLowerCase().indexOf(this.search.toLowerCase()) > -1;
                    })
                });
            }
            let sortKey = this.sortKey;
            let order = this.sortPlayers[sortKey] || 1;
            if (sortKey) {
                players = players.slice().sort((a, b) => {
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
            return players;
        },
        paginatedPlayers() {
            return this.paginate(this.filteredPlayers, this.length, this.pagination.currentPage);
        }
    }
};
</script>