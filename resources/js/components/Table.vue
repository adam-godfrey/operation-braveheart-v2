<template>
	<div>
		<DataTable :header-fields="headerFields" :data="data" />
	</div>
</template>
<script>
import { DataTable } from 'v-datatable-light'

export default {
	props: [
		headerFields,
		data,
	],
	name: 'admin-table',
	data() {
    	return {
      		headerFields: '',
      		data: '',
    	}
  	},
  	components: {
    	DataTable
  	}
}
</script>