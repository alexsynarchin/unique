<template>
    <section>
    <div class="check-systems">
        <div class="check-systems__item" v-for="(item, index) in CheckSystems" >
            <section class="check-system-item" @click.prevent="selectSystem(index, item)">
                <div class="check-system-item__disable" v-if="item.price_ru === 0 && !free_check">
                </div>
                <div class="check-system-item__checkbox">
                    <label class="check-system-item-checkbox">
                        <input autocomplete="off" name="" type="checkbox"
                               class="check-system-item-checkbox__input"
                               :checked="systemIndex.indexOf(index) !== -1" :disabled="!free_check && item.price_ru === 0">
                        <span class="check-system-item-checkbox__checkmark"></span>
                    </label>
                </div>
                <div class="check-system-item__content">
                    <div class="check-system-item__mobile-right order-1">
                        <h4 class="check-system-item__title">
                            {{item.title}}
                        </h4>
                        <a style="display: block; z-index: 4; position: relative" href=""
                           class="check-system-item__link"
                           :class="{'check-system-item__link--disable': !free_check && item.price_ru === 0}"
                           @click.stop.prevent="showSystemModal(index, item)">
                            Подробнее
                        </a>
                        <a style="display: block; z-index: 4; position: relative"
                           v-if="item.report_file"
                           href=""
                           data-bs-toggle="modal"
                           data-bs-target="#report_example"
                           @click="openReportPdf('/storage/check-systems/files/' + item.id + '/' + item.report_file)"
                           class="check-system-item__link">
                            Пример отчета
                        </a>
                        <div class="check-system-item__disable-text--mobile"  v-if="item.price_ru === 0 && !free_check">
                            В период пиковой нагрузки мы вынужденно отключаем бесплатную проверку.
                            Воспользуйтесь одним из платных пакетов.
                        </div>

                        <span class="check-system-item__price check-system-item__price--mobile" :class="{'check-system-item__price--disable': !free_check && item.price === 0}">
                            {{item.price_ru ? item.price_ru + ' руб.' : 'бесплатно'}}
                        </span>
                    </div>

                    <figure class="check-system-item__logo">
                        <img :src="item.logo" :class="{'check-system-item__image--disable': !free_check && item.price_ru === 0}">
                        <div class="check-system-item__disable-text"
                             v-if="item.price_ru === 0
                            && item.price_not_ru === 0
                            && !free_check">
                            В период пиковой нагрузки мы вынужденно отключаем бесплатную проверку.
                            Воспользуйтесь одним из платных пакетов.
                        </div>
                    </figure>
                </div>

                <span class="check-system-item__price check-system-item__price--desc" :class="{'check-system-item__price--disable': !free_check && item.price === 0}">
                    {{item.price_ru ? item.price_ru + 'руб.' : 'бесплатно'}}
                </span>
            </section>
        </div>
    </div>
        <button class="btn button check-unique-button" :disabled="clicked" @click.prevent = "checkTextUnique">
           {{checkUniqueButtonString}}
        </button>
       <div class="mt-3 alert alert-danger"
            v-if="errors.has('text') || errors.has('length') || errors.has('symbols_count')">

            {{errors.get('text')}}
           {{errors.get('symbols_count')}}
           {{errors.get('length')}}
       </div>
        <select-system-modal ref="select_system_modal" @selectSystem="handleSelected"></select-system-modal>
        <report-example :url="example_report_link"></report-example>
    </section>
</template>
<script>
    import $ from "jquery";
    import reportExample from "@/site/js/components/check-unique/components/ReportExample.vue";
    import selectSystemModal from "./SelectSystemModal";
    import { Errors } from  '@/common/js/services/errors.js';
    import { bus } from '@/site/js/services/bus.js';
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
            reportExample,
            selectSystemModal
        },
        computed: {
            checkUniqueButtonString: function () {
                if (this.free) {
                    return 'Проверить уникальность текста бесплатно'
                } else {
                    return 'Проверить уникальность полного текста'
                }
            }
        },
        data() {
            return {
                example_report_link: "",
                free:false,
                selectedSystemsList:[],
                systemIndex: [],
                CheckSystems: [],
                errors: new Errors(),
                free_check:false,
                clicked:false,
            }
        },
        methods: {
            openReportPdf(url) {
              this.example_report_link = url;
            },
            selectSystem(index, item) {
                if(item.price_ru !== 0 || this.free_check ) {
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
                }

            },
            showSystemModal(index, item) {
                if(item.price_ru !== 0 || this.free_check ){
                    this.$refs.select_system_modal.showSelectSystem(index, item);
                }

            },
            handleSelected(data) {

                console.log(data)
                let checkIndex = this.systemIndex.indexOf(data.index);
                let selectedSystemIndex = this.selectedSystemsList.findIndex(object => {
                    return data.item.id === object.id
                })
                if(checkIndex === -1 && selectedSystemIndex === -1) {
                    if(this.CheckSystems[data.index].price_ru === 0) {
                        this.systemIndex = [];
                        this.free = true;
                    } else {
                        this.free = false;
                        this.systemIndex.forEach((element, i) =>  {
                            if(this.CheckSystems[element].price_ru === 0) {
                                this.systemIndex.splice(i, 1);
                            }
                        })
                    }
                    this.systemIndex.push(data.index);
                    this.selectedSystemsList = [];
                    this.systemIndex.forEach((element) => {
                        this.selectedSystemsList.push(
                            {id:this.CheckSystems[element].id,
                                logo: this.CheckSystems[element].logo,
                                price_ru:this.CheckSystems[element].price_ru,
                                price_not_ru:this.CheckSystems[element].price_not_ru,
                                title:this.CheckSystems[element].title
                            });
                    })
                }

            },
            checkTextUnique() {
                this.clicked = true;
                this.$emit('selectSystem', {list:this.selectedSystemsList, free:this.free});
                var that = this;
                setTimeout(function() { that.clicked = false; }, 500);

            },
            getSetting(group, name)
            {
                axios.get('/api/setting/' + group + '/' + name)
                    .then((response) => {
                        this.free_check = response.data;
                    })
            },
            getSystemsList() {
                axios.get('/api/check-systems')
                    .then((response) => {
                        this.CheckSystems = response.data;
                        const searchIndex = response.data.findIndex((system) => system.price_ru===0);
                        bus.$emit('change-symbols-count', response.data[searchIndex].symbols_count);
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
            this.getSetting('common', 'free_check');

        }
    }
</script>
