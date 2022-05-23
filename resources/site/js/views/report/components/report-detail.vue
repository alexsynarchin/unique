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
        <section class="report-item-detail__content report-item-detail-content"
                 :class="{'report-item-detail-content--open': showDetail}">
            <p class="report-item-detail-content__descr">
                Нажмите на ссылку для подсвечивания заимствованного текста
            </p>

            <ul class="report-item-links">
                <li class="report-item-links__item" v-for="(item, index) in report.data.urls">
                    <section class="report-item-links__text" @click.prevent="selectUrl(item)">
                        <span class="report-item-links__percent">
                            {{item.plagiat + '%'}}
                        </span>
                        <span class="report-item-links__url">
                            {{item.url}}
                            <input type="hidden" :value="item.url" :id="'report_item_link_' + index"></input>
                        </span>

                    </section>
                    <figure class="report-item-links__icon" @click.prevent="copyUrl(index, item.url)" v-title="'Скопировать ссылку'">
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
            selectUrl(url) {

            },
            copyUrl(index, url) {
               // url.select();
                let urlToCopy = document.querySelector('#report_item_link_' + index);
                urlToCopy.setAttribute('type', 'text');
                urlToCopy.select();
                document.execCommand('copy');
                urlToCopy.setAttribute('type', 'hidden');
            },
        }
    }
</script>
