<template>
	<form>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group row">
					<label for="inputName" class="col-sm-3 col-form-label">Name</label>
					<div class="col-sm-9">
						<input type="email" class="form-control" id="inputName" placeholder="Name">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
					<div class="col-sm-9">
						<input type="email" class="form-control" id="inputEmail" placeholder="Email">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputTelephone" class="col-sm-3 col-form-label">Telephone</label>
					<div class="col-sm-9">
						<input type="telephone" class="form-control" id="inputTelephone" placeholder="Telephone">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputNumber" class="col-sm-3 col-form-label">Lottery Number</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="inputNumber" placeholder="Lottery Number" v-model="number" maxlength="2">
					</div>
				</div>
				<fieldset class="form-group">
					<div class="row">
						<legend class="col-form-label col-sm-3 pt-0">Draw Type</legend>
						<div class="col-sm-9">
							<div class="form-check">
				  				<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="UK" v-model="type" v-on:change="changeType" checked>
				  				<label class="form-check-label badge badge-pill badge-primary " for="gridRadios1">
				   					UK
				  				</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="Local" v-model="type" v-on:change="changeType">
								<label class="form-check-label badge badge-pill badge-success" for="gridRadios2">
							    	Local
							  	</label>
							</div>
						</div>
					</div>
				</fieldset>
				<div class="form-group row">
					<div class="col-sm-9">
						<button type="submit" class="btn btn-primary">Create Player</button>
					</div>
				</div>
			</div>
			<div class="col-md-3 ml-4">
				<div class="form-group row">
					<div class="col-sm-6">
						<div class="lottery-number" :class="colour">
						   <div class="box"><!-- flex item -->
						        {{ number }}
						    </div>
						</div>
		            </div>
		        </div>
		    </div>
		</div>

		
	</form>
</template>
<script>
export default {
    data () {
        return {
        	colour: 'blue',
        	type: '',
        	number: '',
        }
    },
    methods: {
        changeType() {
        	this.colour = this.type === 'UK' ? 'blue' : 'green';
        }
    }
};
</script>