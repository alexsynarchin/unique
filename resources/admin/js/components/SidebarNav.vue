<template>
    <div>
        <el-menu
            :router="true"
            class="sidebar-nav"
        >
            <el-menu-item  v-for="item in menu"  v-bind:key="item.id" :index="item.id" class="el-menu-item__link sidebar-nav__link"
            :class="{
                'sidebar-nav__link--border':item.border
            }">
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
                    id:"/admin",
                    title:"Главная",
                },
                {
                    id:"/admin/check-systems",
                    title:"Системы проверки",
                },
                {
                    id:"/admin/check-uniques",
                    title:"Запросы на проверку",
                },
                {
                    id:"/admin/services",
                    title:"Дополнительные услуги",
                },
                {
                    id:"/admin/rewrites",
                    title:"Заявки на рерайт",
                },
                {
                    id:"/admin/moderators",
                    title:"Модераторы",
                },
                {
                    id:"/admin/promo-codes",
                    title:"Промокоды",
                },
                {
                    id:"/admin/requests",
                    title:"Заявки",
                    border:true,
                },
                {
                    id:"/admin/main-page",
                    title:"Главная страница",
                },
                {
                    id:"/admin/prices",
                    title:"Стоимость",
                },
                {
                    id:"/admin/faq",
                    title:"Вопросы и ответы",
                },
                {
                    id:"/admin/reviews",
                    title:"Отзывы",
                },
                {
                    id:"/admin/about",
                    title:"О проекте",
                },
                {
                    id:"/admin/static-pages",
                    title:"Статические страницы",
                },
                {
                    id:"/admin/articles",
                    title:"Статьи",
                    border:true,
                },
                {
                    id:"/admin/settings",
                    title:"Настройки",
                },
            ],
        }
    }
}
</script>
