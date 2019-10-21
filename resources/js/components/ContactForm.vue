<template>
    <form @submit.prevent="submit">
        <div class="notice notice-success" v-show="success">
            <strong>Success</strong> Lottery registration successful!!
        </div>
        <div class="notice notice-danger" v-show="errored">
            <strong>Error</strong> There are errors in the form!!
        </div>
        <div class="control-group">
            <div class="form-group floating-label-form-group controls">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Name" id="name" v-model="fields.name">
                <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
            </div>
        </div>
        <div class="control-group">
            <div class="form-group floating-label-form-group controls">
                <label>Email Address</label>
                <input type="email" class="form-control" placeholder="Email Address" id="email" v-model="fields.email">
                <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
            </div>
        </div>
        <div class="control-group">
            <div class="form-group floating-label-form-group controls">
                <label>Message</label>
                <textarea rows="5" class="form-control" placeholder="Message" id="message" v-model="fields.message"></textarea>
                <div v-if="errors && errors.message" class="text-danger">{{ errors.message[0] }}</div>
            </div>
        </div>
        <br>
        <div id="success"></div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" id="sendMessageButton" :disabled="isSending">Send</button>
        </div>
    </form>                   
</template>
 
<script>
export default {
    props: ['test'],
     data() {
        return {
            fields: {},
            errors: {},
            isSending: false,
            errored: false,
            success: false
        }
    },
    mounted () {
        // Do something useful with the data in the template
    },
    methods: {
        submit() {
            this.errors = {};
            this.isSending = true,
            this.success = false;
            this.errored = false;
            axios.post('/contact/submit', this.fields).then(response => {
                $this.fields.name = '';
                $this.fields.email = '';
                $this.fields.message = '';
                this.success = true;
                this.isSending = false;
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                    this.errored = true;
                    this.isSending = false;
                }
            });
        },
    },
}
</script>