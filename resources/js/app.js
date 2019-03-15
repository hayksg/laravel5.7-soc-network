import $ from 'jquery';
import VueToastr from 'vue-toastr';
import fontawesome from '@fortawesome/fontawesome-free';

require('./bootstrap');
require('./app-script');
require('./j-confirm-action');
require('./jquery.fancybox.min');
require('./mediaelement-and-player.min');

// For Admin Panel
require('./sb-admin');
window.toastr = require('toastr')

window.Vue = require('vue');

Vue.use(VueToastr, {
    defaultPosition: 'toast-bottom-right',
    defaultType: 'info',
    defaultTimeout: 6000
})

Vue.component('vue-message', require('./components/MessageComponent.vue'));
Vue.component('vue-search', require('./components/SearchComponent.vue'));
Vue.component('vue-gallery', require('./components/GalleryComponent.vue'));
Vue.component('vue-like', require('./components/LikeComponent.vue'));

const app = new Vue({
    el: '#app'
});
