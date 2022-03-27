<template>
    <div class="check-systems">
        <div class="check-systems__item" v-for="(item, index) in CheckSystems">
            <section class="check-system-item">
                <div class="check-system-item__checkbox">
                    <label class="check-system-item-checkbox">
                        <input name="" type="checkbox" class="check-system-item-checkbox__input">
                        <span class="check-system-item-checkbox__checkmark"></span>
                    </label>
                </div>
                <div class="check-system-item__content">
                    <div class="check-system-item__mobile-right order-1">
                        <h4 class="check-system-item__title">
                            {{item.name}}
                        </h4>
                        <a :href="item.link" class="check-system-item__link">
                            Подробнее
                        </a>
                        <span class="check-system-item__price check-system-item__price--mobile">
                            {{item.price}}
                        </span>
                    </div>

                    <figure class="check-system-item__logo">
                        <img :src="item.logo">
                    </figure>
                </div>

                <span class="check-system-item__price check-system-item__price--desc">
                    {{item.price}}
                </span>
            </section>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                CheckSystems: [
                    {
                        name:"NASH Antiplagiat",
                        link:"",
                        logo:"/assets/site/images/mp/system-logo-1.png",
                        price:"Бесплатно",
                    },
                    {
                        name:"NASH Antiplagiat",
                        link:"",
                        logo:"/assets/site/images/mp/system-logo-1.png",
                        price:"Бесплатно",
                    },
                    {
                        name:"NASH Antiplagiat",
                        link:"",
                        logo:"/assets/site/images/mp/system-logo-1.png",
                        price:"Бесплатно",
                    },
                    {
                        name:"NASH Antiplagiat",
                        link:"",
                        logo:"/assets/site/images/mp/system-logo-1.png",
                        price:"Бесплатно",
                    },
                    {
                        name:"NASH Antiplagiat",
                        link:"",
                        logo:"/assets/site/images/mp/system-logo-1.png",
                        price:"Бесплатно",
                    },
                    {
                        name:"NASH Antiplagiat",
                        link:"",
                        logo:"/assets/site/images/mp/system-logo-1.png",
                        price:"Бесплатно",
                    },
                    {
                        name:"NASH Antiplagiat",
                        link:"",
                        logo:"/assets/site/images/mp/system-logo-1.png",
                        price:"Бесплатно",
                    },
                    {
                        name:"NASH Antiplagiat",
                        link:"",
                        logo:"/assets/site/images/mp/system-logo-1.png",
                        price:"Бесплатно",
                    },
                ],
            }
        },
    }
</script>
