<template>
    <form @submit.prevent="submit">
        <div class="form-row mb-4">
            <div class="col">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group floating-label-form-group controls">
                            <label>Contact Name</label>
                            <input type="text" class="form-control" placeholder="Contact Name" id="contact" v-model="fields.contact">
                            <div v-if="errors && errors.contact" class="text-danger">{{ errors.contact[0] }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group floating-label-form-group controls">
                            <label>Contact Name</label>
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
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group floating-label-form-group controls">
                            <label>House</label>
                            <input type="text" class="form-control" placeholder="House" id="house" v-model="fields.house">
                            <div v-if="errors && errors.house" class="text-danger">{{ errors.house[0] }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group floating-label-form-group controls">
                            <label>Address</label>
                            <input type="text" class="form-control" placeholder="Address" id="address" v-model="fields.address">
                            <div v-if="errors && errors.address" class="text-danger">{{ errors.address[0] }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group floating-label-form-group controls">
                            <label>Address2</label>
                            <input type="text" class="form-control" placeholder="Address2" id="address2" v-model="fields.address2">
                            <div v-if="errors && errors.address2" class="text-danger">{{ errors.address2[0] }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group floating-label-form-group controls">
                            <label>County</label>
                            <input type="text" class="form-control" placeholder="County" id="county" v-model="fields.county">
                            <div v-if="errors && errors.county" class="text-danger">{{ errors.county[0] }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col ml-3">
                            <div class="form-group floating-label-form-group controls">
                                <label>Postcode</label>
                                <input type="text" class="form-control" placeholder="Postcode" id="postcode" v-model="fields.postcode">
                                <div v-if="errors && errors.postcode" class="text-danger">{{ errors.postcode[0] }}</div>
                            </div>
                        </div>
                        <div class="col-sm-auto pt-4 pr-4">
                            <button type="submit" class="btn btn-primary mr-1" id="findAddress">Find Address</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam inventore aspernatur repellendus incidunt adipisci modi voluptates recusandae iste eligendi, repudiandae corporis quod aut, optio! Explicabo quaerat unde voluptatem! Itaque, eum!</p>
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