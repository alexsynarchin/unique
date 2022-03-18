<template>
    <el-tabs type="card" @tab-click="handleClick" v-model="activeTab">
        <el-tab-pane label="Общие" name="common">
            <common></common>
        </el-tab-pane>
        <el-tab-pane label="Главная страница" name="main-page">
            <main-page></main-page>
        </el-tab-pane>
        <el-tab-pane label="Навигация" name="navigation">
            <navigation></navigation>
        </el-tab-pane>
    </el-tabs>
</template>
<script>
import common from "./components/common";
import navigation from './components/navigation';
import MainPage from "./components/main-page";
export default {
    components:{
        common, navigation, MainPage,
    },
    data() {
        return {
            activeTab: 'common'
        };
    },
    methods: {
        handleClick(tab, event) {
            console.log(tab, event);
        }
    },
}
</script>
