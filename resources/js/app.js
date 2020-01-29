
import Vue from 'vue'

import axios from 'axios'

require('./bootstrap');

window.Vue = require('vue');

Vue.config.devtools = true;
Vue.config.performance = true;
Vue.prototype.$http = axios;


import App from './App.vue';

const app = new Vue({
    el: '#app',
    components: {
        App
    },
    render: h => h(App)
});
