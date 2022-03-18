<template>
    <section class="row">
        <nav-item v-for="(menu, index) in menus" :key="index" :menu="menu"></nav-item>
    </section>
</template>
<script>
import menu from './navigation/menu'
export default {
    components:{
        'navItem':menu
    },
    data() {
        return {
            menus:[
                {
                    title:'Верхняя навигация',
                    position:'header-top',
                    items:[],
                },
                {
                    title:'Навигация в футере 1',
                    position: 'footer_1',
                    items:[],
                },
                {
                    title:'Навигация в футере 2',
                    position: 'footer_2',
                    items:[],
                }
            ],
        }
    },

}
</script>
