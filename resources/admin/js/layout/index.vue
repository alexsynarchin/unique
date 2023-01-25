<template>
    <el-container >
        <header class="page-header">
            <div class="page-header__logo">
                Проверка Уникальности
            </div>
            <div class="page-header__content">
                <div class="page-header__right">

                </div>
            </div>
        </header>
        <el-container class="app-main">
            <aside class="main-sidebar">
                <sidebar-nav ></sidebar-nav>
            </aside>
            <el-main >
                <app-main />
            </el-main>
        </el-container>
    </el-container>
</template>
<script>
import {  AppMain } from './components';
import SidebarNav from './components/Sidebar';
import HeaderProfile from "./components/Header";
import { mapState } from 'vuex';


export default {
    name: 'Layout',
    components:{
        AppMain,
        SidebarNav, HeaderProfile
    },


}
</script>
