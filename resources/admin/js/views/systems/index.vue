<template>
    <el-tabs type="card" v-model="activeTabName" v-if="can(CanAccess) || is('Super-Admin')">
        <el-tab-pane name="list" label="Системы проверки">
            <system-list></system-list>
        </el-tab-pane>
        <el-tab-pane name="api" label="Api систем проверки">
            <api-list></api-list>
        </el-tab-pane>
    </el-tabs>
</template>
<script>
    import ApiList from './ApiList/ApiList.vue';
    import SystemList from './SystemList'
    export default {
        components: {
            ApiList, SystemList
        },
        data() {
            return {
                CanAccess: 'Просмотр "Системы проверки"',
                activeTabName: 'list',

            }
        }
    }
</script>
