<template>
    <aside class="main-sidebar"  ref="SidebarMenu">
            <el-menu
                :router="true"
                class="sidebar-nav"

            >
                <perfect-scrollbar :style="{height: height + 'px'}">
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
                </perfect-scrollbar>
            </el-menu>

    </aside>
</template>
<script>

import checkPermission from '@/admin/js/utils/permission';
import { PerfectScrollbar } from 'vue2-perfect-scrollbar'
export default {
    components: { PerfectScrollbar },
    mounted(){
        this.isMounted = true;


    },
    computed:{
        height () {
            if(this.isMounted) {
                return this.$refs.SidebarMenu.clientHeight - 80;
            }
        }
    },

    methods: {
        checkPermission,
        matchHeight() {
            let height = this.$refs.SidebarMenu.clientHeight;

            this.height = height - 80;
        }
    },
    data(){
        return{
            isMounted:false,
            menu:[

                {
                    id:"/check-systems",
                    title:"Системы проверки",
                    permission: 'manage_check_systems',
                },
                {
                    id:"/check-uniques",
                    title:"Запросы на проверку",
                    permission: 'manage_check_uniques',
                },
                {
                    id:"/services",
                    title:"Дополнительные услуги",
                    permission: 'manage_services',
                },
                {
                    id:"/rewrites",
                    title:"Заявки на рерайт",
                    permission: 'manage_rewrites',
                },
                {
                    id:"/moderators",
                    title:"Модераторы",
                    permission: 'manage_moderators',
                },
                {
                    id:"/promo-codes",
                    title:"Промокоды",
                    permission: 'manage_promo_codes',
                },
                {
                    id:"/requests",
                    title:"Заявки",
                    border:true,
                    permission: 'manage_contact_orders',
                },
                {
                    id:"/main-page",
                    title:"Главная страница",
                    permission: 'manage_main_page',
                },
                {
                    id:"/prices",
                    title:"Стоимость",
                    permission: 'manage_prices_page',
                },
                {
                    id:"/faq",
                    title:"Вопросы и ответы",
                    permission: 'manage_faq_page',
                },
                {
                    id:"/reviews",
                    title:"Отзывы",
                    permission: 'manage_reviews_page',
                },
                {
                    id:"/about",
                    title:"О проекте",
                    permission: 'manage_about_page',
                },
                {
                    id:"/static-pages",
                    title:"Статические страницы",
                    permission: 'manage_static_pages',
                },
                {
                    id:"/articles",
                    title:"Статьи",
                    permission: 'manage_articles',
                    border:true,
                },
                {
                    id:"/settings",
                    title:"Настройки",
                    permission: 'manage_settings',
                },

            ],
        }
    }
}
</script>
<style>
@import "vue2-perfect-scrollbar/dist/vue2-perfect-scrollbar.css";
.ps {

}
</style>

