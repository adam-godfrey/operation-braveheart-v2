<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="form-group floating-label-form-group controls">
                    <label>First Address Line</label>
                    <input type="text" class="form-control" placeholder="First Address Line" id="address" v-model="fields.address1" v-on:change="address1Change">
                    <div v-if="errors && errors.address1" class="text-danger">{{ errors.address1[0] }}</div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group floating-label-form-group controls">
                    <label>Second Address Line</label>
                    <input type="text" class="form-control" placeholder="Second Address Line" id="address2" v-model="fields.address2" v-on:change="address2Change">
                    <div v-if="errors && errors.address2" class="text-danger">{{ errors.address2[0] }}</div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group floating-label-form-group controls">
                    <label>Third Address Line</label>
                    <input type="text" class="form-control" placeholder="Third Address Line" id="address3" v-model="fields.address3" v-on:change="address3Change">
                    <div v-if="errors && errors.address3" class="text-danger">{{ errors.address3[0] }}</div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group floating-label-form-group controls">
                    <label>Town</label>
                    <input type="text" class="form-control" placeholder="Town" id="town" v-model="fields.town" v-on:change="townChange">
                    <div v-if="errors && errors.town" class="text-danger">{{ errors.town[0] }}</div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group floating-label-form-group controls">
                    <label>County</label>
                    <input type="text" class="form-control" placeholder="County" id="address" v-model="fields.county" v-on:change="countyChange">
                    <div v-if="errors && errors.county" class="text-danger">{{ errors.county[0] }}</div>
                </div>
            </div>
        </div>
        <AddressLookup v-on:populateAddress="getAddress"></AddressLookup>
    </div>
</template>
<script>
import AddressLookup from './AddressLookup.vue';
export default {
    props: ['address1'],
    data() {
        return {
            fields: {
                address1: '',
                address2: '',
                address3: '',
                town: '',
                county: '',
            },
            errors: {},
        }
    },
    name: 'AddressForm',
    components: {
        AddressLookup
    },
    methods: {
        getAddress: function(value) {
            this.fields.address1 = value.address1;
            this.fields.address2 = value.address2;
            this.fields.address3 = value.address3;
            this.fields.town = value.town;
            this.fields.county = value.county;

            this.address1Change();
            this.address2Change();
            this.address3Change();
            this.townChange();
            this.countyChange();
        },
        address1Change: function() {
            delete this.errors.address1;
            this.$root.$emit('address1Change', this.fields.address1);
        },
        address2Change: function() {
            delete this.errors.address2;
            this.$root.$emit('address2Change', this.fields.address2);
        },
        address3Change: function() {
            delete this.errors.address3;
            this.$root.$emit('address3Change', this.fields.address3);
        },
        townChange: function() {
            delete this.errors.town;
            this.$root.$emit('townChange', this.fields.town);
        },
        countyChange: function() {
            delete this.errors.county
            this.$root.$emit('countyChange', this.fields.county);
        },
    },
    mounted() {
        this.$root.$on('errors', errors => {
            this.errors = errors;
        });
    },
}
</script>
