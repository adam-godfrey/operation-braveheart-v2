requirejs.config({
    shim: {
        form: {
            deps: [ 'stripe' ]
        }
    },
    paths: {
    	stripe: 'https://js.stripe.com/v3/',
        form: '/js/memorial-garden-form'
    }
});

require(['stripe', 'form'], function($) { 
    return {};
});