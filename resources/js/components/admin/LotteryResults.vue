<template>
	<div class="row">
		<div :class="settings.length === 3 ? 'col-md-6' : 'col-md-7'" class="mx-auto">
			<form @submit.prevent="submit" class="mb-5">
				<h3>{{ draw_type }} Lottery Draw - {{ draw_date }}</h3>
				<hr>
				<div class="row">
					<div :class="settings.length === 3 ? 'col-md-4' : 'col-md-3'" v-for="(setting, index) in settings">
						<p class="text-center font-weight-bold">{{setting.abbr}}</p>
						<div class="card lottery">
							<div class="lottery-number" :class="colour">
							   <div class="box">
							        {{ setting.number }}
							    </div>
							</div>
				            <div class="card-body text-center">
				                <h5 class="card-title font-weight-bold">&pound;{{ setting.value }}</h5>
				                <div class="form-group">
				                	<input type="text" class="form-control" :placeholder="setting.abbr" :maxlength="settings.length === 3 ? '2' : '3'" :data-prize="setting.prize" v-model="setting.number" v-on:blur="getWinner">
				                	<!-- <div v-if="errors && errors.results[index].winner" class="text-danger">{{ errors.results[index].winner }}</div> -->
				                </div>
				            </div>
						</div>
					</div>
				</div>
				<table class="table table-striped">
					<tr>
						<th>Prize</th>
						<th>Number</th>
						<th>Name</th>
						<th>Telephone</th>
					</tr>
					<tr v-for="(setting, index) in settings" :key="index">
						<td>&pound;{{ setting.value }}</td>
						<td>{{ setting.number }}</td>
						<td>{{ prizes[setting.prize].name }}</td>
						<td>{{ prizes[setting.prize].telephone }}</td>
					</tr>
				</table>
				<div class="form-group row">
					<div class="col-sm-8">
						<button type="submit" class="btn btn-secondary">
							Save Results
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</template>
<script>

export default {
	props: {
    	settings: {
      		type: Array,
      		default: () => []
    	},
    	winners: {
      		type: Object,
      		default: () => []
    	},
    	colour: String,
    	draw_type: String,
    	draw_date: String
 	},
	data: function() {
		return {
			// prizes: {
			// 	first: {
			// 		name: '',
			// 		telephone: ''
			// 	},
			// 	second: {
			// 		name: '',
			// 		telephone: ''
			// 	},
			// 	third: {
			// 		name: '',
			// 		telephone: ''
			// 	},
			// 	fourth: {
			// 		name: '',
			// 		telephone: ''
			// 	}
			// },
			prizes: this.winners,
			errors: {},
		}
	},
	mounted() {
		console.log(this.prizes);
	},
	methods: {
        getWinner: function(event) {
        	let number = event.target.value;
        	let prize = event.target.getAttribute('data-prize');

        	if(number.length > 0) {
        		var $this = this;

	        	axios.post('/admin/lottery/get-winner', {number: number, draw_type: this.draw_type}).then(response => {
	   				this.data = response.data.data;

	   				$this.prizes[prize].name = this.data !== null ? this.data.name : 'No Winner';
	   				$this.prizes[prize].telephone = this.data !== null ? this.data.telephone : 'No Winner';
	            }).catch(error => {
	                if (error.response.status === 422) {
	                    this.errors = error.response.data.errors || {};

	                    this.$snotify.error('Failed to get winner', 'Error', {
							timeout: 2000,
							showProgressBar: false,
							closeOnClick: true,
							pauseOnHover: true
						});
	                }
	            });
        	}
        },
        submit: function() {
        	const swalWithBootstrapButtons = this.$swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-secondary',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Save lottery results?',
                text: this.draw_type,
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.value) {

                	let results = [];

                	this.settings.forEach(function(item) {
		        		results.push({
		        			prize: item.prize,
		        			winner: item.number
		        		});
		        	});

	            	this.$snotify.async('Saving lottery results', 'Saving', () => new Promise((resolve, reject) => {
	            		axios.post('/admin/lottery/draw/save', {draw_type: this.draw_type, draw_date: this.draw_date, results: results}).then(response => {
		            		if(response.status === 200) {
		            			setTimeout(() => resolve({
						       	 	title: 'Success!!!',
						        	body: 'Lottery results saved!',
						        	config: {
						        		timeout: 2000,
						          		closeOnClick: true
						       	 	}}, 
						       	 	window.location.href = '/admin/lottery'
						      	), 2000);
				               
				            }
			            }).catch(error => {
			                if (error.response.status === 422) {
			                	setTimeout(() => reject({
					       	 		title: 'Error!!!',
						        	body: 'Lottery failed to save!',
						        	config: {
						        		timeout: 2000,
						          		closeOnClick: true
						       	 	}},
						       	 	this.errors = error.response.data.errors || {},
						       	 	console.log(this.errors)
					      		), 1000);
			                }
			            });
				    }));		            
              	}
            });
        },
    },
    // computed: {
    // 	settings: function() {
    // 		return JSON.parse(this.data);
    // 	}
    // }
};
</script>