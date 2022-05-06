require('./bootstrap');
require('owl.carousel/dist/owl.carousel');
import Vue from 'vue';
var VueScrollTo = require('vue-scrollto');

Vue.use(VueScrollTo);
Vue.directive('phone', {
    bind(el) {
        el.oninput = function(e) {
            if (!e.isTrusted) {
                return
            }
            if (this.value[0] === '8') {
                this.value = this.value.replace('8', '+7');
            }
            if (this.value.replace(/[^0-9]+/g, '') === '789') {
                this.value = '79';
            }
            const x = this.value.replace(/\D/g, '').match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
            x[1] = '+7';
            this.value = !x[3] ? x[1] + ' (' + x[2] : x[1] + ' (' + x[2] + ') ' + x[3] + (x[4] ? '-' + x[4] : '') + (x[5] ? '-' + x[5] : '')

        }

    }
})
Vue.component('HeaderPanelBtn', require('./components/header-panel/HeaderPanelBtn').default);
Vue.component('HeaderPanel', require('./components/header-panel/HeaderPanel').default);
Vue.component('ConsultationModal',require('./components/modals/consultation/ConsultationModal').default)
Vue.component('WhatSystemCheckModal', require('./components/modals/what-system-check/modal').default)
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
