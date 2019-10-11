<template>
    <form @submit.prevent="submit">
        <div class="card mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="form-group floating-label-form-group controls">
                        <label>Contact Name</label>
                        <input type="text" class="form-control" placeholder="Contact Name" id="contact" v-model="fields.contact">
                        <div v-if="errors && errors.contact" class="text-danger">{{ errors.contact[0] }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group floating-label-form-group controls">
                        <label>Telephone</label>
                        <input type="tel" class="form-control" placeholder="Telephone (optional)" id="telephone" v-model="fields.telephone">
                        <div v-if="errors && errors.telephone" class="text-danger">{{ errors.telephone[0] }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group floating-label-form-group controls">
                        <label>Email Address</label>
                        <input type="email" class="form-control" placeholder="Email" id="email" v-model="fields.email">
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
                rank: '',
                name: '',
                dob: '',
                dod: '',
                regiment: '',
                location: '',
                message: ''
            },
            errors: {},
            maxCharacters: 100,
        }
    },
    name: 'MemorialContactForm',
    components: {
        AddressForm,
    },
    mounted() {
        this.$root.$on('checkFormsValid', () => {
            this.errors = {};
            axios.post('/memorial-garden/send-request', this.fields).then(response => {
                this.$root.$emit('validated')
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors || {};
                    this.$root.$emit('errors', this.errors)
                }
            });
        }),
        this.$root.$on('rankChange', rank => {
            this.fields.rank = rank;
        });
        this.$root.$on('nameChange', name => {
            this.fields.name = name;
        });
        this.$root.$on('dobChange', dob => {
            consoe.log(dob)
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
    }
}
</script>
