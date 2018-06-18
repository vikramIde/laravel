
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Notifications from 'vue-notification'
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('product-component', require('./components/ProductComponent.vue'));
Vue.component('queryform-component', require('./components/QueryFormRequestComponent.vue'));
Vue.component('userlist-component', require('./components/UserList.vue'));
Vue.use(Notifications)
const app = new Vue({
    el: '#app'
});
