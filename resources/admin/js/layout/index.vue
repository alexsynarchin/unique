<template>
    <el-container >
        <header class="page-header">
            <div class="page-header__logo">
                Проверка Уникальности
            </div>
            <div class="page-header__content">
                <div class="page-header__right">
                    <header-profile
                        :user="user"
                    ></header-profile>
                </div>
            </div>
        </header>
        <el-container class="app-main">
            <aside class="main-sidebar">
                <sidebar-nav ></sidebar-nav>
            </aside>
            <el-container>
                <el-main >
                    <router-view></router-view>
                </el-main>
                <el-footer>Footer</el-footer>
            </el-container>

        </el-container>
    </el-container>
</template>
<script>
import SidebarNav from './components/SidebarNav';
import HeaderProfile from "./components/HeaderProfile";
export default {
    components:{
        SidebarNav, HeaderProfile
    },
    data() {
        return {
            tabs: [{
                link: '/admin',
                title: 'Товары'
            },
                {
                    link: '/admin/students',
                    title: 'Студенты'
                }
            ],
        }
    },
    computed: {
        signedIn() {
            return window.App.signedIn;
        },
        user(){
            return  window.App.user;
        },
    },
}
</script>
