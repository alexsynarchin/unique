<template>
    <div class="repost">
        <h4 class="repost__title">
            Получите скидку 10% за репост
        </h4>
        <section class="repost__list">

            <a id="btn-podel" href="javascript:void(0)" class="repost__item repost__item--vk share-network-vk">
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
            }
        },
        mounted() {
            window.vkAsyncInit = function() {
                VK.init({
                    apiId: 51553840
                });
            };
            document.getElementById('btn-podel').addEventListener('click', hClick); // ждём нажатий на кнопку
            setTimeout(function() {
                var el = document.createElement("script");
                el.type = "text/javascript";
                el.src = "https://vk.com/js/api/openapi.js?169";
                el.async = true;
                document.getElementById("vk_api_transport").appendChild(el);
            }, 0);
            let vm = this;

            function hClick() { // обработчик нажатия


                //617865644
                VK.Api.call('wall.post', {
                    message:'Проверка-уникальности. Бесплатная проверка уникальности текста. Все системы в одном месте',
                    }, hPost);
            }

                function hPost(r) { // обработчик окончания выполнения API запроса
                    console.log(r);
                    if (!r) throw "Bad response from VK";
                    if (r.error) { // если отказался постить
                        console.log("Not posted. Error:", r.error);
                    } else if (r.response) {
                        if (r.response.post_id) { // это id свежесозданного поста
                            console.log("Posted with id ", r.response.post_id);
                            bus.$emit('show-promo-modal');
                        } else {
                            console.log("No post id, no idea why", r);
                            bus.$emit('show-promo-modal');
                        }
                    } else {
                        console.log("Not posted, no idea why", r);
                    }
                }
            }
    }
</script>
