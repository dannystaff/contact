<template>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <strong>Contacts</strong>

                            <div class="search">
                                <input class="form-control me-2" 
                                    type="search" 
                                    placeholder="Search" 
                                    aria-label="Search"
                                    v-model="term"
                                    @keyup="search">
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">First Name</th>
                                            <th scope="col">Last Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(lead, index) in results.data" :key="index">
                                            <td>{{ lead.first_name }}</td>
                                            <td>{{ lead.last_name }}</td>
                                            <td>{{ lead.email_address }}</td>
                                            <td>{{ lead.phone_number }}</td>
                                            <td>
                                                <button class="btn btn-sm py-0 btn-primary" 
                                                    data-bs-toggle="modal" data-bs-target="#modal"
                                                    @click="viewing = lead">
                                                    View
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer">
                            <Bootstrap5Pagination 
                                align="right"
                                :data="results"
                                @pagination-change-page="search"
                            />
                        </div>
                    </div>
                </div>

                <!-- Modal for additional details -->
                <div class="modal fade" tabindex="-1" id="modal">
                    <div class="modal-dialog">
                        <div class="modal-content" v-if="viewing">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ viewing.first_name }} {{ viewing.last_name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>{{ viewing.message }}</p>
                            </div>
                            <div class="modal-footer">
                                <p class="text-success" v-if="viewing.marketing_consent">
                                    Wants to be contacted via email
                                </p>

                                <p class="text-danger" v-else>
                                    Does not want to be contacted
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import { Bootstrap5Pagination } from 'laravel-vue-pagination';

    export default {
        name: 'ContactList',
        components: {Bootstrap5Pagination},
        props: {
            endpoint: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                loading: false,
                viewing: {},
                errors: {},
                results: {},
                term: '',
                page: 1
            }
        },
        computed: {
            searchEndpoint(){
                return `${this.endpoint}/${this.term}?page=${this.page}`;
            }
        },
        methods: {
            search(page = 1){
                console.log(page);
                const self = this;
                this.page = page;
                this.loading = true;

                axios.get(this.searchEndpoint)
                    .then((res) => {
                        this.results = res.data.results;
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
        },
        mounted(){
            this.search();
        }
    }
</script>