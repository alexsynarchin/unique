<template>
   <section>
       <el-menu  class="el-menu-demo" mode="horizontal"  :router="true"  @select="handleSelect">
           <el-menu-item index='/check-systems' >Системы проверки</el-menu-item>
           <el-menu-item index="/check-systems/api">Api систем проверки</el-menu-item>
       </el-menu>
       <router-view ></router-view>
   </section>
</template>
<script>
    import SystemList from './systems-list/SystemList.vue'
    export default {
        components: {
            SystemList
        },
        data() {
            return {
                activeTabName: 'list',
            }
        },
        methods: {
            handleSelect(key, keyPath) {
                console.log(key, keyPath);
            }
        }
    }
</script>
