<template>
    <section class="reviews-list row">
        {{reviews}}
        <div class="reviews-list__item col-lg-6" v-for="(item,index) in reviews">
            <review-item v-if="!item.banner"></review-item>
            <figure class="reviews-list__banner" :style="{backgroundImage:'url(' + item.img + ')'}" v-else>
            </figure>
        </div>
    </section>
</template>
<script>
    import ReviewItem from "../../components/reviews/ReviewItem";
    export default {
        components: {
            ReviewItem,
        },
        data() {
            return {
                banner: {
                    img: "/assets/site/images/reviews/review-banner.png",
                    banner:true,
                },
                reviews: [],
            }
        },
        methods: {
          getReviews() {
              axios.get('/api/reviews')
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
        }
    }
</script>
