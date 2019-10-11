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
        },
        selected: {
            type: Number,
        }
    },
    data () {
        return {
            test: this.options,
            lotteryNumber: ''
        }
    },
    name: 'custom-select',
    components: {
        'v-select': vSelect
    },
    methods: {

    },
    created(){
        this.lotteryNumber = this.selected ? this.selected : '';
    },
    watch:{
        'lotteryNumber': function () {
            this.$emit('changed', this.lotteryNumber)
        }
    },
};
</script>