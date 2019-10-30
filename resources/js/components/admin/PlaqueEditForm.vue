<template>
    <form id="contact-form" @submit.prevent="submit" ref="notice">
        <div class="card mb-4 border-0">
            <div class="notice notice-danger" v-show="errored">
                <strong>Error</strong> There are errors in the form!!
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-4 col-form-label">Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="contact" v-model="fields.contact" v-on:change="contactChange">
                    <div v-if="errors && errors.contact" class="text-danger">{{ errors.contact[0] }}</div>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-4 col-form-label">Telephone</label>
                <div class="col-sm-8">
                    <input type="tel" class="form-control" id="telephone" v-model="fields.telephone" v-on:change="telephoneChange">
                    <div v-if="errors && errors.telephone" class="text-danger">{{ errors.telephone[0] }}</div>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" v-model="fields.email" v-on:change="emailChange">
                    <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
                </div>
            </div>

 
            <div class="form-group row">
                <label for="inputName" class="col-sm-4 col-form-label">First Address Line</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="address" v-model="fields.address1" v-on:change="address1Change">
                    <div v-if="errors && errors.address1" class="text-danger">{{ errors.address1[0] }}</div>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-4 col-form-label">Second Address Line</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="address2" v-model="fields.address2" v-on:change="address2Change">
                    <div v-if="errors && errors.address2" class="text-danger">{{ errors.address2[0] }}</div>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-4 col-form-label">Third Address Line</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="address3" v-model="fields.address3" v-on:change="address3Change">
                    <div v-if="errors && errors.address3" class="text-danger">{{ errors.address3[0] }}</div>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-4 col-form-label">Town</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="town" v-model="fields.town" v-on:change="townChange">
                    <div v-if="errors && errors.town" class="text-danger">{{ errors.town[0] }}</div>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-4 col-form-label">County</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="address" v-model="fields.county" v-on:change="countyChange">
                    <div v-if="errors && errors.county" class="text-danger">{{ errors.county[0] }}</div>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputName" class="col-sm-4 col-form-label">Postcode</label>
                <div class="col-sm-8 input-group">
                    <input type="text" class="form-control" id="postcode" v-model="fields.postcode" v-on:change="postcodeChange">
                    <div class="input-group-append">
                        <button v-on:click="lookup" class="btn btn-secondary" id="findAddress" :disabled="spin"><i class="fas fa-spinner fa-pulse mr-2" v-show="spin"></i> Find Address</button>
                      </div>
                    <div v-if="errors && errors.postcode" class="text-danger">{{ errors.postcode[0] }}</div>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="offset-sm-4 col-sm-8" v-show="toggle">
                    <div class="select-container">
                    <span class="select-arrow fa fa-chevron-down"></span>
                        <select v-on:change="selectAddress($event)" v-model="address">
                            <option value="">Please select an address</option>
                            <option v-for="(item) in items" :value="item.formatted">{{ item.address }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="plaque" class="metal">
            <div class="screw top left"></div>
            <div class="screw top right"></div>
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control text-right" placeholder="Rank" id="rank" v-model="fields.rank" v-on:change="rankChange">
                    <div v-if="errors && errors.rank" class="text-danger text-right small">{{ errors.rank[0] }}</div>
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Name" id="name" v-model="fields.name" v-on:change="nameChange">
                    <div v-if="errors && errors.name" class="text-danger small">{{ errors.name[0] }}</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <datepicker @selected="dobChange" input-class="form-control text-right" name="fields.dob" placeholder="DOB" v-model="fields.dob" :disabled-dates="disabledDates"></datepicker>
                    <div v-if="errors && errors.dob" class="text-danger text-right small">{{ errors.dob[0] }}</div>
                </div>
                <div class="col">
                    <datepicker @selected="dodChange" input-class="form-control" name="fields.dod" placeholder="DOD" v-model="fields.dod" :disabled-dates="disabledDates"></datepicker>
                    <div v-if="errors && errors.dod" class="text-danger small">{{ errors.dod[0] }}</div>
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control text-center" placeholder="Regiment" id="regiment" v-model="fields.regiment" v-on:change="regimentChange">
                <div v-if="errors && errors.regiment" class="text-danger text-center small">{{ errors.regiment[0] }}</div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control text-center" placeholder="Location of death" id="location" v-model="fields.location" v-on:change="locationChange">
                <div v-if="errors && errors.location" class="text-danger text-center small">{{ errors.location[0] }}</div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control text-center" :maxlength="maxCharacters" placeholder="Message" id="message" v-model="fields.message" v-on:change="messageChange">
                <div v-if="errors && errors.message" class="text-danger text-center small">{{ errors.message[0] }}</div>
                <p class="remaining text-center">You have {{charactersRemaining}} characters remaining.</p>
            </div>
            <div class="screw bottom left"></div>
            <div class="screw bottom right"></div>
        </div>
        <label class="check ">I confirm that the above details are correct
            <input type="checkbox"  name="confirm" v-model="fields.confirm" v-on:change="confirmChange">
            <span class="checkmark"></span>
        </label>
        <div v-if="errors && errors.confirm" class="text-danger small">{{ errors.confirm[0] }}</div>
        <div class="form-group row mt-4">
            <div class="col-sm-8">
                <button type="submit" class="btn btn-secondary">Update Plaque</button>
            </div>
        </div>
    </form>
</template>
<script>
import Datepicker from 'vuejs-datepicker';
export default {
    props: {
        plaque: {
            type: Object
        }
    },
    data: function() {
        return {
            fields: {
                contact: '',
                telephone: '',
                email: '',
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
                customer: '',
            },
            address: '',
            errors: {},
            errored: false,
            dobFormatted: '',
            dodFormatted: '',
            maxCharacters: 35,
            disabledDates: {},
            selected: {},
            items: [],
            toggle: false,
            spin: false,
        }
    },
    name: 'MemorialContactForm',
    components: {
        Datepicker
    },
    mounted() {
        var today = new Date();

        this.disabledDates = {
            from: new Date()
        }
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
        });
    },
    created(){
        this.fields = this.plaque;
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
        contactChange: function() {
            delete this.errors.contact;
        },
        telephoneChange: function() {
            delete this.errors.telephone;
        },
        emailChange: function() {
            delete this.errors.email;
        },
        address1Change: function() {
            delete this.errors.address1;
        },
        address2Change: function() {
            delete this.errors.address2;
        },
        address3Change: function() {
            delete this.errors.address3;
        },
        townChange: function() {
            delete this.errors.town;
        },
        countyChange: function() {
            delete this.errors.county
        },
         postcodeChange: function() {
            delete this.errors.postcode;
        },
        rankChange: function() {
            delete this.errors.rank;
        },
        nameChange: function() {
            delete this.errors.name;
        },
        dobChange: function() {
            this.$nextTick(() => {
                delete this.errors.dob;
                this.$root.$emit('dobChange', this.fields.dob.getFullYear() + '-' + ("0" + (this.fields.dob.getMonth()+1)).slice(-2) + '-' + ("0" + this.fields.dob.getDate()).slice(-2))
            });
        },
        dodChange: function() {
            this.$nextTick(() => {
                delete this.errors.dod;
                this.$root.$emit('dodChange', this.fields.dod.getFullYear() + '-' + ("0" + (this.fields.dod.getMonth()+1)).slice(-2) + '-' + ("0" + this.fields.dod.getDate()).slice(-2))
            });
        },
        regimentChange: function() {
            delete this.errors.regiment;
        },
        locationChange: function() {
            delete this.errors.location;
        },
        messageChange: function() {
            delete this.errors.message;
        },
        confirmChange: function(event) {
            delete this.errors.confirm;
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
                this.spin = false;
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                    this.spin = false;
                }
            });
        },
        selectAddress: function(event) {
            var parsedObj = JSON.parse(event.target.value);
   
            this.fields.address1 = parsedObj[0];
            this.fields.address2 = parsedObj[1];
            this.fields.address3 = parsedObj[2];
            this.fields.town = parsedObj[3];
            this.fields.county = parsedObj[4];

            delete this.errors.postcode;
        },
        submit: function() {
            const swalWithBootstrapButtons = this.$swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-secondary',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Update plaque?',
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.value) {

                    let results = [];

                    this.$snotify.async('Updating plaque', 'Updating', () => new Promise((resolve, reject) => {
                        axios.put('/admin/memorial-garden/plaque-orders/update', this.fields).then(response => {
                            if(response.status === 200) {
                                setTimeout(() => resolve({
                                    title: 'Success!!!',
                                    body: 'Plaque updated!',
                                    config: {
                                        timeout: 2000,
                                        closeOnClick: true
                                    }}, 
                                    window.location.href = '/admin/memorial-garden/plaque-orders'
                                ), 2000);
                               
                            }
                        }).catch(error => {
                            if (error.response.status === 422) {
                                setTimeout(() => reject({
                                    title: 'Error!!!',
                                    body: 'Plaque failed to update!',
                                    config: {
                                        timeout: 2000,
                                        closeOnClick: true
                                    }},
                                    this.errors = error.response.data.errors || {},
                                    console.log(this.errors)
                                ), 1000);
                            }
                        });
                    }));                    
                }
            });
        },
    },
    computed: {
        charactersRemaining: function () {
            return this.maxCharacters - this.fields.message.length;
        }
    }
}
</script>
