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
    methods: {
        go: function() {
            window.location.href = this.url;    
        },
    },
}
</script>