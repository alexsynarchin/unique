<template>
    <section class="d-flex flex-column" style="flex: 1"  v-cloak>
        <header  class="page-header container-fluid">
            <div class="row h-100">
                <div class="col-md-6">
                    <h1 class="auth__title">Проверка уникальности</h1>
                </div>
                <div class="col-md-6 page-header__right">
                    <header-profile
                        :user="user"
                    ></header-profile>
                </div>
            </div>
        </header>
        <section class="el-container" style="flex: 1">
            <el-aside class="el-aside--sidebar">
                <sidebar-nav ></sidebar-nav>


            </el-aside>
            <el-container direction="vertical">

                <el-main>
                    <router-view></router-view>
                </el-main>
            </el-container>
        </section>
    </section>
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
