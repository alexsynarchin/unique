import 'core-js';

import Vue from 'vue';

import Cookies from 'js-cookie';
import ElementUI from 'element-ui';

import VueDataTables from 'vue-data-tables';
Vue.use(VueDataTables);
import vTitle from 'vuejs-title'
Vue.use(vTitle)
import App from './views/App';
import store from './store';
import router from '@/admin/js/router';
import i18n from './lang'; // Internationalization
import '@/admin/js/permission'; // permission control
import * as filters from './filters'; // global filters




Vue.use(ElementUI, {
    size: Cookies.get('size') || 'medium', // set element-ui default size
    i18n: (key, value) => i18n.t(key, value),
});
Object.keys(filters).forEach(key => {
    Vue.filter(key, filters[key]);
});


new Vue({
    el: '#app',
    router,
    store,
    i18n,
    render: h => h(App),
});
/*
const app = new Vue({
    el: '#app',
    router,
    created(){
        this.loadedApp();
    },
    data: {
        isLoading: true,

    },
    methods:{
        async loadedApp(){
            this.isLoading = false;
        },

    }
});
*/

