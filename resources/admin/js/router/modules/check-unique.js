import Layout from "@/admin/js/layout/index.vue";

    const checkUniqueRoutes = {
        name: 'check-uniques',
        path: '/check-uniques',
        component: Layout,
        meta: { title: 'Заявки на проверку уникальности',  noCache: false , permissions: ['manage_check_uniques']},
        redirect: '/check-uniques/list',
        children: [
            {
                name:'check-uniques.list',
                path:'list',
                component: () => import('@/admin/js/views/check-uniques/index'),
                meta: { title: 'Список'},
            },
            {
                name: 'check-uniques.show',
                path: 'show/:id',
                component: () => import('@/admin/js/views/check-uniques/Show'),
                props:true,
                meta: {title: 'Заявка №'}
            }
        ]
    };
export default checkUniqueRoutes;
