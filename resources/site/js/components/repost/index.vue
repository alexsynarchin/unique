<template>
    <div class="repost">
        <h4 class="repost__title">
            Получите скидку 10% за репост
        </h4>
        <section class="repost__list">
            <ShareNetwork
                class="repost__item repost__item--vk"
                network="vk"
                @close="closeRepost"
                :url="data.url"
                :title="data.title"
                :description="data.description"
            >
                <svg class="repost__icon" viewBox="0 0 20 22">
                    <use xlink:href="assets/site/images/sprites.svg?ver=15#sprite-vk"></use>
                </svg>

            </ShareNetwork>
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
                    <use xlink:href="assets/site/images/sprites.svg?ver=15#sprite-odnoklassniki"></use>
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
        </section>
<promo-modal ref="promoModal"></promo-modal>
    </div>
</template>
<script>
    import PromoModal from './modal'
    export default {
        components: {
            PromoModal
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
                console.log(data)
                this.$refs.promoModal.showModal();
            }
        }
    }
</script>
