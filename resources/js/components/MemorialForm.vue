<template>
    <form @submit.prevent="submit">
        <div id="plaque">
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control text-right" placeholder="Title" id="title" v-model="fields.title">
                    <div v-if="errors && errors.title" class="text-danger">{{ errors.title[0] }}</div>
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Name" id="name" v-model="fields.name">
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