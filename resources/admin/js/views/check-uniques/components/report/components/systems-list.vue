<template>
    <section class="report-systems-list">
        <h3 class="report-systems-list__title">
            Системы проверки:
        </h3>
        <ul class="report-systems-list__list">
            <li class="report-systems-list__item" v-for="(item , index) in list">
                <section class="report-systems-list-item" :class="{'report-systems-list-item--active': selected.indexOf(item.id) !==-1}">
                    {{item.title}}
                </section>
            </li>
        </ul>
    </section>
</template>
<script>
    export default {
        props: {
            selected:{
                type:Array,
            },
        },
        data() {
          return {
              list: [],
          }
        },
        methods: {
            getSystemsList() {
                axios.get('/api/check-systems')
                    .then((response) => {
                        this.list = response.data;
                    })
            },
        },
        mounted() {
            this.getSystemsList();
        }
    }
</script>
