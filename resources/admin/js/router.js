import Vue from "vue";
import VueRouter from 'vue-router';
import AdminHome from './views/home/index';
Vue.use(VueRouter);
let routes = [
    { name: 'home', path: '/admin', component: AdminHome},

];
export default new VueRouter({
    mode: 'history',
    routes
});
