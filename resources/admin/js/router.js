import Vue from "vue";
import VueRouter from 'vue-router';
import AdminHome from './views/home/index';
import CourseItem from './views/home/show';
import CourseEdit from './views/home/edit';
import AdminStudents from './views/student/index';
import CategoryType from './views/categories/index';
import AdminTeachers from './views/teacher/index'
import AdminModerators from './views/moderator/index';
import AdminWithdraws from './views/withdraw/index';
import AdminPromoCodes from './views/promo/index';
import Articles from "./views/articles";
import StaticPages from './views/page';
import Settings from "./views/settings";
Vue.use(VueRouter);
let routes = [
    { name: 'home', path: '/admin', component: AdminHome},
    { name: 'course-item', path: '/admin/courses/:id', component: CourseItem, props: true},
    { name: 'course-edit', path: '/admin/courses/:slug/edit', component: CourseEdit, props: true},
    { name: 'category-types', path: '/admin/categories', component: CategoryType},
    { name: 'students', path: '/admin/students', component: AdminStudents},
    { name: 'teachers', path: '/admin/teachers', component: AdminTeachers},
    { name: 'moderators', path: '/admin/moderators', component: AdminModerators},
    { name: 'withdraws', path: '/admin/withdraws', component: AdminWithdraws},
    { name: 'promo-codes', path: '/admin/promo-codes', component: AdminPromoCodes},
    { name: 'settings', path: '/admin/settings', component: Settings},
    { name: 'static-pages', path: '/admin/static-pages', component: StaticPages},
    { name: 'articles', path: '/admin/articles', component: Articles},
];
export default new VueRouter({
    mode: 'history',
    routes
});
