<template>
    <el-menu
        :router="true"
        class="el-menu-vertical-demo"
    >
    <el-menu-item  v-for="item in menu"  v-bind:key="item.id" :index="item.id" class="el-menu-item__link sidebar-nav__link">
            <i class="sidebar-nav__icon" :class="item.icon"></i>
            <span class="sidebar-nav__link-text">
                 {{item.title}}
            </span>
    </el-menu-item>
    </el-menu>
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
                    title:"Курсы",
                    icon:"educate-icon educate-course"

                },
                {

                    id:"/admin/categories",
                    title:"Категории контента",
                    icon:"educate-icon educate-library"
                },

                {

                    id:"/admin/students",
                    title:"Студенты",
                    icon:"educate-icon educate-student icon-wrap"
                },
                {

                    id:"/admin/teachers",
                    title:"Преподаватели",
                    icon:"educate-icon educate-professor icon-wrap"
                },
                {
                    id:"/admin/withdraws",
                    title:"Запросы на вывод средств",
                    icon:"el-icon-coin"
                },
                {
                    id:"/admin/moderators",
                    title:"Модераторы",
                    icon:"el-icon-user"
                },
                {
                    id:"/admin/promo-codes",
                    title:"Промокоды",
                    icon:"el-icon-magic-stick"
                },
                {
                    id:"/admin/static-pages",
                    title:"Статические страницы",
                    icon:"educate-icon educate-library"
                },
                {
                    id:"/admin/articles",
                    title:"Блог",
                    icon:"educate-icon educate-library"
                },
                {
                    id:"/admin/settings",
                    title:"Настройки",
                    icon:"el-icon-setting"
                },
            ]
        }
    }
}
</script>
