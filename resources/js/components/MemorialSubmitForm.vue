<template>
    <form @submit.prevent="submit">
        <div class="card">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <div class="form-group floating-label-form-group controls">
                            <label>Contact Name</label>
                            <input type="text" class="form-control" placeholder="Contact Name" id="contact" v-model="fields.contact">
                            <div v-if="errors && errors.contact" class="text-danger">{{ errors.contact[0] }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group floating-label-form-group controls">
                            <label>Telephone</label>
                            <input type="tel" class="form-control" placeholder="Telephone (optional)" id="telephone" v-model="fields.telephone">
                            <div v-if="errors && errors.telephone" class="text-danger">{{ errors.telephone[0] }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group floating-label-form-group controls">
                            <label>Email Address</label>
                            <input type="email" class="form-control" placeholder="Email" id="email" v-model="fields.email">
                            <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group floating-label-form-group controls">
                            <label>First Address Line</label>
                            <input type="text" class="form-control" placeholder="First Address Line" id="address" v-model="fields.address1">
                            <div v-if="errors && errors.address1" class="text-danger">{{ errors.address1[0] }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group floating-label-form-group controls">
                            <label>Second Address Line</label>
                            <input type="text" class="form-control" placeholder="Second Address Line" id="address2" v-model="fields.address2">
                            <div v-if="errors && errors.address2" class="text-danger">{{ errors.address2[0] }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group floating-label-form-group controls">
                            <label>Third Address Line</label>
                            <input type="text" class="form-control" placeholder="Third Address Line" id="address3" v-model="fields.address3">
                            <div v-if="errors && errors.address3" class="text-danger">{{ errors.address3[0] }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group floating-label-form-group controls">
                            <label>Town</label>
                            <input type="text" class="form-control" placeholder="Town" id="town" v-model="fields.town">
                            <div v-if="errors && errors.town" class="text-danger">{{ errors.town[0] }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group floating-label-form-group controls">
                            <label>County</label>
                            <input type="text" class="form-control" placeholder="County" id="address" v-model="fields.county">
                            <div v-if="errors && errors.county" class="text-danger">{{ errors.county[0] }}</div>
                        </div>
                    </div>
                </div>
                <AddressLookup v-on:populateAddress="getAddress"></AddressLookup>
            </div>
        </div>
        <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam inventore aspernatur repellendus incidunt adipisci modi voluptates recusandae iste eligendi, repudiandae corporis quod aut, optio! Explicabo quaerat unde voluptatem! Itaque, eum!</p>
        <div id="plaque">
            <div class="screw top left"></div>
            <div class="screw top right"></div>
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control text-right" placeholder="Rank" id="rank" v-model="fields.rank">
                    <div v-if="errors && errors.rank" class="text-danger">{{ errors.rank[0] }}</div>
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Loved One's Name" id="name" v-model="fields.name">
                    <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control text-right" placeholder="DOB" id="dob" v-model="fields.dob">
                    <div v-if="errors && errors.dob" class="text-danger">{{ errors.dob[0] }}</div>
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="DOD" id="dod" v-model="fields.dod">
                    <div v-if="errors && errors.dod" class="text-danger">{{ errors.dod[0] }}</div>
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control text-center" placeholder="Regiment" id="regiment" v-model="fields.regiment">
                <div v-if="errors && errors.regiment" class="text-danger">{{ errors.regiment[0] }}</div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control text-center" placeholder="Location of death" id="location" v-model="fields.location">
                <div v-if="errors && errors.location" class="text-danger">{{ errors.location[0] }}</div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control text-center" :maxlength="maxCharacters" placeholder="Message" id="message" v-model="fields.message">
                <div v-if="errors && errors.message" class="text-danger">{{ errors.message[0] }}</div>
                <p class="remaining text-center">You have {{charactersRemaining}} characters remaining.</p>
            </div>
            <div class="screw bottom left"></div>
            <div class="screw bottom right"></div>
        </div>
        <div id="success"></div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" id="sendMessageButton">Send</button>
        </div>
    </form>
</template>
<script>
import AddressLookup from './AddressLookup.vue'
export default {
    data: function() {
        return {
            fields: {
                address1: '',
                address2: '',
                address3: '',
                town: '',
                county: '',
                message: ''
            },
            errors: {},
            maxCharacters: 100,
        }
    },
    name: 'about',
    components: {
        AddressLookup
    },
    methods: {
        getAddress: function(value) {
            this.fields.address1 = value.address1
            this.fields.address2 = value.address2
            this.fields.address3 = value.address3
            this.fields.town = value.town
            this.fields.county = value.county
        },
        submit: function() {
            this.errors = {};
            axios.post('/memorial-garden/send-request', this.fields).then(response => {
                alert('Message sent!');
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
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
