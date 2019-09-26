<template>
    <form @submit.prevent="submit">
        <div class="row mb-4">
            <div class="col">
                <div class="form-group floating-label-form-group controls">
                    <label>Contact Name</label>
                    <input type="text" class="form-control" placeholder="Contact Name" id="contact" v-model="fields.contact">
                    <div v-if="errors && errors.contact" class="text-danger">{{ errors.contact[0] }}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group floating-label-form-group controls">
                    <label>Contact Name</label>
                    <input type="tel" class="form-control" placeholder="Telephone (optional)" id="telephone" v-model="fields.telephone">
                    <div v-if="errors && errors.telephone" class="text-danger">{{ errors.telephone[0] }}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group floating-label-form-group controls">
                    <label>Email Address</label>
                    <input type="email" class="form-control" placeholder="Email" id="email" v-model="fields.email">
                    <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
                </div>
            </div>
        </div>
        <div id="plaque">
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
                <input type="text" class="form-control text-center" placeholder="Message" id="message" v-model="fields.message">
                <div v-if="errors && errors.message" class="text-danger">{{ errors.message[0] }}</div>
            </div>
        </div>
        <div id="success"></div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" id="sendMessageButton">Send</button>
        </div>
    </form>                   
</template>
 
<script>
export default {
  data() {
    return {
      fields: {},
      errors: {},
    }
  },
  methods: {
    submit() {
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
}
</script>