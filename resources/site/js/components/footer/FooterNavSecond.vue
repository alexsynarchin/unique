<template>
    <ul class="footer-bt-nav">
        <li class="footer-bt-nav__item" v-for="(item,index) in menu">
            <a class="footer-bt-nav__link" :href="'/' + item.link" target="_blank">
                {{item.title}}
            </a>
        </li>
        <li class="footer-bt-nav__item">
            <a class="footer-bt-nav__link" href="https://pandaworks.ru" target="_blank">
                Разработано в пандаворкс
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
                axios.get('/api/navigation/footer_2')
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
