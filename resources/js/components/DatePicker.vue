<template>
	<datepicker :input-class="style" v-model="fieldname" :placeholder="label"></datepicker>
</template> 
<script>

	import Datepicker from 'vuejs-datepicker';

	export default {
	  	name: 'DatePicker',
	  	props: [
	      	'classname',
	      	'name',
	      	'placeholder'
	  	],
	  	data: function() {
   			return {
   				style: this.classname,
   				fieldname: this.name,
   				label: this.placeholder
   			};
  		},
	  	components: {
	    	Datepicker
	  	},
	  	mounted: function() {
	  		console.log(this.className);
	  	}
	}
</script>