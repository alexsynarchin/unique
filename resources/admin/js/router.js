import Vue from "vue";
import VueRouter from 'vue-router';
import AdminHome from './views/home/index';
import AdminModerators from './views/moderators/index';
import AdminSettings from './views/settings/index';
import AdminCheckSystems from './views/systems/index';
Vue.use(VueRouter);
let routes = [
    { name: 'home', path: '/admin', component: AdminHome},
    { name: 'moderators', path: '/admin/moderators', component: AdminModerators},
    { name: 'settings', path: '/admin/settings', component: AdminSettings},
    { name: 'check-systems', path: '/admin/check-systems', component: AdminCheckSystems},

];
export default new VueRouter({
    mode: 'history',
    routes
});
