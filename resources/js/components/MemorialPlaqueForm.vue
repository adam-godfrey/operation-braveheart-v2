<template>
    <div>
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
    </div>
</template>
<script>
import Datepicker from 'vuejs-datepicker';
export default {
    data: function() {
        return {
            fields: {
                message: '',
                confirm: ''
            },
            dobFormatted: '',
            dodFormatted: '',
            errors: {},
            maxCharacters: 35,
            disabledDates: {},
        }
    },
    name: 'MemorialPlaqueForm',
    components: {
        Datepicker
    },
    mounted() {
        this.$root.$on('errors', errors => {
            this.errors = errors;
        });

        var today = new Date();

        this.disabledDates = {
            from: new Date()
        }
    },
    methods: {
        rankChange: function() {
         delete this.errors.rank;
            this.$root.$emit('rankChange', this.fields.rank);
        },
        nameChange: function() {
            delete this.errors.name;
            this.$root.$emit('nameChange', this.fields.name);
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
            this.$root.$emit('regimentChange', this.fields.regiment);
        },
        locationChange: function() {
            delete this.errors.location;
            this.$root.$emit('locationChange', this.fields.location);
        },
        messageChange: function() {
            delete this.errors.message;
            this.$root.$emit('messageChange', this.fields.message);
        },
        confirmChange: function(event) {
            delete this.errors.confirm;
            this.$root.$emit('confirmChange', event.target.checked);
        }
    },
    computed: {
        charactersRemaining: function () {
            return this.maxCharacters - this.fields.message.length;
        }
    }
}
</script>