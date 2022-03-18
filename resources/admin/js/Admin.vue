<template>
    <section class="el-container"  v-cloak>
        <el-aside class="el-aside--sidebar">
            <div class="sidebar-header">
                <img src="/images/logo.svg">
            </div>
            <sidebar-nav ></sidebar-nav>


        </el-aside>
        <el-container direction="vertical">
            <header  class="page-header container-fluid">
                <div class="row h-100">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6 page-header__right">
                        <header-profile
                            :user="user"
                        ></header-profile>
                    </div>
                </div>
            </header>
            <el-main>
                <router-view></router-view>
            </el-main>
        </el-container>
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
