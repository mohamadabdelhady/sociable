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

Vue.component('chat_box', require('./components/chat_box.vue').default);

const app = new Vue({
    el: '#app',
});
Vue.component('notifications', require('./components/notifications.vue').default);

const notifications = new Vue({
    el: '#notifications',
});
Vue.component('friends_requests', require('./components/friends_requests.vue').default);
const friends_requests = new Vue({
    el: '#friends_requests',
});
