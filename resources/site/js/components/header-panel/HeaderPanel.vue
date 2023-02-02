<template>
    <section class="header-panel"
        :class="{
        'header-panel--open': PanelOpen,
        }"
    >
        <div class="header-panel__inner container">
            <div class="row">
                <div class="header-panel__left col-md-3">
                    <a href="/#check_unique" class="btn button button--width-100 mb-4">
                        Проверить уникальность
                    </a>
                    <button class="btn button button--width-100 button--transparent" data-bs-toggle="modal" data-bs-target="#video_modal">
                        <span class="button__text">
                            Смотреть видео о сервисе
                        </span>
                        <svg viewBox="0 0 10 10" class="button__icon">
                            <use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-arrow-dig-top"></use>
                        </svg>
                    </button>
                </div>
                <div class="header-panel__nav col-lg-4">
                    <ul class="main-nav">
                        <li class="main-nav__item" v-for="(item, index) in menu">
                            <a :href="'/' + item.link" class="main-nav__link">
                                {{item.title}}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="header-panel__right col-md-5">
                    <section class="header-panel-banner" style="background-image: url('/assets/site/images/header-panel-banner.png')" @click.prevent="repost">
                        <h3 class="header-panel-banner__title">
                            Получите скидку 10% за репост!
                        </h3>
                    </section>
                </div>
            </div>
            <div class="header-panel__mobile">
                <button class="btn button button--width-100 header-panel__mobile-btn" v-scroll-to="'#check_unique'">
                    Проверить уникальность
                </button>

                <div class="header-panel__contact contact-bl">
                <span class="contact-bl__phone">
                    8 800 555 65 65
                </span>
                    <a href="" class="contact-bl__btn" data-bs-toggle="modal" data-bs-target="#order-call">
                        Получить консультацию
                    </a>
                </div>

                <ul class="social-list social-list--header">
                    <li class="social-list__item">
                        <a href="" class="social-list__link social-list__link--dark">
                            <svg viewBox="0 0 24 24">
                                <use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-whatsapp-wh"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="social-list__item">
                        <a href="" class="social-list__link social-list__link--dark">
                            <svg viewBox="0 0 24 24">
                                <use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-instagram-wh"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="social-list__item">
                        <a href="" class="social-list__link social-list__link--dark">
                            <svg viewBox="0 0 24 24">
                                <use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-vk-wh"></use>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</template>
<script>
import { bus } from '@/site/js/services/bus.js';
    export default {
        data() {
            return {
                PanelOpen:false,
                menu:[],
            }
        },
        methods: {
            showPanel() {
                this.PanelOpen = !this.PanelOpen;
            },
            getMenu() {
                axios.get('/api/navigation/header-top')
                    .then((response) => {
                        this.menu = response.data;
                    })
            },
            repost() {
                window.location.href='https://vk.com/share.php?url=https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai'
            } ,
        },
        mounted() {
            this.getMenu();
        },
        created() {
           bus.$on('toggle-panel', this.showPanel)
        }
    }
</script>
