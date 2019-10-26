<template>
	<div>
		<div class="row">
			<div class="col">
				<form action="javascript:void(0)" @submit.prevent="uploadSubmit" enctype="multipart/form-data" method="post">
					<input type="file" class="file" ref="file" name="file" @change="fileUpload($event.target)" accept="video/*">
					<div class="input-group mb-3">
				      	<div class="input-group-prepend">
				        	<span class="input-group-text" id="basic-addon1"><i class="fas fa-paperclip"></i></span>
				      	</div>
				      	<input type="text" class="form-control" v-model="file.name" disabled placeholder="Upload File" aria-label="Upload File" aria-describedby="basic-addon1">
				      	<div class="input-group-append">
				        	<button class="browse input-group-text btn btn-primary" type="button" @click="$refs.file.click()"><i class="fas fa-search mr-2"></i> Browse</button>
				        	<button class="upload input-group-text btn btn-primary" type="button" @click="uploadSubmit"><i class="fas fa-upload mr-2"></i> {{ isLoading ? 'Loading...':'Upload' }}</button>
				      	</div>
				    </div>
				</form>
				<div class="progress"> 
					<div class="progress-bar" role="progressbar" :style="{width: progressBar + '%'}" :aria-valuenow="progressBar" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col">
				<h3 class="h4 mb-3 text-gray-800">Preview</h3>
				<video width="100%" controls ref="video">
		   			<source src="/api/stream-video" type="video/mp4">
		    		Your browser does not support HTML5 video.
				</video>
			</div>
		</div>
	</div>
</template> 
<script> 
	import axios from 'axios'
	export default {
		name: 'UploadForm',
		data() { 
			return { 
				progressBar: 0,
				message: '', 
				isLoading: false, 
				file: '', 
				files: [],
			}
		}, 
		created() { 

		}, 
		methods: {
			fileUpload(event) { 
				this.file = event.files[0];
			}, 
			uploadSubmit() {
				const swalWithBootstrapButtons = this.$swal.mixin({
	                customClass: {
	                    confirmButton: 'btn btn-primary',
	                    cancelButton: 'btn btn-secondary'
	                },
	                buttonsStyling: false
	            });

	            swalWithBootstrapButtons.fire({
	                title: 'Upload lottery video?',
	                type: 'warning',
	                showCloseButton: true,
	                showCancelButton: true,
	                confirmButtonText: 'OK',
	                cancelButtonText: 'Cancel',
	            }).then((result) => {
	                if (result.value) {

	                	this.isLoading = true;
						this.message = '';

		            	this.$snotify.async('Uploading video', 'Uploading', () => new Promise((resolve, reject) => {

							let formData = new FormData(); 

							formData.append('file', this.file); 

							axios.post('/api/upload', formData, { headers: { 'Content-Type': 'multipart/form-data' }, 
								onUploadProgress: function( progressEvent ) { 
									this.progressBar = parseInt(Math.round((progressEvent.loaded * 100) / progressEvent.total)) 
								}.bind(this)})
							.then((response) => {
								if(response.status === 200) {
			            			setTimeout(() => resolve({
							       	 	title: 'Success!!!',
							        	body: 'Lottery video uploaded!',
							        	config: {
							        		timeout: 2000,
							          		closeOnClick: true
							       	 	}},
							       	 	this.message = response.data,
										this.isLoading = false,
										this.$refs.video.load(),
										this.reset(),
							      	), 2000);
					            }
							}).catch(error => {
				                if (error.response.status === 422) {
				                	setTimeout(() => reject({
						       	 		title: 'Error!!!',
							        	body: 'Failed to upload video!',
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
			}, //RESET FORM UPLOAD 
			reset() { 
				this.$refs.file.value = '';
				this.progressBar = 0; 
			}
		} 
	} 
</script>