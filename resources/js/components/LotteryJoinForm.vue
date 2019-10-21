<template>
    <form @submit.prevent="submit">
        <div class="card mb-4 border-0">
            <div class="notice notice-success" v-show="success">
                <strong>Success</strong> Lottery registration successful!!
            </div>
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

            <div class="row mt-4">
                <div class="col-auto">
                    I would like to join the:
                </div>
                <div class="col">
                    <label for="uk" class="check ">UK lottery
                        <input type="checkbox" id="uk" value="UK" v-model="fields.lotteries" v-on:change="checkboxChange">
                        <span class="checkmark"></span>
                    </label>
                    <label for="local" class="check ">Local lottery
                        <input type="checkbox" id="local" value="Local" v-model="fields.lotteries" v-on:change="checkboxChange">
                        <span class="checkmark"></span>
                    </label>
                    <div v-if="errors && errors.lotteries" class="text-danger small">{{ errors.lotteries[0] }}</div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 col-md-10 col-lg-8 mx-auto text-center">
                    <button type="submit" class="btn btn-primary" id="joinLotteryButton" :disabled="isSending">Join Today</button>
                </div>
            </div>
        </div>
    </form>
</template>
<script>
export default {
    data: function() {
        return {
            fields: {
                lotteries: [],
            },
            errors: {},
            isSending: false,
            errored: false,
            success: false
        }
    },
    name: 'LotteryJoinForm',
    methods: {
        contactChange: function() {
            delete this.errors.contact;
        },
        telephoneChange: function() {
            delete this.errors.telephone;
        },
        emailChange: function() {
            delete this.errors.email;
        },
        checkboxChange: function(event) {
            if(event.target.checked) {
                delete this.errors.lotteries;
            }
        },
        submit() {
            this.errors = {};
            this.isSending = true;
            this.success = false;
            this.errored = false;
            axios.post('/lottery/send-request', this.fields).then(response => {
                $this.fields.contact = '';
                $this.fields.email = '';
                $this.fields.telephone = '';
                $this.fields.lotteries = [];
                this.isSending = false;
                this.success = true;
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                    this.isSending = false;
                    this.errored = true;
                }
            });
        },
    }
}
</script>
