<template>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            New Enquiry
                        </div>

                        <div class="card-body">
                            <div class="alert alert-success" v-if="success">
                                Thank you! Your message sent successfully.
                            </div>

                            <form @submit.prevent="submit" v-else>
                                <div class="alert alert-danger" v-if="errorMessage">
                                    {{ errorMessage }}
                                </div>

                                <text-field v-model="formData.first_name"
                                    label="First name"
                                    name="first_name"
                                    placeholder="First name"
                                    :errors="errors.first_name"
                                    required/>

                                <text-field v-model="formData.last_name"
                                    label="Last name"
                                    name="last_name"
                                    placeholder="Last name"
                                    :errors="errors.last_name"
                                    required/>

                                <text-field v-model="formData.email_address"
                                    label="Email"
                                    name="email"
                                    type="email"
                                    placeholder="john.doe@mail.com"
                                    :errors="errors.email_address"
                                    required/>

                                <text-field v-model="formData.phone_number"
                                    label="Phone"
                                    name="phone"
                                    type="phone"
                                    placeholder="07700000000"
                                    :errors="errors.phone_number"
                                    required/>

                                <text-field v-model="formData.message"
                                    label="Message"
                                    name="message"
                                    type="textarea"
                                    placeholder="Your message here..."
                                    :errors="errors.message"
                                    required/>

                                <checkbox v-model="formData.marketing_consent" name="marketing_consent">
                                    I love emails! Send me many of them every day
                                </checkbox>

                                <button :disabled="loading" type="submit" class="btn btn-primary">
                                    <div class="spinner-border spinner-border-sm" role="status" v-if="loading">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <span v-else>Submit</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Checkbox from './forms/Checkbox.vue';
    import TextField from './forms/TextField.vue';

    export default {
        name: 'ContactForm',
        components: {TextField, Checkbox},
        props: {
            endpoint: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                loading: false,
                errors: {},
                errorMessage: '',
                success: false,
                formData: {
                    first_name: '',
                    last_name: '',
                    email_address: '',
                    phone_number: '',
                    message: '',
                    marketing_consent: false
                }
            }
        },
        methods: {
            submit(){
                const self = this;
                this.loading = true;

                axios.post(this.endpoint, this.formData)
                    .then((res) => {
                        this.success = res.data.success;
                    })
                    .catch((error) => {
                        const response = error.response.data;

                        this.errors = response.errors;
                        this.errorMessage = response.message;
                        console.error(error);
                    }).finally(function () {
                        self.loading = false;
                    });
            }
        }
    }
</script>