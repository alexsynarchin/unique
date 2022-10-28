require('./bootstrap');
import Vue from 'vue';
import ElementUI from 'element-ui';
Vue.use(ElementUI);
import lang from 'element-ui/lib/locale/lang/ru-RU'
import locale from 'element-ui/lib/locale'
locale.use(lang);
import VueDataTables from 'vue-data-tables';
Vue.use(VueDataTables);

import CKEditor from '@ckeditor/ckeditor5-vue';
Vue.use( CKEditor );
import vTitle from 'vuejs-title'
Vue.use(vTitle)
Vue.component('AdminLogin', require('./components/admin-login/index').default);
import router from './router';
Vue.component('AdminApp',require('./Admin').default);
axios.get('/get-permissions').then(
    response => {
        window.Laravel.jsPermissions = response.data;
    }
);
import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs';
Vue.use(LaravelPermissionToVueJS)
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
