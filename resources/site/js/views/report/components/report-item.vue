<template>
    <section class="report-item">
        <h3 class="report-item__title">
            Проверка {{report.formatted_date}}
        </h3>

        <div class="report-item__content"  >
            <div class="report-item-system">
                <h4 class="report-item-system__title">
                    {{check_system.title}}
                </h4>
                <figure class="report-item-system__logo">
                    <img :src="check_system.logo">
                </figure>
            </div>
            <section class="report-item__center">
                <div class="report-progress-bar" v-if="!report.result && !report.need_payment">
                    <progress-bar  bg-color="#E3E5ED" bar-color="#366AF3" :bar-border-radius="30" size="15"  :val="increasing_pct"></progress-bar>
                    <div class="report-progress-bar__text">
                        <span class="report-progress-bar__precent">{{increasing_pct + '%'}}</span>
                        Идет формирование отчета
                    </div>
                </div>
                <div class="mt-3 alert alert-warning" v-if="report.need_payment && !report.result">
                    Ждем подтверждения оплаты за отчет от платежной системы...
                </div>
                <div v-if="report.result">
                    <div class="report-progress-bar">
                        <progress-bar
                            bg-color="#E3E5ED"
                            bar-color="#366AF3"
                            :bar-border-radius="30"
                            size="15"
                            :val="report.data.unique"></progress-bar>
                        <div class="report-progress-bar__text">
                            <span class="report-progress-bar__precent">Уникальность: {{report.data.unique + '%'}}</span>
                            <br>
                          {{report.data.unique < 70 ? ' Текст неуникальный' : ' Текст уникальный'}}
                        </div>
                        <p class="report-progress-bar__descr" v-if="report.data.unique < 50">
                            У вашего текста низкий уровень оригинальности, мы рекомендуем вам воспользоваться услугой рерайта.
                        </p>
                        <p v-else-if="report.data.unique < 71">
                            У вашего текста хороший уровень оригинальности.
                        </p>
                        <p v-else-if="report.data.unique < 85">
                           Оригинальности вашего текста высокая.
                        </p>
                        <p v-else>
                            Поздравляем у вас отличная уникальность текста.
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
                            {{check_unique.id}}
                        </span>
                    </li>
                    <li class="report-text-params__item">
                        <label class="report-text-params__label">
                            Страниц:
                        </label>
                        <span class="report-text-params__value">
                                  {{report.params.pages}}
                        </span>
                    </li>
                    <li class="report-text-params__item">
                        <label class="report-text-params__label">
                            Слов:
                        </label>
                        <span class="report-text-params__value">
                              {{report.params.wordsCount}}
                        </span>
                    </li>
                    <li class="report-text-params__item">
                        <label class="report-text-params__label">
                            Символов:
                        </label>
                        <span class="report-text-params__value">
                           {{report.params.symbols_count}}
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
                    <button class="btn button" @click.prevent="downloadPdf" v-if="report.result">
                        Скачать отчет
                    </button>
                </div>
            </section>
        </div>
        <div class="report-link-download mt-3">
            <label class="report-link-download__label">Ссылка на отчет: </label>
            <span class="report-link-download__item" id="report-link-download__item">https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/report/{{check_unique.slug}}</span>
            <figure class="report-item-links__icon" @click.prevent="copyUrl()" v-title="'Скопировать ссылку'">
                <svg viewBox="0 0 18 22" >
                    <use xlink:href="/assets/site/images/sprites.svg?ver=17#sprite-copy"></use>
                </svg>
            </figure>
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
            check_system: {},
            increasing_pct: 0,
            decreasing_pct: 100,
            maxPercent:100,
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
            copyUrl() {
                var copyTextarea = document.createElement("textarea");
                copyTextarea.style.position = "fixed";
                copyTextarea.style.opacity = "0";
                copyTextarea.textContent = 'https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/report/'+ this.check_unique.slug;

                document.body.appendChild(copyTextarea);
                copyTextarea.select();
                document.execCommand("copy");
                document.body.removeChild(copyTextarea);

            },
            downloadPdf() {
                this.$root.isLoading = true;
                axios.post('/api/report/' +this.report.id + '/download')
                    .then((response) => {
                        console.log(response.data);
                        this.$root.isLoading = false;
                        let link = document.createElement('a')
                        link.href = response.data;
                        link.download = 'report'
                        link.click()
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            },
        },
        mounted() {
        this.check_system = this.report.check_system;
        if(this.report.check_system.manual) {
            this.maxPercent = 99;
        }
        if(!this.report.result) {
            setInterval(() => {
                if (this.is_paused)
                    return
                this.random_pct = Math.ceil(Math.random() * 100)
                this.increasing_pct = Math.min(this.increasing_pct + 2, this.maxPercent)
                this.decreasing_pct = Math.max(this.decreasing_pct - 2, 0)
                }, 3500)
            }

        }
    }
</script>
