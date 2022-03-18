import Vue from "vue";
import VueRouter from 'vue-router';
import AdminHome from './views/home/index';
import AdminModerators from './views/moderators/index';
import AdminSettings from './views/settings/index';
Vue.use(VueRouter);
let routes = [
    { name: 'home', path: '/admin', component: AdminHome},
    { name: 'moderators', path: '/admin/moderators', component: AdminModerators},
    { name: 'settings', path: '/admin/settings', component: AdminSettings},

];
export default new VueRouter({
    mode: 'history',
    routes
});
