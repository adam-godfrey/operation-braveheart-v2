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
                <button v-on:click="lookup" class="btn btn-primary mr-1" id="findAddress"> <i class="fas fa-spinner fa-pulse" v-show="spin"></i>Find Address</button>
            </div>
        </div>
        <div class="col-sm-12" v-show="toggle">
            <div class="select-container">
                <span class="select-arrow fa fa-chevron-down"></span>
                <select v-on:change="emitToParent($event)" v-model="address">
                    <option value="">Please select an address</option>
                    <option v-for="(item) in items" :value="item.formatted">{{ item.address }}</option>
                </select>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            address: '',
            selected: {},
            fields: {
                postcode: '',
            },
            errors: {},
            items: [],
            toggle: false,
            spin: false,
        }
    },
    name: 'AddressLookup',
    methods: {
        // Define the method that emits data to the parent as the first parameter to `$emit()`.
        // This is referenced in the <template> call in the parent. The second parameter is the payload.
        emitToParent: function(event) {
            var parsedObj = JSON.parse(event.target.value);

            this.selected = {
                address1: parsedObj[0],
                address2: parsedObj[1],
                address3: parsedObj[2],
                town: parsedObj[3],
                county: parsedObj[4]
            };

            this.$emit('populateAddress', this.selected);
        },
        lookup: function(e) {
            e.preventDefault();

            this.errors = {};
            this.items = [];
            this.spin = true;

            var $this = this;

            axios.post('/postcode-lookup', {postcode: this.fields.postcode}).then(response => {
                response.data.addresses.forEach(function (item) {
                    $this.items.push({
                        formatted: JSON.stringify(item.formatted_address),
                        address: item.formatted_address.filter(function(el) { return el; }).join(', ')
                    });
                });

                this.toggle = true;
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                }
            });

            this.spin = false;
        }
    }
}
</script>
