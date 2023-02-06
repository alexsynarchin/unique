import Layout from "@/admin/js/layout/index.vue";
const staticPagesRoutes = {
    name: 'static-pages',
    path: '/static-pages',
    component: Layout,
    redirect:'/static-pages/list',
    meta: { title: 'Статические страницы',  noCache: false , permissions: ['manage_static_pages']},
    children: [
        {
            name: 'StaticPagesList',
            path:'list',
            component: () => import('@/admin/js/views/static-pages/index'),
            meta: {title: 'Список'}
        },
        {
            name: 'StaticPagesCreate',
            path:'create',
            component: () => import('@/admin/js/views/static-pages/Create'),
            meta: {title: 'Новая статическая страница'}
        },
        {
            name: 'StaticPagesEdit',
            path:'edit/:id',
            component: () => import('@/admin/js/views/static-pages/Edit'),
            meta: {title: 'Редактировать статическую страницу'},
            props:true,
        },
    ]
}
export default staticPagesRoutes;
