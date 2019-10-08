<template>
    <div>
        <v-select :options="test" v-model="lotteryNumber"></v-select>
    </div>
</template>
<script>
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
export default {
    props: { 
        options: {
            type: Array
        }
    },
    data () {
        return {
            test: this.options,
            selected: '',
            lotteryNumber: ''
        }
    },
    name: 'custom-select',
    components: {
        'v-select': vSelect
    },
    methods: {

    },
    watch:{
        'lotteryNumber': function () {
            console.log(this.lotteryNumber);
            this.$emit('changed', this.lotteryNumber)
        }
    },
};
</script>