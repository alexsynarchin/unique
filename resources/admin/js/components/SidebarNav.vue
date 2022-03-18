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
                    id:"/admin/systems",
                    title:"Системы проверки",
                },
                {
                    id:"/admin/systems",
                    title:"Запросы на проверку",
                },
                {
                    id:"/admin/systems",
                    title:"Заявки на рерайт",
                },
                {
                    id:"/admin/systems",
                    title:"Модераторы",
                },
                {
                    id:"/admin/systems",
                    title:"Промокоды",
                },
                {
                    id:"/admin/systems",
                    title:"Заявки",
                    border:true,
                },
            ],
            menu_2 : [
                {
                    id:"/admin/systems",
                    title:"Стоимость",
                },
                {
                    id:"/admin/systems",
                    title:"Вопросы и ответы",
                },
                {
                    id:"/admin/systems",
                    title:"Отзывы",
                },
                {
                    id:"/admin/systems",
                    title:"О проекте",
                },
                {
                    id:"/admin/systems",
                    title:"Статьи",
                },
            ],
            settings: [
                {
                    id:"/admin/systems",
                    title:"Настройки",
                },
            ],
        }
    }
}
</script>
