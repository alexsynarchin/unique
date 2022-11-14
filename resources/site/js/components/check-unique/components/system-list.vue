<template>
    <section>
    <div class="check-systems">
        <div class="check-systems__item" v-for="(item, index) in CheckSystems" >
            <section class="check-system-item" @click.prevent="selectSystem(index, item)">

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
                        <a style="display: block; z-index: 4; position: relative" href="" class="check-system-item__link" @click.stop.prevent="showSystemModal(index, item)">
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
        <button class="btn button check-unique-button" @click.prevent = "checkTextUnique">
            Проверить уникальность полного текста
        </button>
       <div class="mt-3 alert alert-danger" v-if="errors.has('text') || errors.has('length') || errors.has('symbols_count')">
            {{errors.get('text')}}
           {{errors.get('symbols_count')}}
           {{errors.get('length')}}
       </div>
        <select-system-modal ref="select_system_modal" @selectSystem="handleSelected"></select-system-modal>
    </section>
</template>
<script>
    import selectSystemModal from "./SelectSystemModal";
    import { Errors } from  '@/common/js/services/errors.js';
    export default {
        props: {
            stateSelectedSystems: {
                type:Array,
                default(){
                    return []
                } ,
            }
        },
        components: {
            selectSystemModal
        },
        data() {
            return {
                free:false,
                selectedSystemsList:[],
                systemIndex: [],
                CheckSystems: [],
                errors: new Errors(),
            }
        },
        methods: {
            selectSystem(index, item) {
                let checkIndex = this.systemIndex.indexOf(index);
                let selectedSystemIndex = this.selectedSystemsList.findIndex(object => {
                    return item.id === object.id
                })
                if(selectedSystemIndex !== -1) {
                    this.selectedSystemsList.splice(selectedSystemIndex,1);
                }
                if(checkIndex !== -1) {
                    this.systemIndex.splice(checkIndex, 1);
                } else {
                    this.handleSelected({index:index, item: item})

                }
            },
            showSystemModal(index, item) {
                this.$refs.select_system_modal.showSelectSystem(index, item);
            },
            handleSelected(data) {
                let checkIndex = this.systemIndex.indexOf(data.index);
                let selectedSystemIndex = this.selectedSystemsList.findIndex(object => {
                    return data.item.id === object.id
                })
                if(checkIndex === -1 && selectedSystemIndex === -1) {
                    if(this.CheckSystems[data.index].price === 0) {
                        this.systemIndex = [];
                        this.free = true;
                    } else {
                        this.free = false;
                        this.systemIndex.forEach((element, i) =>  {
                            if(this.CheckSystems[element].price === 0) {
                                this.systemIndex.splice(i, 1);
                            }
                        })
                    }
                    this.systemIndex.push(data.index);
                    this.selectedSystemsList = [];
                    this.systemIndex.forEach((element) => {
                        this.selectedSystemsList.push({id:this.CheckSystems[element].id, price:this.CheckSystems[element].price, title:this.CheckSystems[element].title});
                    })
                }

            },
            checkTextUnique() {

                this.$emit('selectSystem', {list:this.selectedSystemsList, free:this.free})
            },
            getSystemsList() {
                axios.get('/api/check-systems')
                    .then((response) => {
                        this.CheckSystems = response.data;
                        if(this.stateSelectedSystems.length > 0) {
                            this.preSelectSystems();
                        }
                    })
            },
            preSelectSystems() {
                this.stateSelectedSystems.forEach((item) => {
                    let index = this.CheckSystems.findIndex(system => {
                        return system.id === item
                    })

                    if(index !==-1) {
                        this.CheckSystems.splice(index, 1);
                    }
                })
            },
        },
        mounted() {
            this.getSystemsList();

        }
    }
</script>
