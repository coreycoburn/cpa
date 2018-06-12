import Vue from 'vue'
import VueCarousel from 'vue-carousel'
import Turbolinks from 'turbolinks'
import TurbolinksAdapter from 'vue-turbolinks'

require('./bootstrap')

Turbolinks.start()

Vue.use(VueCarousel)
Vue.use(TurbolinksAdapter)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('main-component', require('./components/ExampleComponent.vue'))

document.addEventListener('turbolinks:load', () => {
    const app = new Vue({
        el: '#app'
    })
})
