<template>
	<form @submit.prevent="submit">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group row">
					<label for="inputName" class="col-sm-4 col-form-label">Name</label>
					<div class="col-sm-8">
						<input type="name" class="form-control" id="inputName" placeholder="Name" v-model="player.name">
						 <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="inputEmail" class="col-sm-4 col-form-label">Email</label>
					<div class="col-sm-8">
						<input type="email" class="form-control" id="inputEmail" placeholder="Email" v-model="player.email">
						 <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="inputTelephone" class="col-sm-4 col-form-label">Telephone</label>
					<div class="col-sm-8">
						<input type="telephone" class="form-control" id="inputTelephone" placeholder="Telephone" v-model="player.telephone">
						 <div v-if="errors && errors.telephone" class="text-danger">{{ errors.telephone[0] }}</div>
					</div>
				</div>
				<fieldset class="form-group">
					<div class="row">
						<legend class="col-form-label col-sm-4 pt-0">Draw Type</legend>
						<div class="col-sm-8">
							<div class="form-check">
				  				<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="UK" v-model="player.draw_type" v-on:change="changeType">
				  				<label class="form-check-label badge badge-pill badge-primary " for="gridRadios1">
				   					UK
				  				</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="Local" v-model="player.draw_type" v-on:change="changeType">
								<label class="form-check-label badge badge-pill badge-success" for="gridRadios2">
							    	Local
							  	</label>
							</div>
							 <div v-if="errors && errors.draw_type" class="text-danger">{{ errors.draw_type[0] }}</div>
						</div>
					</div>
				</fieldset>
				<div class="form-group row">
					<label for="inputNumber" class="col-sm-4 col-form-label">Lottery Number</label>
					<div class="col-sm-8">
						<custom-select v-bind:options="options" v-bind:selected="player.lottery_number" @changed="getNumber"></custom-select>
						 <div v-if="errors && errors.lottery_number" class="text-danger">{{ errors.lottery_number[0] }}</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-8">
						<button type="submit" class="btn btn-primary">
						<span v-if="this.action === 'add'">Create Player</span>
						<span v-else>Update Player</span>
						</button>
					</div>
				</div>
			</div>
			<div class="col-md-3 ml-4">
				<div class="form-group row">
					<div class="col-sm-6">
						<div class="lottery-number" :class="colour">
						   <div class="box">
						        {{ player.lottery_number }}
						    </div>
						</div>
		            </div>
		        </div>
		    </div>
		</div>
	</form>
</template>
<script>
import CustomSelect from './CustomSelect.vue'
export default {
	props: {
		action: {
			type: String
		},
		result: {
			type: Object
		}
	},
    data: function () {
        return {
        	colour: 'green',
        	options: [],
        	player: {
        		name: '',
        		email: '',
        		telephone: '',
        		draw_type: 'Local',
        		lottery_number: ''
        	},
        	errors: {},
        }
    },
    components: {
        CustomSelect
    },
    methods: {
        changeType: function() {
        	this.colour = this.player.draw_type === 'UK' ? 'blue' : 'green';
        	this.getAvilableNumbers();
        },
        getNumber: function(value) {
        	this.player.lottery_number = value;
        },
        getAvilableNumbers: function() {
        	var $this = this;

        	axios.post('/admin/lottery/available-numbers', {draw_type: this.player.draw_type, player_id: this.player.id}).then(response => {
   				this.data = response.data.data;
				this.data.forEach(function(item) {
					$this.options.push(item);
				});

   				// $this.options = response.data.data;
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                }
            });
        },
        submit: function() {
            this.errors = {};
            let $this = this;

            const swalWithBootstrapButtons = this.$swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Save this player?',
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.value) {
                    if(this.action === 'add') {
		            	this.$snotify.async('Saving the lottery player', 'Saving', () => new Promise((resolve, reject) => {
		            		axios.post('/admin/lottery/players', this.player).then(response => {
			            		if(response.status === 200) {
			            			setTimeout(() => resolve({
							       	 	title: 'Success!!!',
							        	body: 'Lottery player created!',
							        	config: {
							        		timeout: 2000,
							          		closeOnClick: true
							       	 	}}, 
							       	 	window.location.href = '/admin/lottery/players'
							      	), 2000);
					               
					            }
				            }).catch(error => {
				                if (error.response.status === 422) {
				                	setTimeout(() => reject({
						       	 		title: 'Error!!!',
							        	body: 'Lottery player failed to create!',
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
		            else {
		            	this.$snotify.async('Saving the lottery player', 'Saving', () => new Promise((resolve, reject) => {
		            		axios.put('/admin/lottery/players/' + this.player.id, this.player).then(response => {
			            		if(response.status === 200) {
			            			setTimeout(() => resolve({
							       	 	title: 'Success!!!',
							        	body: 'Lottery player updated!',
							        	config: {
							        		timeout: 2000,
							          		closeOnClick: true
							       	 	}}, 
							       	 	window.location.href = '/admin/lottery/players'
							      	), 2000);
					               
					            }
				            }).catch(error => {
				                if (error.response.status === 422) {
				                	setTimeout(() => reject({
						       	 		title: 'Error!!!',
							        	body: 'Lottery player failed to update!',
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
              	}
            });

            
        },
        getChangeDataResponse: function() {
        	let status = true;
        	return status;
        }
    },
    created(){
  		if(this.action === 'edit'){
    		this.player = this.result;
    		this.changeType();
  		}
  	},
    mounted() {

    }
};
</script>