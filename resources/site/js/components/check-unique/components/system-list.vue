<template>
    <div class="check-systems">
        <div class="check-systems__item" v-for="(item, index) in CheckSystems" @click.prevent="selectSystem(index, item)">
            <section class="check-system-item">
                <div class="check-system-item__checkbox">
                    <label class="check-system-item-checkbox">
                        <input name="" type="checkbox" class="check-system-item-checkbox__input" :checked="index === systemIndex">
                        <span class="check-system-item-checkbox__checkmark"></span>
                    </label>
                </div>
                <div class="check-system-item__content">
                    <div class="check-system-item__mobile-right order-1">
                        <h4 class="check-system-item__title">
                            {{item.title}}
                        </h4>
                        <a href="" class="check-system-item__link">
                            Подробнее
                        </a>
                        <span class="check-system-item__price check-system-item__price--mobile">
                            {{item.price ? item.price + ' руб.' : 'бесплатно'}}
                        </span>
                    </div>

                    <figure class="check-system-item__logo">
                        <img :src="item.logo">
                    </figure>
                </div>

                <span class="check-system-item__price check-system-item__price--desc">
                    {{item.price ? item.price + 'руб.' : 'бесплатно'}}
                </span>
            </section>
        </div>
        <select-system-modal ref="select_system_modal" @selectSystem="handleSelected"></select-system-modal>
    </div>
</template>
<script>
    import selectSystemModal from "./SelectSystemModal";
    export default {
        components: {
            selectSystemModal
        },
        data() {
            return {
                systemIndex: null,
                CheckSystems: [],
            }
        },
        methods: {
            selectSystem(index, item) {
                this.$refs.select_system_modal.showSelectSystem(index, item);
            },
            handleSelected(index) {
                this.systemIndex = index;
                this.$emit('selectSystem');
            },
            getSystemsList() {
                axios.get('/api/check-systems')
                    .then((response) => {
                        this.CheckSystems = response.data;
                    })
            },
        },
        mounted() {
            this.getSystemsList();
        }
    }
</script>
