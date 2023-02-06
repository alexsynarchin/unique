import Vue from 'vue';
import Router from 'vue-router';

/**
 * Layzloading will create many files and slow on compiling, so best not to use lazyloading on devlopment.
 * The syntax is lazyloading, but we convert to proper require() with babel-plugin-syntax-dynamic-import
 * @see https://doc.laravue.dev/guide/advanced/lazy-loading.html
 */

Vue.use(Router);

/* Layout */
import Layout from '@/admin/js/layout';


/* Router for modules */
import errorRoutes from './modules/error';

import checkUniqueRoutes from './modules/check-unique'
import articlesRoutes from "./modules/artisles";
import staticPagesRoutes from "./modules/static-pages";
export const constantRoutes = [
    {
        path: '/redirect',
        component: Layout,
        hidden: true,
        children: [
            {
                path: '/redirect/:path*',
                component: () => import('@/admin/js/views/redirect/index'),
            },
        ],
    },
    {
        path: '/login',
        component: () => import('@/admin/js/views/login/index'),
        hidden: true,
    },
    {
        path: '/auth-redirect',
        component: () => import('@/admin/js/views/login/AuthRedirect'),
        hidden: true,
    },
    {
        path: '/auth-redirect',
        component: () => import('@/admin/js/views/login/AuthRedirect'),
        hidden: true,
    },
    {
        path: '/404',
        redirect: { name: 'Page404' },
        component: () => import('@/admin/js/views/error-page/404'),
        hidden: true,
    },
    {
        path: '/401',
        component: () => import('@/admin/js/views/error-page/401'),
        hidden: true,
    },




    //elementUiRoutes,
];


export const asyncRoutes = [
    {
        path: '/',
        component: Layout,
        redirect: 'dashboard',
        children: [
            {
                path: 'dashboard',
                component: () => import('@/admin/js/views/dashboard/index'),
                name: 'Dashboard',
                meta: { title: 'dashboard',  noCache: false },
            },
            {
                path:'moderators',
                component: () => import('@/admin/js/views/moderators/index'),
                name: 'Moderators',
                meta: { title: 'Модераторы',  noCache: false , permissions: ['manage_moderators']},
            },
            { name: 'settings',
                path: 'settings',
                component: () => import('@/admin/js/views/settings/index'),
                meta: { title: 'Настройки',  noCache: false , permissions: ['manage_settings']},
            },


            {
                name: 'promo-codes',
                path: 'promo-codes',
                component: () => import('@/admin/js/views/promocodes/index.vue'),
                meta: { title: 'Промокоды',  noCache: false , permissions: ['manage_promo_codes']},
            },
            {
                name: 'prices',
                path: 'prices',
                component: () => import('@/admin/js/views/prices/index'),
                meta: { title: 'Цены',  noCache: false , permissions: ['manage_prices_page']},
            },
            {
                name: 'faq',
                path: 'faq',
                component: () => import('@/admin/js/views/faq/index'),
                meta: { title: 'FAQ',  noCache: false , permissions: ['manage_faq_page']},
            },
            {
                name:'main-page',
                path:'main-page',
                component: () => import('@/admin/js/views/main-page/index'),
                meta: { title: 'Главная страница',  noCache: false , permissions: ['manage_main_page']},
            },
            {name:'reviews',
                path:'reviews',
                component: () => import('@/admin/js/views/reviews/index'),
                meta: { title: 'Отзывы',  noCache: false , permissions: ['manage_reviews_page']},
            },
            {name:'about',
                path:'about',
                component: () => import('@/admin/js/views/about/index'),
                meta: { title: 'Страница о компании',  noCache: false , permissions: ['manage_about_page']},
            },
            {
                name:'rewrites',
                path:'rewrites',
                component: () => import('@/admin/js/views/rewrites/index'),
                meta: { title: 'Заявки на рерайт',  noCache: false , permissions: ['manage_rewrites']},
            },
            {
                name:'services',
                path:'services',
                component: () => import('@/admin/js/views/services/index'),
                meta: { title: 'Дополнительные услуги',  noCache: false , permissions: ['manage_services']},
            },

            {name: 'contacts',
                path: 'requests',
                component: () => import('@/admin/js/views/contact-orders/index'),
                meta: { title: 'Заявки обратная связь',  noCache: false , permissions: ['manage_contact_orders']},
            },

        ],
    },

    { name: 'check-systems',
        path: '/check-systems',
        component: Layout,
        meta: { title: 'Системы проверки уникальности',  noCache: false , permissions: ['manage_check_systems']},
        redirect: '/check-systems/list',
        alwaysShow: true,
        children: [
            {
                name:'check-systems-list',
                path: 'list',
                component: () => import('@/admin/js/views/systems/systems-list/SystemList'),
                meta: {title:'Список'},

            },
            {
                name:'check-systems-api',
                path: 'api',
                component: () => import('@/admin/js/views/systems/ApiList/index'),
                meta: {title:'Api'},
                children: [
                    {
                        name:'check-systems-api-list',
                        path: '',
                        component: () => import('@/admin/js/views/systems/ApiList/ApiList.vue'),
                        meta: {title:'Список'},
                    },
                    {
                        name:'ApiSettings',
                        path: ':id',
                        component: () => import('@/admin/js/views/systems/ApiList/ApiShow'),
                        meta: { title:'Настройка'},

                    }
                ]
            },

        ]
    },
    checkUniqueRoutes,
    articlesRoutes,
    staticPagesRoutes,
    errorRoutes,
    { path: '*', redirect: '/404', hidden: true },
];


const createRouter = () => new Router({
    mode: 'history', // require service support
    scrollBehavior: () => ({ y: 0 }),
    base: process.env.MIX_LARAVUE_PATH,
    routes: constantRoutes,
});

const router = createRouter();

// Detail see: https://github.com/vuejs/vue-router/issues/1234#issuecomment-357941465
export function resetRouter() {
    const newRouter = createRouter();
    router.matcher = newRouter.matcher; // reset router
}

export default router;
