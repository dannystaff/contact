import { createApp } from 'vue/dist/vue.esm-bundler.js';
import ContactForm from '@/components/ContactForm.vue';
import ContactList from '@/components/ContactList.vue';

const app = createApp();
app.component('contact-form', ContactForm);
app.component('contact-list', ContactList);
app.mount('#app');