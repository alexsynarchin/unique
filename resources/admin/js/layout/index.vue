<template>
    <el-container :class="classObj" @click="handleClickOutside" >
        <page-header ></page-header>
        <el-container class="app-main">
            <aside class="main-sidebar">
                <sidebar-nav ></sidebar-nav>
            </aside>
            <el-main class="main-container">
                <app-main />
            </el-main>
        </el-container>
    </el-container>
</template>
<script>
import {  AppMain } from './components';
import SidebarNav from './components/Sidebar';
import PageHeader from "./components/Header";
import {mapGetters, mapState} from 'vuex';



export default {
    name: 'Layout',
    components:{
        PageHeader,
        AppMain,
        SidebarNav,
    },
    computed: {
        ...mapState({
            sidebar: state => state.app.sidebar,
            device: state => state.app.device,
            showSettings: state => state.settings.showSettings,
            fixedHeader: state => state.settings.fixedHeader,
        }),
        classObj() {
            return {
                hideSidebar: !this.sidebar.opened,
                openSidebar: this.sidebar.opened,
                withoutAnimation: this.sidebar.withoutAnimation,
                mobile: this.device === 'mobile',
            };
        },
    },
    methods: {
        handleClickOutside() {
            this.$store.dispatch('app/closeSideBar', { withoutAnimation: false });
        },
    },

}
</script>
