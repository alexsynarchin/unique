<template>
    <el-tabs type="card" @tab-click="handleClick" v-model="activeTab">
        <el-tab-pane label="Общие" name="common">
            <common></common>
        </el-tab-pane>
        <el-tab-pane label="Настройки платежей" name="payment">
            <payment-gateway></payment-gateway>
        </el-tab-pane>
        <el-tab-pane label="Навигация" name="navigation">
            <navigation></navigation>
        </el-tab-pane>
        <el-tab-pane label="Настройки smtp" name='smtp'>
            <smtp settings_group="smtp" smtp_title="Настройки основного smtp"></smtp>
            <smtp settings_group="smtp_reserve" smtp_title="Настройки резервного smtp"></smtp>
        </el-tab-pane>
        <el-tab-pane label="Проверки уникальности" name="uniques">
            <unique></unique>
        </el-tab-pane>
        <el-tab-pane label="Настройки для репоста" name="repost">
            <repost-settings></repost-settings>
        </el-tab-pane>
    </el-tabs>
</template>
<script>
import smtp from "@/admin/js/views/settings/components/smtp/index.vue";
import common from "./components/common";
import navigation from './components/navigation';
import MainPage from "./components/main-page";
import Unique from "./components/unique"
import RepostSettings from "./components/repost.vue";
import PaymentGateway from "@/admin/js/views/settings/components/PaymentGateway.vue";
export default {
    components:{
        common, navigation, MainPage, smtp, Unique, RepostSettings, PaymentGateway
    },
    data() {
        return {
            CanAccess: 'Просмотр "Настройки"',
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
