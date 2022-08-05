<template>
    <ul class="unique-service-list">
        <li class="unique-service-list__item"
            v-for="(item, index) in serviceList"
        >
            <figure class="unique-service-list__logo-wrap">
                <img v-if="item.logo"
                    :src="item.logo" class="unique-service-list__logo"/>
                <svg viewBox="0 0 24 24"  class="unique-service-list__logo" v-else>
                    <use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-magnifying-glass"></use>
                </svg>
                <span class="unique-service-list__price">
                    {{item.price}} руб
                </span>
            </figure>
            <div class="unique-service-list__content">
                <h4 class="unique-service-list__title">
                    {{item.title}}
                </h4>
                <div class="unique-service-list__description">
                    {{item.description}}
                </div>
            </div>
            <div class="unique-service-list__checkbox">
                <label class="unique-service-checkbox">
                    <input name="" type="checkbox" class="unique-service-checkbox__input" :checked="true">
                    <span class="unique-service-checkbox__checkmark"></span>
                </label>
            </div>
        </li>
    </ul>
</template>
<script>
    export default {
        data() {
            return {
                serviceList: [],
            }
        },
        methods: {
            getServiceList(){
                axios.get('/api/services')
                    .then((response) => {
                        this.serviceList = response.data;
                    })
            },
        },
        mounted() {
            this.getServiceList();
        }
    }
</script>
