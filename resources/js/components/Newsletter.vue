<template>
    <div class="jumbotron bg-blue mb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto text-center">
                    <h2>STAY IN TOUCH</h2>
                    <p>Would you like to keep updated on our latest goings on?</p>
                    <form @submit.prevent="submit" class="form-inline justify-content-center">
                        <div class="input-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" class="form-control" placeholder="Email Address" id="email" v-model="fields.email">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-light mb-2">SIGN UP</button>
                            </div>
                        </div>
                    </form>
                    <p>By clicking 'Sign Up', you agree to receive email updates from Operation Braveheart <a href="#">Privacy Policy</a></p>
                </div>
            </div>
        </div>
    </div>
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
      axios.post('/newsletter/submit', this.fields).then(response => {
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