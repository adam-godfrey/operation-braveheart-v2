<template>
	<div class="row">
		<div :class="settings.length === 3 ? 'col-md-6' : 'col-md-7'" class="mx-auto">
			<form @submit.prevent="submit" class="mb-5">
				<h3>{{ draw_type }} Lottery Draw - {{ draw_date }}</h3>
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
						<button type="submit" class="btn btn-primary">
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
    	colour: String,
    	draw_type: String,
    	draw_date: String
  },
	data: function() {
		return {
			prizes: {
				first: {
					name: '',
					telephone: ''
				},
				second: {
					name: '',
					telephone: ''
				},
				third: {
					name: '',
					telephone: ''
				},
				fourth: {
					name: '',
					telephone: ''
				}
			}
		}
	},
	mounted() {
		
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
        	this.$snotify.async('Saving lottery results', 'Saving', () => new Promise((resolve, reject) => {

        		let test = true;

        		if(test) {
        			setTimeout(() => resolve({
			       	 	title: 'Success!!!',
			        	body: 'Lottery results saved!',
			        	config: {
			        		timeout: 2000,
			          		closeOnClick: true
			       	 	}}, 
			      	), 2000);
        		}
        		else {
        			setTimeout(() => reject({
		       	 		title: 'Error!!!',
			        	body: 'Failed to save lottery results!',
			        	config: {
			        		timeout: 2000,
			          		closeOnClick: true
			       	 	}},
		      		), 2000);
        		}
		    }));
        },
    },
    // computed: {
    // 	settings: function() {
    // 		return JSON.parse(this.data);
    // 	}
    // }
};
</script>