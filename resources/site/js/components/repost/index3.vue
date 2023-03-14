<template>
    <div class="repost">
        <h4 class="repost__title">
            Получите скидку 10% за репост
        </h4>
        <section class="repost__list">

            <a @click.prevent="sendRepost" href="#" class="repost__item repost__item--vk share-network-vk">
                <svg viewBox="0 0 20 22" class="repost__icon"><use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-vk"></use>
                </svg>
            </a>

            <ShareNetwork
                @close="closeRepost"
                class="repost__item repost__item--odnoklassniki"
                network="odnoklassniki"
                :url="data.url"
                :title="data.title"
                :media="data.logo"
                :description="data.description"
            >
                <svg class="repost__icon" viewBox="0 0 20 22">
                    <use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-odnoklassniki"></use>
                </svg>

            </ShareNetwork>
            <!--
            <ShareNetwork
                @close="closeRepost"
                class="repost__item repost__item--twitter"
                network="twitter"
                :url="data.url"
                :title="data.title"
                :description="data.description"
            >
                <svg class="repost__icon" viewBox="0 0 20 22">
                    <use xlink:href="assets/site/images/sprites.svg?ver=15#sprite-twitter"></use>
                </svg>

            </ShareNetwork>
            -->
            <div id="vk_api_transport"> </div>
        </section>
    </div>
</template>
<script>

    import {bus} from "@/site/js/services/bus";

    export default {
        components: {

        },
        data() {
            return {
                data: {
                    url: 'https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai',
                    title: 'Проверка-уникальности.рф. Бесплатная проверка уникальности текста. Все системы в одном месте',
                    media:'/assets/site/images/favicon.png',
                    description: 'Бесплатная проверка уникальности текста. Все системы в одном месте'
                }

            }
        },
        methods: {
            closeRepost(data) {
                console.log(data);
                bus.$emit('show-promo-modal');
            },
            sendRepost() {
                axios.post('/api/vk-post')
                    .then((response) => {
                        console.log(response.data);
                        window.location.href= response.data;
                    })
            },
        },
        mounted() {

            }
    }
</script>
