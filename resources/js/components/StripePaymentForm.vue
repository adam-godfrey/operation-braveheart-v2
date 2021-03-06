<template>
    <form id="payment-form" ref="form" action="/checkout" method="POST" class="uk-padding">
        <input type="hidden" name="_token" :value="csrf">
        <div class="uk-margin uk-text-center">
            <p class="stripeError" v-if="stripeError">
                {{stripeError}}
            </p>
        </div>
        <div id="card-background">
            <div class="row">
                <div class="col">
                    <label class="uk-form-label" for="Card Number">
                        Card Number
                    </label>
                </div>
                <div class="col-md-4">
                    <div class="ccards lazy"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="uk-form-controls">
                        <div id="card-number" class="uk-input" :class="{ 'uk-form-danger': cardNumberError }"></div>
                        <span class="help-block" v-if="cardNumberError">
                            {{cardNumberError}}
                        </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label class="uk-form-label" for="Expiry Month">
                        Expiry
                    </label>
                    <div class="uk-form-controls">
                        <div id="card-expiry" class="uk-input" :class="{ 'uk-form-danger': cardExpiryError }"></div>
                        <span class="help-block" v-if="cardExpiryError">
                            {{cardExpiryError}}
                        </span>
                    </div>
                </div>
                <div class="col">
                    <label class="uk-form-label" for="Card CVC">
                        Card CVC
                    </label>
                    <div class="uk-form-controls">
                        <div id="card-cvc" class="uk-input" :class="{ 'uk-form-danger': cardCvcError }"></div>
                        <span class="help-block" v-if="cardCvcError">
                            {{cardCvcError}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary btn-block" @click.prevent="okToSend()">
            Pay Now £{{ cost }}
        </button>
    </form>
</template>

<script>
    export default {
        props: ['cost'],
        data() {
            return {
                csrf: document.head.querySelector('meta[name="csrf-token"]').content,
                card: {
                    cvc: '',
                    number: '',
                    expiry: ''
                },
                //elements
                cardNumber: '',
                cardExpiry: '',
                cardCvc: '',
                stripe: null,
                tokenId: '',

                // errors
                stripeError: '',
                cardCvcError: '',
                cardExpiryError: '',
                cardNumberError: '',

                customer: '',
                apikey: process.env.MIX_STRIPE_KEY,
                loading: false,
            }
        },
        mounted() {
            this.setUpStripe();
            this.$root.$on('validated', (customer) => {
                this.customer = customer;
                this.submitFormToCreateToken();
            })
        },
        methods: {
            setUpStripe() {
                if (window.Stripe === undefined) {
                    alert('Stripe V3 library not loaded!');
                } else {
                    const stripe = window.Stripe(this.apikey);
                    this.stripe = stripe;

                    const elements = stripe.elements();
                    this.cardCvc = elements.create('cardCvc');
                    this.cardExpiry = elements.create('cardExpiry');
                    this.cardNumber = elements.create('cardNumber');

                    this.cardCvc.mount('#card-cvc');
                    this.cardExpiry.mount('#card-expiry');
                    this.cardNumber.mount('#card-number');

                    this.listenForErrors();
                }
            },

            listenForErrors() {
                const vm = this;

                this.cardNumber.addEventListener('change', (event) => {
                    vm.toggleError(event);
                    vm.cardNumberError = ''
                    vm.card.number = event.complete ? true : false
                });
                
                this.cardExpiry.addEventListener('change', (event) => {
                    vm.toggleError(event);
                    vm.cardExpiryError = ''
                    vm.card.expiry = event.complete ? true : false
                });
        
                this.cardCvc.addEventListener('change', (event) => {
                    vm.toggleError(event);
                    vm.cardCvcError = ''
                    vm.card.cvc = event.complete ? true : false
                });
            },

            toggleError (event) {
                if (event.error) {
                    this.stripeError = event.error.message;
                } else {
                    this.stripeError = '';
                }
            },

            submitFormToCreateToken() {
                this.clearCardErrors();
                let valid = true;

                if (!this.card.number) {
                    valid = false;
                    this.cardNumberError = "Card Number is Required";
                }
                if (!this.card.cvc) {
                    valid = false;
                    this.cardCvcError = "CVC is Required";
                }
                if (!this.card.expiry) {
                    valid = false;
                    this.cardExpiryError = "Month is Required";
                }
                if (this.stripeError) {
                    valid = false;
                }
                if (valid) {
                    this.createToken()
                }
            },

            createToken() {
                this.stripe.createToken(this.cardNumber).then((result) => {
                    if (result.error) {
                        this.stripeError = result.error.message;
                    } else {
                        const token = result.token.id

                        this.stripeTokenHandler(token);
                        //send the token to your server
                        //clear the inputs
                    }
                })
            },

            stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server

                // var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token);
                this.$el.appendChild(hiddenInput);

                // var form = document.getElementById('payment-form');
                hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'customer');
                hiddenInput.setAttribute('value', this.customer);
                this.$el.appendChild(hiddenInput);

                // Submit the form
                this.$el.submit();
            },

            clearElementsInputs() {
                this.cardCvc.clear()
                this.cardExpiry.clear()
                this.cardNumber.clear()
            },

            clearCardErrors() {
                this.stripeError = ''
                this.cardCvcError = ''
                this.cardExpiryError = ''
                this.cardNumberError = ''
            },
            reset() {
                this.clearElementsInputs()
                this.clearCardErrors()
            },
            okToSend: function() {
                this.$root.$emit('checkFormsValid', this.customer)
            }
        }
    }
</script>
