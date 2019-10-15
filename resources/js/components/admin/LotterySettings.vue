<template>
	<div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">Current Draw</label>
			<div class="col-sm-8">
				<div class="input-group mb-3">
					<div class="col negative-margin">
						<datepicker @selected="drawChange" input-class="form-control" placeholder="Draw Date" v-model="draw_date" :disabled-dates="disabledDates"></datepicker>
					</div>
					<div class="input-group-append">
    					<button class="btn btn-outline-secondary" type="button" v-on:click="newDraw">New Draw</button>
  					</div>
				</div>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">Winning Numbers</label>
			<div class="col-sm-8">
				<div class="form-group row">
					<div class="input-group col">
						<div class="input-group-prepend">
							<span class="input-group-text" id="">UK Draw</span>
						</div>
						<input type="number" min="1" max="4" class="form-control" v-model="uk_winners">
						<div class="input-group-prepend input-group-append">
							<span class="input-group-text" id="">Local Draw</span>
						</div>
						<input type="number" min="1" max="4" class="form-control" v-model="local_winners">
						<div class="input-group-append">
	    					<button class="btn btn-outline-secondary" type="button" v-on:click="winningNumbers">Update</button>
	  					</div>
					</div>
				</div>		
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">UK Lottery Balls</label>
			<div class="col-sm-8">
				<div class="input-group mb-3">
  					<input type="text" class="form-control" v-model="uk_ball_count" readonly>
  					<select ref="extra" class="custom-select" id="inputGroupSelect01" v-model="uk_extra_balls">
					    <option value="0">Add more...</option>
					    <option value="1">One</option>
					    <option value="2">Two</option>
					    <option value="3">Three</option>
					    <option value="4">Four</option>
					    <option value="5">Five</option>
					</select>
  					<div class="input-group-append">
    					<button class="btn btn-outline-secondary" type="button" data-type="UK" v-on:click="lotteryBalls">Update</button>
  					</div>
				</div>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">Local Lottery Balls</label>
			<div class="col-sm-8">
				<div class="input-group mb-3">
  					<input type="text" class="form-control" v-model="local_ball_count" readonly>
  					<select ref="extra" class="custom-select" id="inputGroupSelect01" v-model="local_extra_balls">
					    <option value="0">Add more...</option>
					    <option value="1">One</option>
					    <option value="2">Two</option>
					    <option value="3">Three</option>
					    <option value="4">Four</option>
					    <option value="5">Five</option>
					</select>
  					<div class="input-group-append">
    					<button class="btn btn-outline-secondary" type="button" data-type="Local" v-on:click="lotteryBalls">Update</button>
  					</div>
				</div>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-4 col-form-label">Prizes</label>
			<div class="col-sm-8">
				<div class="row">
					<div class="col">
						<div class="card">
							<div class="card-header">
							    <b>UK Draw</b>
							</div>
							<div class="card-body">
								<div class="form-group row">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="">First</span>
										</div>
										<input type="number" min="1" max="4" class="form-control" v-model="prizes.uk.first">
									</div>
								</div>
								<div class="form-group row">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="">Second</span>
										</div>
										<input type="number" min="1" max="4" class="form-control" v-model="prizes.uk.second">
									</div>
								</div>
								<div class="form-group row">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="">Third</span>
										</div>
										<input type="number" min="1" max="4" class="form-control" v-model="prizes.uk.third">
									</div>
								</div>
								<div class="form-group row" v-show="uk_winners == 4">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="">Fourth</span>
										</div>
										<input type="number" min="1" max="4" class="form-control" v-model="prizes.uk.fourth">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card">
							<div class="card-header">
							    <b>Local Draw</b>
							</div>
							<div class="card-body">
								<div class="form-group row">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="">First</span>
										</div>
										<input type="number" min="1" max="4" class="form-control" v-model="prizes.local.first">
									</div>
								</div>
								<div class="form-group row">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="">Second</span>
										</div>
										<input type="number" min="1" max="4" class="form-control" v-model="prizes.local.second">
									</div>
								</div>
								<div class="form-group row">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="">Third</span>
										</div>
										<input type="number" min="1" max="4" class="form-control" v-model="prizes.local.third">
									</div>
								</div>
								<div class="form-group row" v-show="local_winners == 4">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="">Fourth</span>
										</div>
										<input type="number" min="1" max="4" class="form-control" v-model="prizes.local.fourth">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<button class="btn btn-outline-secondary float-right" type="button" v-on:click="updatePrizes">Update</button>				
			</div>
		</div>
	</div>
</template>
<script>

import Datepicker from 'vuejs-datepicker';

