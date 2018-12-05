import './bootstrap';
import './components';
import './forms';
import store from './store.js';
import Vue from 'vue';
import Turbolinks from 'turbolinks';
import VueCarousel from 'vue-carousel';
import VueScrollTo from 'vue-scrollto';
import PortalVue from 'portal-vue';
import SweetModal from 'sweet-modal-vue/src/plugin';
import VueFlashMessage from 'vue-flash-message';
import Datetime from 'vue-datetime';
import VueStash from 'vue-stash';
import 'vue-datetime/dist/vue-datetime.css';
import TurbolinksAdapter from 'vue-turbolinks';

// Vue config
Vue.config.productionTip = false;

Turbolinks.start();

Vue.use(TurbolinksAdapter);
Vue.use(VueCarousel);
Vue.use(VueScrollTo);
Vue.use(PortalVue);
Vue.use(SweetModal);
Vue.use(VueFlashMessage, {
    messageOptions: {
        timeout: 3000,
        important: true,
    },
});
Vue.use(Datetime);
Vue.use(VueStash);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

document.addEventListener('turbolinks:load', () => {
    const app = new Vue({
        el: '#app',
        data: { store },
    });
});
