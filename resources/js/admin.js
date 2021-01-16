import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import App from './Admin.vue';
import router from './admin-router';
import store from './store'
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

store.commit('setUser', window.site.user);

Vue.config.productionTip = false;

Vue.use(ElementUI);

new Vue({
    store,
    router,
    el: '#app',
    render: h => h(App)
});
