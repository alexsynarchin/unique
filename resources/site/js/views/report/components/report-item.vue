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
                <div class="report-progress-bar" v-if="!report.result && !report.need_payment && !report.error_code">
                    <progress-bar  bg-color="#E3E5ED" bar-color="#366AF3" :bar-border-radius="30" size="15"  :val="increasing_pct"></progress-bar>
                    <div class="report-progress-bar__text">
                        <span class="report-progress-bar__precent">{{increasing_pct + '%'}}</span>
                        Идет формирование отчета
                    </div>
                </div>
                <div class="mb-3" v-if="!report.result && report.error_code">
                    <div class="mt-3 alert alert-danger">
                        Ошибка сервиcа при формировании отчета.<br>
                        Попробуйте перезапустить проверку или свяжитесь с менеджером
                    </div>
                    <button class="btn button" @click.prevent="$emit('reportRestart')">
                        Перезапустить проверку
                    </button>
                </div>
                <div class="mt-3 alert alert-warning" v-if="report.need_payment && !report.result">
                    <span>Ждем подтверждения оплаты за отчет от платежной системы...</span>
                   <svg width="30px" xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'><radialGradient id='a6' cx='.66' fx='.66' cy='.3125' fy='.3125' gradientTransform='scale(1.5)'><stop offset='0' stop-color='#366AF3'></stop><stop offset='.3' stop-color='#366AF3' stop-opacity='.9'></stop><stop offset='.6' stop-color='#366AF3' stop-opacity='.6'></stop><stop offset='.8' stop-color='#366AF3' stop-opacity='.3'></stop><stop offset='1' stop-color='#366AF3' stop-opacity='0'></stop></radialGradient><circle transform-origin='center' fill='none' stroke='url(#a6)' stroke-width='15' stroke-linecap='round' stroke-dasharray='200 1000' stroke-dashoffset='0' cx='100' cy='100' r='70'><animateTransform type='rotate' attributeName='transform' calcMode='spline' dur='2' values='360;0' keyTimes='0;1' keySplines='0 0 1 1' repeatCount='indefinite'></animateTransform></circle><circle transform-origin='center' fill='none' opacity='.2' stroke='#366AF3' stroke-width='15' stroke-linecap='round' cx='100' cy='100' r='70'></circle></svg>
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
