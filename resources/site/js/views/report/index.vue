<template>
    <section class="report-block" v-if="loaded">
        <systems-list></systems-list>
        <report  v-for="(item, index) in check_unique.reports"
            :key="item.id"
             :id="item.id"
             :check_unique="check_unique"
             v-if="loaded"
        ></report>
        <div class="report-item-descr check-unique-descr">
            <figure class="report-item-descr__icon check-unique-descr__icon">
                <img src="/assets/site/images/union.png">
            </figure>
            <div class="report-item-descr__content check-unique-descr__content">
                Обращаем ваше внимание, что система отвечает на вопрос,
                является тот или иной фрагмент текста заимствованным или нет.
                Ответ на вопрос, является ли фрагмент именно плагиатом,
                а не законной цитатой, система оставляет на ваше усмотрение.
            </div>
        </div>
    </section>
</template>
<script>
import SystemsList from "./components/systems-list";
import Report from "./components/report";
    export default {
        components: {
            SystemsList, Report
        },
        props: {
            id: {
                type:Number,
            }
        },
        data() {
            return {
                loaded:false,
                check_unique: {},

            }
        },
        methods: {
            getCheckUnique() {
                axios.get('/api/check-unique/' + this.id + '/show')
                    .then((response) => {
                      this.check_unique = response.data;
                      this.loaded = true;
                        this.$root.isLoading = false;
                    })
            },

        },
        mounted() {
            this.$root.isLoading = true;
            this.getCheckUnique();
        }
    }
</script>
