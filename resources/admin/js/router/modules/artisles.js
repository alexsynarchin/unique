import Layout from "@/admin/js/layout/index.vue";

const articlesRoutes = {
        name: 'Article',
        path: '/articles',
        component: Layout,
        meta: { title: 'Статьи',  noCache: false , permissions: ['manage_articles']},
        redirect: '/articles/list',
        children: [
            {
                name: 'ArticleList',
                path:'list',
                component: () => import('@/admin/js/views/articles/index'),
                meta: {title: 'Список'}
            },
            {
                name: 'ArticleCreate',
                path:'create',
                component: () => import('@/admin/js/views/articles/Create'),
                meta: {title: 'Новая статья'}
            },
            {
                name: 'ArticleEdit',
                path:'edit/:id',
                component: () => import('@/admin/js/views/articles/Edit'),
                meta: {title: 'Редактировать статью'},
                props:true,
            },

        ],
    }
export default articlesRoutes;
