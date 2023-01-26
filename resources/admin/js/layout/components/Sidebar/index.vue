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
                           v-if="checkPermission([item.permission])"
            >
            <span class="sidebar-nav__link-text">
                 {{item.title}}
            </span>
            </el-menu-item>
        </el-menu>


    </div>

</template>
<script>
import checkPermission from '@/admin/js/utils/permission';
export default {
    mounted(){


    },

    computed:{
    },
    methods: {
        checkPermission,
    },
    data(){
        return{

            menu:[

                {
                    id:"/check-systems",
                    title:"Системы проверки",
                    permission: 'manage check systems',
                },
                {
                    id:"/check-uniques",
                    title:"Запросы на проверку",
                    permission: 'manage check uniques',
                },
                {
                    id:"/services",
                    title:"Дополнительные услуги",
                    permission: 'manage services',
                },
                {
                    id:"/rewrites",
                    title:"Заявки на рерайт",
                    permission: 'manage rewrites',
                },
                {
                    id:"/moderators",
                    title:"Модераторы",
                    permission: 'manage moderators',
                },
                {
                    id:"/promo-codes",
                    title:"Промокоды",
                    permission: 'manage promo codes',
                },
                {
                    id:"/requests",
                    title:"Заявки",
                    border:true,
                    permission: 'manage contact orders',
                },
                {
                    id:"/main-page",
                    title:"Главная страница",
                    permission: 'manage main page',
                },
                {
                    id:"/prices",
                    title:"Стоимость",
                    permission: 'manage prices page',
                },
                {
                    id:"/faq",
                    title:"Вопросы и ответы",
                    permission: 'manage faq page',
                },
                {
                    id:"/reviews",
                    title:"Отзывы",
                    permission: 'manage reviews page',
                },
                {
                    id:"/about",
                    title:"О проекте",
                    permission: 'manage about page',
                },
                {
                    id:"/static-pages",
                    title:"Статические страницы",
                    permission: 'manage static pages',
                },
                {
                    id:"/articles",
                    title:"Статьи",
                    permission: 'manage articles',
                    border:true,
                },
                {
                    id:"/settings",
                    title:"Настройки",
                    permission: 'manage settings',
                },
            ],
        }
    }
}
</script>
