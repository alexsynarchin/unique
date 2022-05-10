<template>
    <section class="report-item-detail">
        <div class="report-item-detail__heading">
            <h3 class="report-item-detail__title">
                Заимствования
            </h3>
            <span class="report-item-detail__control" v-if="showDetail" @click="handleDetail">
                Свернуть
                 <svg viewBox="0 0 10 10" class="report-item-detail__icon">
                    <use xlink:href="assets/site/images/sprites.svg?ver=17#sprite-arrow-dig-top"></use>
                </svg>
            </span>
            <span class="report-item-detail__control" v-else @click="handleDetail">
                Развернуть
                 <svg viewBox="0 0 10 10" class="report-item-detail__icon">
                    <use xlink:href="assets/site/images/sprites.svg?ver=17#sprite-arrow-dig-bottom"></use>
                </svg>
            </span>
        </div>
        <section class="report-item-detail__content report-item-detail-content">
            <p class="report-item-detail-content__descr">
                Нажмите на ссылку для подсвечивания заимствованного текста
            </p>

            <ul class="report-item-links">
                <li class="report-item-links__item" v-for="(item, index) in report.data.urls">
                    <section class="report-item-links__text">
                        <span class="report-item-links__percent">
                            {{item.plagiat + '%'}}
                        </span>
                        <span class="report-item-links__url">
                            {{item.url}}
                        </span>

                    </section>
                    <figure class="report-item-links__icon">
                        <svg viewBox="0 0 18 22" >
                            <use xlink:href="assets/site/images/sprites.svg?ver=17#sprite-copy"></use>
                        </svg>
                    </figure>

                </li>
            </ul>
            <section class="report--item-detail-text">
                {{report.data.clear_text}}
            </section>
        </section>
    </section>
</template>
<script>
    export default {
        props: {
            report: {
                type:Object,
            }
        },
        data() {
            return {
                showDetail: false,
            }
        },
        methods: {
            handleDetail() {
                this.showDetail = !this.showDetail;
            },
        }
    }
</script>