export default {
	props: ['settings'],
	data: function() {
		return {
			draw_date: new Date(Date.parse(this.settings.draw_date.replace('-','/','g'))),
			uk_winners: this.settings.uk_winners,
			local_winners: this.settings.local_winners,
			uk_ball_count: this.settings.uk_ball_count,
			local_ball_count: this.settings.local_ball_count,
			uk_extra_balls: 0,
			local_extra_balls: 0,
			disabledDates: {},
			draw_date_formatted: '',
			prizes: {
				uk: {
					first: this.settings.uk_first_prize,
					second: this.settings.uk_second_prize,
					third: this.settings.uk_third_prize,
					fourth: this.settings.uk_fourth_prize
				},
				local: {
					first: this.settings.local_first_prize,
					second: this.settings.local_second_prize,
					third: this.settings.local_third_prize,
					fourth: this.settings.local_fourth_prize
				}
			},
			errors: {}
		}
	},
	components: {
    	Datepicker
  	},
	methods: {
		drawChange: function() {
			this.$nextTick(() => {
				this.draw_date_formatted = this.draw_date.getFullYear() + '-' + ("0" + (this.draw_date.getMonth()+1)).slice(-2) + '-' + ("0" + this.draw_date.getDate()).slice(-2);
				
	  		});
		},
        newDraw: function() {
        	let $this = this;

        	const swalWithBootstrapButtons = this.$swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Update next draw date?',
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.value) {
	            	this.$snotify.async('Updating next draw date', 'Updating', () => new Promise((resolve, reject) => {

	            		let update = {
	            			draw_date: this.draw_date_formatted,
	            		}

	            		axios.put('/admin/lottery/update-draw-date', update).then(response => {
		            		if(response.status === 200) {
		            			setTimeout(() => resolve({
						       	 	title: 'Success!!!',
						        	body: 'Draw date updated!',
						        	config: {
						        		timeout: 2000,
						          		closeOnClick: true
						       	 	}}
						      	), 2000);
				            }
			            }).catch(error => {
			                if (error.response.status === 422) {
			                	setTimeout(() => reject({
					       	 		title: 'Error!!!',
						        	body: 'Failed to update draw date!',
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
        winningNumbers: function() {
        	let $this = this;

        	const swalWithBootstrapButtons = this.$swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Update total winning numbers?',
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.value) {
	            	this.$snotify.async('Updating total winning numbers', 'Updating', () => new Promise((resolve, reject) => {

	            		let update = {
	            			uk_total: parseInt(this.uk_winners),
	            			local_total: parseInt(this.local_winners),
	            		}

	            		axios.put('/admin/lottery/update-total-winners', update).then(response => {
		            		if(response.status === 200) {
		            			setTimeout(() => resolve({
						       	 	title: 'Success!!!',
						        	body: 'Total winners updated!',
						        	config: {
						        		timeout: 2000,
						          		closeOnClick: true
						       	 	}}
						      	), 2000);
				            }
			            }).catch(error => {
			                if (error.response.status === 422) {
			                	setTimeout(() => reject({
					       	 		title: 'Error!!!',
						        	body: 'Failed to update total winners!',
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
        lotteryBalls: function() {
        	let $this = this;
        	let type = event.target.getAttribute('data-type');
        	let extra_balls = type === 'UK' ? this.uk_extra_balls : this.local_extra_balls;

        	if(extra_balls > 0) {
        		const swalWithBootstrapButtons = this.$swal.mixin({
	                customClass: {
	                    confirmButton: 'btn btn-primary',
	                    cancelButton: 'btn btn-secondary'
	                },
	                buttonsStyling: false
	            });

	            swalWithBootstrapButtons.fire({
	                title: 'Add lottery numbers?',
	                text: type + ' draw',
	                type: 'warning',
	                showCloseButton: true,
	                showCancelButton: true,
	                confirmButtonText: 'OK',
	                cancelButtonText: 'Cancel',
	            }).then((result) => {
	                if (result.value) {
		            	this.$snotify.async('Adding lottery numbers', 'Updating', () => new Promise((resolve, reject) => {

		            		let current_total = type === 'UK' ? this.uk_ball_count : this.local_ball_count;
		            		let update = {
		            			new_total: parseInt(current_total) + parseInt(extra_balls),
		            			type: type
		            		}

		            		axios.put('/admin/lottery/additional-numbers', update).then(response => {
			            		if(response.status === 200) {
			            			setTimeout(() => resolve({
							       	 	title: 'Success!!!',
							        	body: 'Lottery numbers added!',
							        	config: {
							        		timeout: 2000,
							          		closeOnClick: true
							       	 	}}
							      	), 2000);

							      	if(type === 'UK') {
							      		$this.uk_ball_count = update.new_total;
							      	}
							      	else {
							      		$this.local_ball_count = update.new_total;
							      	}

							      	$this.uk_extra_balls = 0;
									$this.local_extra_balls = 0;
					            }
				            }).catch(error => {
				                if (error.response.status === 422) {
				                	setTimeout(() => reject({
						       	 		title: 'Error!!!',
							        	body: 'Failed to add lottery numbers!',
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
        	}
        },
        updatePrizes: function() {

    		const swalWithBootstrapButtons = this.$swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Update prizes?',
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.value) {
	            	this.$snotify.async('Saving prizes', 'Saving', () => new Promise((resolve, reject) => {

	            		let update = {
	            			uk_first_prize: this.prizes.uk.first,
	            			uk_second_prize: this.prizes.uk.second,
	            			uk_third_prize: this.prizes.uk.third,
	            			uk_fourth_prize: this.prizes.uk.fourth,
	            			local_first_prize: this.prizes.local.first,
	            			local_second_prize: this.prizes.local.second,
	            			local_third_prize: this.prizes.local.third,
	            			local_fourth_prize: this.prizes.local.fourth,
	            		}

	            		axios.put('/admin/lottery/update-prizes', update).then(response => {
		            		if(response.status === 200) {
		            			setTimeout(() => resolve({
						       	 	title: 'Success!!!',
						        	body: 'Lottery prizes updated!',
						        	config: {
						        		timeout: 2000,
						          		closeOnClick: true
						       	 	}}
						      	), 2000);
				            }
			            }).catch(error => {
			                if (error.response.status === 422) {
			                	setTimeout(() => reject({
					       	 		title: 'Error!!!',
						        	body: 'Failed to update lottery prizes!',
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
        }
    },
    mounted() {
    	var prev_date = new Date();

		this.disabledDates = {
    		to: new Date(prev_date.setDate(prev_date.getDate() - 1))
    	}
    }
};
</script>