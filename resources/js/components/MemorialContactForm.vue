<template>
    <form id="contact-form" @submit.prevent="submit" ref="notice">
        <div class="card mb-4 border-0">
            <div class="notice notice-danger" v-show="errored">
                <strong>Error</strong> There are errors in the form!!
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group floating-label-form-group controls">
                        <label>Contact Name</label>
                        <input type="text" class="form-control" placeholder="Contact Name" id="contact" v-model="fields.contact" v-on:change="contactChange">
                        <div v-if="errors && errors.contact" class="text-danger">{{ errors.contact[0] }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group floating-label-form-group controls">
                        <label>Telephone</label>
                        <input type="tel" class="form-control" placeholder="Telephone (optional)" id="telephone" v-model="fields.telephone" v-on:change="telephoneChange">
                        <div v-if="errors && errors.telephone" class="text-danger">{{ errors.telephone[0] }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group floating-label-form-group controls">
                        <label>Email Address</label>
                        <input type="email" class="form-control" placeholder="Email" id="email" v-model="fields.email" v-on:change="emailChange">
                        <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
                    </div>
                </div>
            </div>
            <AddressForm></AddressForm>
        </div>
    </form>
</template>
<script>
import AddressForm from './AddressForm.vue';
export default {
    data: function() {
        return {
            fields: {
                address1: '',
                address2: '',
                address3: '',
                town: '',
                county: '',
                postcode: '',
                rank: '',
                name: '',
                dob: '',
                dod: '',
                regiment: '',
                location: '',
                message: '',
                confirm: '',
                customer: ''
            },
            errors: {},
            maxCharacters: 100,
            errored: false,
        }
    },
    name: 'MemorialContactForm',
    components: {
        AddressForm,
    },
    mounted() {
        this.$root.$on('checkFormsValid', (customer) => {
            this.errors = {};
            this.fields.customer = customer;
            this.errored = false;

            axios.post('/memorial-garden/send-request', this.fields).then(response => {
                this.$root.$emit('validated', response.data.customer);
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                    this.$root.$emit('errors', this.errors);
                    this.errored = true;
                    
                    this.$nextTick(() => {
                        this.$refs.notice.scrollTop = 0;
                    });
                }
            });
        }),
        this.$root.$on('address1Change', address1 => {
            this.fields.address1 = address1;
        });
        this.$root.$on('address2Change', address2 => {
            this.fields.address2 = address2;
        });
        this.$root.$on('address3Change', address3 => {
            this.fields.address3 = address3;
        });
        this.$root.$on('townChange', town => {
            this.fields.town = town;
        });
        this.$root.$on('countyChange', county => {
            this.fields.county = county;
        });
        this.$root.$on('postcodeChange', postcode => {
            this.fields.postcode = postcode;
        });
        this.$root.$on('rankChange', rank => {
            this.fields.rank = rank;
        });
        this.$root.$on('nameChange', name => {
            this.fields.name = name;
        });
        this.$root.$on('dobChange', dob => {
            this.fields.dob = dob;
        });
        this.$root.$on('dodChange', dod => {
            this.fields.dod = dod;
        });
        this.$root.$on('regimentChange', regiment => {
            this.fields.regiment = regiment;
        });
        this.$root.$on('locationChange', location => {
            this.fields.location = location;
        });
        this.$root.$on('messageChange', message => {
            this.fields.message = message;
        });
        this.$root.$on('confirmChange', confirm => {
            this.fields.confirm = confirm;
        });
    },
    methods: {
        contactChange: function() {
            delete this.errors.contact;
        },
        telephoneChange: function() {
            delete this.errors.telephone;
        },
        emailChange: function() {
            delete this.errors.email;
        }
    }
}
</script>
