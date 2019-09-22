<template>
    <div v-html="html" v-on:click="go()">
    
    </div>
</template>
 
<script>
export default {
    props: [
        'url',
        'html'
    ],
    mounted () {
        // Do something useful with the data in the template
        console.log(this.url)
    },
    methods: {
        go: function() {
            window.location.href = this.url;    
        },
    },
}
</script>