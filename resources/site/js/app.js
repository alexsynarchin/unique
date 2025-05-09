require('./bootstrap');
require('owl.carousel/dist/owl.carousel');

require('bootstrap-cookie-alert/cookiealert.js');
import Vue from 'vue';
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
Vue.use(Toast);
var VueScrollTo = require('vue-scrollto');
import vTitle from 'vuejs-title'
Vue.use(vTitle)
Vue.use(VueScrollTo);
import VueSocialSharing from 'vue-social-sharing'
Vue.use(VueSocialSharing);

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
Vue.component('ConsultationModal',require('./components/modals/consultation/ConsultationModal').default);
Vue.component('ConnectSystemModal', require('./components/modals/connect-system/ConnectSystemModal.vue').default);
Vue.component('WhatSystemCheckModal', require('./components/modals/what-system-check/modal').default);
Vue.component('VideoModal', require('./components/modals/video-modal/modal').default);
Vue.component('RewriteModal',require('./components/modals/rewrite/modal').default);
Vue.component('CheckUnique', require('./components/check-unique').default);
Vue.component('MpFaq',require('./views/main-page/Faq').default);
Vue.component('SidebarBanner', require('./components/sidebar-banner/index').default);
//About page
Vue.component('AboutVideo', require('./views/about/about-video/index').default);

//Price page
Vue.component('PricePage',require('./views/price/index').default);

//Reviews page
Vue.component('ReviewsPage', require('./views/reviews/index').default);
Vue.component('ReviewsFilters', require('./views/reviews/components/filters').default);

//Contact Page
Vue.component('ContactBlock', require('./views/contact/ContactBlock').default);

//Faq Page
Vue.component('FaqPage', require('./views/faq-page/index').default);

//Report
Vue.component('ReportPage', require('./views/report/index').default);

Vue.component('Repost', require('./components/repost/index').default);
Vue.component('FooterNavFirst', require('./components/footer/FooterNavFirst').default);
Vue.component('FooterNavSecond', require('./components/footer/FooterNavSecond').default);

Vue.component('Articles', require('./views/article/index').default)

//Order
Vue.component('OrderFail', require('./components/order/fail').default);
Vue.component('OrderSuccess', require('./components/order/success').default);
Vue.component('PromoModal', require('./components/modals/promo-modal/index.vue').default);
Vue.component('OrderTest', require('./components/order/test.vue').default);
Vue.component('CloudPaymentForm', require('./components/cloud-payment-form/index.vue').default)
Vue.component('PayOnline', require('./components/pay-online/index.vue').default)
Vue.component('CloudPayment', require('./components/cloudpayments/index.vue').default)
const app = new Vue({
    el: '#app',
    created(){
        this.loadedApp();
    },
    mounted() {
        this.getCaptchaSetting();
    },
    data: {
        isLoading: true,
        recaptcha:false,

    },
    methods:{
        async loadedApp(){
            this.isLoading = false;
        },
        getCaptchaSetting() {
            axios.get('/api/setting/common/recaptcha')
                .then((response) => {
                    this.recaptcha = response.data;
                })
        },
    }
});
