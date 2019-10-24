requirejs.config({
    shim: {
        form: {
            deps: [ 'stripe' ]
        },
        stripe: {
            exports: 'Stripe',
        }
    },
    paths: {
    	'stripe': 'https://js.stripe.com/v3/?noext',
        'form': '/js/memorial-garden-form'
    }
});

require(['stripe', 'form'], function($) { 
    return {};
});