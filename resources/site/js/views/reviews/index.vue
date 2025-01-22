<template>
    <section class="reviews-list row">

        <div class="reviews-list__item col-lg-6" v-for="(item,index) in reviews">
            <review-item :item="item" v-if="!item.banner"></review-item>
            <div class="reviews-list-banner"  v-else>
                <p class="reviews-list-banner__text">
                    Проверьте свой текст на уникальность бесплатно по системе <br>Проверить-уникальность.рф
                </p>
                <a href="/#check_unique" class="btn button reviews-list-banner__btn">Проверка уникальности</a>
                <figure class="reviews-list-banner__logo">
                    <img src="/assets/site/images/reviews/review-banner-logo.png">
                </figure>
            </div>
        </div>
    </section>
</template>
<script>
import { bus } from '@/site/js/services/bus.js';
    import ReviewItem from "../../components/reviews/ReviewItem";
    export default {
        components: {
            ReviewItem,
        },
        data() {
            return {
                filters: {
                    sort:'desc',
                    filter:"all",
                },
                banner: {
                    img: "/assets/site/images/reviews/review-banner.png",
                    banner:true,
                },
                reviews: [],
            }
        },
        methods: {
            applyFilters(data) {
                this.filters[data.type] = data.value;
                this.getReviews();
            },
          getReviews() {

              axios.get('/api/reviews', {params: this.filters})
                  .then((response) => {
                    this.reviews = response.data;
                    if(this.reviews.length > 3) {
                        this.reviews[4] = this.banner;
                    } else {
                        this.reviews.push(this.banner)
                    }
                  })
          },
        },
        mounted() {

            this.getReviews();
        },
        created() {
            bus.$on('reviews-filters', this.applyFilters)
        }
    }
</script>
