<template>
    <section class="report-item">
        <h3 class="report-item__title">
            Проверка {{report.formatted_date}}
        </h3>
        <div class="report-item__content">
            <div class="report-item-system">
                <h4 class="report-item-system__title">
                    NASH Antiplagiat
                </h4>
                <figure class="report-item-system__logo">
                    <img src="/assets/site/images/mp/system-logo-1.png">
                </figure>
            </div>
            <section class="report-item__center">
                <div class="report-progress-bar">
                    <progress-bar  bg-color="#E3E5ED" bar-color="#366AF3" :bar-border-radius="30" size="15" :val="increasing_pct"></progress-bar>
                    <div class="report-progress-bar__text">
                        <span class="report-progress-bar__precent">{{increasing_pct + '%'}}</span>
                        Идет формирование отчета
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
                            {{report.pages}}
                        </span>
                    </li>
                    <li class="report-text-params__item">
                        <label class="report-text-params__label">
                            Слов:
                        </label>
                        <span class="report-text-params__value">
                             {{report.wordsCount}}
                        </span>
                    </li>
                    <li class="report-text-params__item">
                        <label class="report-text-params__label">
                            Символов:
                        </label>
                        <span class="report-text-params__value">
                            {{report.symbolsCount}}
                        </span>
                    </li>
                    <li class="report-text-params__item">
                        <label class="report-text-params__label">
                            Тип документа:
                        </label>
                        <span class="report-text-params__value">
                                {{report.type}}
                        </span>
                    </li>
                </ul>
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
        },
        methods: {

        },
        mounted() {
            setInterval(() => {
                if (this.is_paused)
                    return
                this.random_pct = Math.ceil(Math.random() * 100)
                this.increasing_pct = Math.min(this.increasing_pct + 2, 100)
                this.decreasing_pct = Math.max(this.decreasing_pct - 2, 0)
            }, 2000)
        }
    }
</script>
