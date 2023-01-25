<template>
    <div>

        <el-menu
            :router="true"
            class="sidebar-nav"
        >
            <el-menu-item index="/" class="el-menu-item__link sidebar-nav__link">
                <span class="sidebar-nav__link-text">Главная</span>
            </el-menu-item>
            <el-menu-item  v-for="item in menu"  v-bind:key="item.id" :index="item.id" class="el-menu-item__link sidebar-nav__link"
                           :class="{
                'sidebar-nav__link--border':item.border
            }"
            >
            <span class="sidebar-nav__link-text">
                 {{item.title}}
            </span>
            </el-menu-item>
        </el-menu>


    </div>

</template>
<script>
export default {
    mounted(){


    },

    computed:{
    },
    data(){
        return{

            menu:[

                {
                    id:"/check-systems",
                    title:"Системы проверки",
                    permission: 'Просмотр "Системы проверки"',
                },
                {
                    id:"/admin/check-uniques",
                    title:"Запросы на проверку",
                    permission: 'Просмотр "Запросы на проверку"',
                },
                {
                    id:"/admin/services",
                    title:"Дополнительные услуги",
                    permission: 'Просмотр "Дополнительные услуги"',
                },
                {
                    id:"/admin/rewrites",
                    title:"Заявки на рерайт",
                    permission: 'Просмотр "Заявки на рерайт"',
                },
                {
                    id:"/moderators",
                    title:"Модераторы",
                    permission: 'Просмотр "Модераторы"',
                },
                {
                    id:"/promo-codes",
                    title:"Промокоды",
                    permission: 'Просмотр "Промокоды"',
                },
                {
                    id:"/requests",
                    title:"Заявки",
                    border:true,
                    permission: 'Просмотр "Заявки"',
                },
                {
                    id:"/admin/main-page",
                    title:"Главная страница",
                    permission: 'Просмотр "Главная страница"',
                },
                {
                    id:"/admin/prices",
                    title:"Стоимость",
                    permission: 'Просмотр "Стоимость"',
                },
                {
                    id:"/admin/faq",
                    title:"Вопросы и ответы",
                    permission: 'Просмотр "Вопросы и ответы"',
                },
                {
                    id:"/admin/reviews",
                    title:"Отзывы",
                    permission: 'Просмотр "Отзывы"',
                },
                {
                    id:"/admin/about",
                    title:"О проекте",
                    permission: 'Просмотр "О проекте"',
                },
                {
                    id:"/admin/static-pages",
                    title:"Статические страницы",
                    permission: 'Просмотр "Статические страницы"',
                },
                {
                    id:"/admin/articles",
                    title:"Статьи",
                    permission: 'Просмотр "Статьи"',
                    border:true,
                },
                {
                    id:"/admin/settings",
                    title:"Настройки",
                    permission: 'Просмотр "Настройки"',
                },
            ],
        }
    }
}
</script>
