require('./bootstrap');
require('owl.carousel/dist/owl.carousel');
import Vue from 'vue';
Vue.component('HeaderPanelBtn', require('./components/header-panel/HeaderPanelBtn').default);
Vue.component('HeaderPanel', require('./components/header-panel/HeaderPanel').default)
Vue.component('CheckUnique', require('./components/check-unique').default);
Vue.component('MpFaq',require('./views/main-page/Faq').default);
const app = new Vue({
    el: '#app',
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
