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
                    url: 'http://unique.welcome-rb.ru/about',
                    title: 'Проверка уникальности',
                    description: 'Очень часто студенты проверяют свои курсовые, дипломные работы или рефераты в бесплатной версии (общедоступной). Антиплагиат, получив высокий процент уникальности при проверке'
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
