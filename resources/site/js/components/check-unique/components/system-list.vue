<template>
    <section>
    <div class="check-systems">
        <div class="check-systems__item" v-for="(item, index) in CheckSystems" @click.prevent="selectSystem(index, item)">
            <section class="check-system-item">

                <div class="check-system-item__checkbox">
                    <label class="check-system-item-checkbox">
                        <input name="" type="checkbox" class="check-system-item-checkbox__input" :checked="systemIndex.indexOf(index) != -1">
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
    </div>
        <button class="btn button" @click.prevent = "checkTextUnique">
            Проверить уникальность полного текста
        </button>
        <select-system-modal ref="select_system_modal" @selectSystem="handleSelected"></select-system-modal>
    </section>
</template>
<script>
    import selectSystemModal from "./SelectSystemModal";
    export default {
        components: {
            selectSystemModal
        },
        data() {
            return {
                free:false,
                selectedSystemsList:[],
                systemIndex: [],
                CheckSystems: [],
            }
        },
        methods: {
            selectSystem(index, item) {
                let checkIndex = this.systemIndex.indexOf(index);
                if(checkIndex !== -1) {
                    this.systemIndex.splice(checkIndex, 1);
                } else {
                    this.$refs.select_system_modal.showSelectSystem(index, item);
                }
            },
            handleSelected(index) {
                if(this.CheckSystems[index].price === 0) {
                    this.systemIndex = [];
                    this.free = true;
                } else {
                   this.systemIndex.forEach((element, i) =>  {
                       if(this.CheckSystems[element].price === 0) {
                          this.systemIndex.splice(i, 1);
                       }
                   })
                }
                this.systemIndex.push(index);
                this.selectedSystemsList = [];
                this.systemIndex.forEach((element) => {
                    this.selectedSystemsList.push({id:this.CheckSystems[element].id, title:this.CheckSystems[element].title});
                })
            },
            checkTextUnique() {
                this.$emit('selectSystem', {list:this.selectedSystemsList, free:this.free})
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
