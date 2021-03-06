import Vue from "vue";
import VueRouter from 'vue-router';
import AdminHome from './views/home/index';
import AdminModerators from './views/moderators/index';
import AdminSettings from './views/settings/index';
import AdminCheckSystems from './views/systems/index';
import AdminCheckUniques from './views/check-uniques/index';
import PromoCodes from "./views/promocodes/index";
import Prices from "./views/prices/index";
import Faq from './views/faq/index';
import MainPage from "./views/main-page";
import Reviews from "./views/reviews";
import About from "./views/about";
Vue.use(VueRouter);
let routes = [
    { name: 'home', path: '/admin', component: AdminHome},
    { name: 'moderators', path: '/admin/moderators', component: AdminModerators},
    { name: 'settings', path: '/admin/settings', component: AdminSettings},
    { name: 'check-systems', path: '/admin/check-systems', component: AdminCheckSystems},
    {name: 'check-uniques', path: '/admin/check-uniques', component: AdminCheckUniques},
    {name: 'promo-codes', path: '/admin/promo-codes', component: PromoCodes},
    {name: 'prices', path: '/admin/prices', component: Prices},
    {name: 'faq', path: '/admin/faq', component: Faq},
    {name:'main-page', path:'/admin/main-page', component: MainPage},
    {name:'reviews', path:'/admin/reviews', component: Reviews},
    {name:'about', path:'/admin/about', component: About},

];
export default new VueRouter({
    mode: 'history',
    routes
});
