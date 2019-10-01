<template>
    <div>
        <div class="row">
            <div class="col">
                <div class="form-group floating-label-form-group controls">
                    <label>Postcode</label>
                    <input type="text" class="form-control" placeholder="Postcode" id="postcode" v-model="fields.postcode">
                    <div v-if="errors && errors.postcode" class="text-danger">{{ errors.postcode[0] }}</div>
                </div>
            </div>
            <div class="col-sm-auto pt-3 pr-4">
                <button v-on:click="lookup" class="btn btn-primary mr-1" id="findAddress">Find Address</button>
            </div>
        </div>
        <div class="col-sm-12" v-show="toggle">
            <div id="address-list">
                <div v-for="(item, i) in items" :data-address="item.address" v-on:click="emitToParent($event, i)">{{ item.address }}</div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            address: '',
            fields: {
                postcode: '',
            },
            errors: {},
            items: [],
            addresses: [],
            toggle: false
        }
    },
    name: 'AddressLookup',
    methods: {
        // Define the method that emits data to the parent as the first parameter to `$emit()`.
        // This is referenced in the <template> call in the parent. The second parameter is the payload.
        emitToParent: function(event, i) {
            this.address = event.target.dataset.address;
            this.$emit('populateAddress', this.addresses[i]);
            this.items = [];
            this.addresses = [];
            this.toggle = false;

        },
        lookup: function(e) {
            e.preventDefault();

            this.errors = {};
            var $this = this;

            axios.post('/postcode-lookup', {house: this.fields.house, postcode: this.fields.postcode}).then(response => {
                response.data.addresses.forEach(function (item) {
                    $this.items.push({
                        address: item.formatted_address.filter(function(el) { return el; }).join(', ')
                    });

                    var parsedobj = JSON.parse(JSON.stringify(item.formatted_address));

                    $this.addresses.push({
                        address1: parsedobj[0],
                        address2: parsedobj[1],
                        address3: parsedobj[2],
                        town: parsedobj[3],
                        county: parsedobj[4]
                    });
                });

                this.toggle = true;
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                }
            });
        }
    }
}
</script>
