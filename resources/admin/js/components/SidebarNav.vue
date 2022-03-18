<template>
    <div>
        <el-menu
            :router="true"
            class="sidebar-nav"
        >
            <el-menu-item  v-for="item in menu"  v-bind:key="item.id" :index="item.id" class="el-menu-item__link sidebar-nav__link">
            <span class="sidebar-nav__link-text">
                 {{item.title}}
            </span>
            </el-menu-item>
        </el-menu>
        <hr>
        <el-menu
            :router="true"
            class="sidebar-nav"

        >
            <el-menu-item  v-for="item in menu_2"  v-bind:key="item.id" :index="item.id" class="el-menu-item__link sidebar-nav__link">
            <span class="sidebar-nav__link-text">
                 {{item.title}}
            </span>
            </el-menu-item>
        </el-menu>
        <hr>
        <el-menu
            :router="true"
            class="sidebar-nav"

        >
            <el-menu-item  v-for="item in settings"  v-bind:key="item.id" :index="item.id" class="el-menu-item__link sidebar-nav__link">
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
                    id:"/admin/check-requests",
                    title:"Запросы на проверку",
                },
                {
                    id:"/admin/rewrite-check",
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
                },
            ],
            menu_2 : [
                {
                    id:"/admin/price",
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
                    id:"/admin/articles",
                    title:"Статьи",
                },
            ],
            settings: [
                {
                    id:"/admin/settings",
                    title:"Настройки",
                },
            ],
        }
    }
}
</script>
