/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('home', require('./components/home.vue').default);
Vue.component('search_results', require('./components/search_results.vue').default);
Vue.component('notification_home', require('./components/notification_home.vue').default);
Vue.component('request_home', require('./components/request_home.vue').default);
Vue.component('contacts', require('./components/contacts.vue').default);
Vue.component('notifications_menu', require('./components/notifications_menu.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: 'home',
});
const app1 = new Vue({
    el: 'search_results',
});
const app2 = new Vue({
    el: 'notification_home',
});
const app3 = new Vue({
    el: 'request_home',
});
const app4 = new Vue({
    el: 'contacts',
});
const app5 = new Vue({
    el: 'notifications_menu',
});
