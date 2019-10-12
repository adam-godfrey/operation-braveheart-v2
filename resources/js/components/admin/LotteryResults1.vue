<template>
	<form @submit.prevent="submit" class="mb-5">
		<h2>{{ draw_type }} Lottery Draw</h2>
		<div class="row">
			<div class="col-md-3">
				<div class="card lottery">
					<div class="lottery-number" :class="colour">
					   <div class="box">
					        {{ first }}
					    </div>
					</div>
		            <div class="card-body text-center">
		                <h5 class="card-title">&pound;50</h5>
		                <div class="form-group">
		                	<input type="text" class="form-control" placeholder="1st Prize" maxlength="2" data-prize="first" v-model="first" v-on:blur="getWinner">
		                </div>
		            </div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card lottery">
					<div class="lottery-number" :class="colour">
					   <div class="box">
					        {{ second }}
					    </div>
					</div>
		            <div class="card-body text-center">
		                <h5 class="card-title">&pound;30</h5>
		                <div class="form-group">
		                	<input type="text" class="form-control" placeholder="2nd Prize" maxlength="2" data-prize="second" v-model="second" v-on:blur="getWinner">
		                </div>
		            </div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card lottery">
					<div class="lottery-number" :class="colour">
					   <div class="box">
					        {{ third }}
					    </div>
					</div>
		            <div class="card-body text-center">
		                <h5 class="card-title">&pound;20</h5>
		                <div class="form-group">
		                	<input type="text" class="form-control" placeholder="3rd Prize" maxlength="2" data-prize="third" v-model="third" v-on:blur="getWinner">
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
			<tr>
				<td>&pound;50</td>
				<td>{{ first }}</td>
				<td>{{ prizes.first.name }}</td>
				<td>{{ prizes.first.telephone }}</td>
			</tr>
			<tr>
				<td>&pound;30</td>
				<td>{{ second }}</td>
				<td>{{ prizes.second.name }}</td>
				<td>{{ prizes.second.telephone }}</td>
			</tr>
			<tr>
				<td>&pound;20</td>
				<td>{{ third }}</td>
				<td>{{ prizes.third.name }}</td>
				<td>{{ prizes.third.telephone }}</td>
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
</template>
<script>

export default {
	props: [
		'colour',
		'draw_type'
	],
	data: function() {
		return {
			first: '',
			second: '',
			third: '',
			fourth: '',
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
};
</script>