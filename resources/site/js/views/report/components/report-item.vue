<template>
    <section class="report-item">
        <h3 class="report-item__title">
            Проверка {{report.formatted_date}}
        </h3>
        <div class="report-item__content"  >
            <div class="report-item-system">
                <h4 class="report-item-system__title">
                    {{report.check_system.title}}
                </h4>
                <figure class="report-item-system__logo">
                    <img :src="report.check_system.logo">
                </figure>
            </div>
            <section class="report-item__center">
                <div class="report-progress-bar" v-if="!report.result">
                    <progress-bar  bg-color="#E3E5ED" bar-color="#366AF3" :bar-border-radius="30" size="15" :val="increasing_pct"></progress-bar>
                    <div class="report-progress-bar__text">
                        <span class="report-progress-bar__precent">{{increasing_pct + '%'}}</span>
                        Идет формирование отчета
                    </div>
                </div>
                <div v-else>
                    <div class="report-progress-bar">
                        <progress-bar
                            bg-color="#E3E5ED"
                            bar-color="#366AF3"
                            :bar-border-radius="30"
                            size="15"
                            :val="report.data.unique"></progress-bar>
                        <div class="report-progress-bar__text">
                            <span class="report-progress-bar__precent">{{report.data.unique + '%'}}</span>
                            Текст неуникальный
                        </div>
                        <p class="report-progress-bar__descr">
                            У вашего текста низкий процент уникальности, мы рекомендуем вам проверить его в платных системах или воспользоваться услугой рерайта
                        </p>
                    </div>

                </div>
            </section>
            <section class="report-item__right">
                <ul class="report-text-params">
                    <li class="report-text-params__item">
                        <label class="report-text-params__label">
                            Номер отчета:
                        </label>
                        <span class="report-text-params__value">
                            {{report.id}}
                        </span>
                    </li>
                    <li class="report-text-params__item">
                        <label class="report-text-params__label">
                            Страниц:
                        </label>
                        <span class="report-text-params__value">
                            {{check_unique.pages}}
                        </span>
                    </li>
                    <li class="report-text-params__item">
                        <label class="report-text-params__label">
                            Слов:
                        </label>
                        <span class="report-text-params__value">
                             {{check_unique.wordsCount}}
                        </span>
                    </li>
                    <li class="report-text-params__item">
                        <label class="report-text-params__label">
                            Символов:
                        </label>
                        <span class="report-text-params__value">
                            {{check_unique.symbolsCount}}
                        </span>
                    </li>
                    <li class="report-text-params__item">
                        <label class="report-text-params__label">
                            Тип документа:
                        </label>
                        <span class="report-text-params__value">
                                {{check_unique.type}}
                        </span>
                    </li>
                </ul>
                <div class="report-item-bnts">
                    <button class="btn button">
                        Скачать отчет
                    </button>
                </div>
            </section>
        </div>
    </section>
</template>
<script>
import ProgressBar from 'vue-simple-progress'
    export default {
    components: {
        ProgressBar
    },
        data() {
        return {
            increasing_pct: 0,
            decreasing_pct: 100,
        }
        },
        props: {
            report: {
                type:Object,
            },
            check_unique: {
                type:Object,
            },
        },
        methods: {

        },
        mounted() {
        if(!this.report.result) {
            setInterval(() => {
                if (this.is_paused)
                    return
                this.random_pct = Math.ceil(Math.random() * 100)
                this.increasing_pct = Math.min(this.increasing_pct + 2, 100)
                this.decreasing_pct = Math.max(this.decreasing_pct - 2, 0)
                }, 3500)
            }

        }
    }
</script>
