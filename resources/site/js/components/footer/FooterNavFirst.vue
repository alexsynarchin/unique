<template>
    <ul class="main-nav main-nav--footer">
        <li class="main-nav__item" v-for="(item,index) in menu">
            <a :href="'/' + item.link" class="main-nav__link main-nav__link--footer">
                {{item.title}}
            </a>
        </li>
    </ul>
</template>
<script>
export default {
    data() {
        return {
            menu: [],
        }
    },
    methods: {
        getMenu() {
            axios.get('/api/navigation/footer_1')
                .then((response) => {
                    this.menu = response.data;
                })
        },
    },
    mounted() {
        this.getMenu();
    }
}
</script>
