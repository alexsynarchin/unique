<template>
    <section>
        <div class="row mb-4">
            <div class="col-md-8">
                <symbols-statistic></symbols-statistic>
            </div>
            <div class="col-md-4">
                <el-card class="box-card" v-loading="data.sum.loading">
                    <div slot="header" class="clearfix">
                        <span>Доход</span>
                    </div>
                    <div class="mp-card__sum">
                        {{data.sum.all}} руб
                    </div>
                    <div class="mp-card-today">
                        <label class="mp-card-today__label">
                            За сегодня:
                        </label>
                        <span class="mp-card-today__value">
                        {{data.sum.sumToday}} руб
                    </span>
                    </div>

                </el-card>
            </div>
        </div>
       <div class="row">
           <div class="col-md-3 mb-3">
               <el-card class="box-card mb-2" v-loading="data.rewrites.loading">
                   <div slot="header" class="clearfix">
                       <span>Заявки на рерайт</span>
                   </div>
                   <div class="mp-card__sum">
                       {{data.rewrites.count}}
                   </div>
                   <div class="mp-card-today">
                       <label class="mp-card-today__label">
                           За сегодня:
                       </label>
                       <span class="mp-card-today__value">
                        {{data.rewrites.countToday}}
                    </span>
                   </div>

               </el-card>
               <el-card class="box-card" v-loading="data.rewrites.loading">
                   <div slot="header" class="clearfix">
                       <span>Последние</span>
                       <ul class="mt-2"  style="margin-left: 0; padding-left: 0; list-style-type: none ">
                           <li
                               v-for="(item, index) in data.rewrites.items"
                               class="d-flex justify-content-between" style="font-size: 13px">
                               <span>
                                   Заявка № {{item.id}}
                               </span>
                               <span>
                                   {{item.created_at | formatDate}}
                               </span>
                           </li>
                       </ul>
                   </div>
               </el-card>
           </div>
           <div class="col-md-3 mb-3">
               <el-card class="box-card mb-2"  v-loading="data.free.loading">
                   <div slot="header" class="clearfix">
                       <span>Бесплатные заявки</span>
                   </div>
                   <div class="mp-card__sum">
                       {{data.free.count}}
                   </div>
                   <div class="mp-card-today">
                       <label class="mp-card-today__label">
                           За сегодня:
                       </label>
                       <span class="mp-card-today__value">
                        {{data.free.countToday}}
                    </span>
                   </div>

               </el-card>
               <el-card class="box-card" v-loading="data.free.loading">
                   <div slot="header" class="clearfix">
                       <span>Последние</span>
                       <ul class="mt-2"  style="margin-left: 0; padding-left: 0; list-style-type: none ">
                           <li
                               v-for="(item, index) in data.free.items"
                               class="d-flex justify-content-between" style="font-size: 13px">
                               <span>
                                   Заявка № {{item.id}}
                               </span>
                               <span>
                                   {{item.formatted_date}}
                               </span>
                           </li>
                       </ul>
                   </div>
               </el-card>
           </div>
           <div class="col-md-3 mb-3">
               <el-card class="box-card mb-2" v-loading="data.auto.loading">
                   <div slot="header" class="clearfix">
                       <span>Автоматические заявки</span>
                   </div>
                   <div class="mp-card__sum">
                       {{data.auto.count}}
                   </div>
                   <div class="mp-card-today">
                       <label class="mp-card-today__label">
                           За сегодня:
                       </label>
                       <span class="mp-card-today__value">
                         {{data.auto.countToday}}
                    </span>
                   </div>

               </el-card>
               <el-card class="box-card" v-loading="data.auto.loading">
                   <div slot="header" class="clearfix">
                       <span>Последние</span>
                       <ul class="mt-2"  style="margin-left: 0; padding-left: 0; list-style-type: none ">
                           <li
                               v-for="(item, index) in data.auto.items"
                               class="d-flex justify-content-between" style="font-size: 12px">
                               <span>
                                   Заявка № {{item.id}}
                               </span>
                               <span>
                                   {{item.formatted_date}}
                               </span>
                           </li>
                       </ul>
                   </div>
               </el-card>
           </div>
           <div class="col-md-3 mb-3">
               <el-card class="box-card mb-2" v-loading="data.manual.loading">
                   <div slot="header" class="clearfix">
                       <span>Ручные заявки</span>
                   </div>
                   <div class="mp-card__sum">
                      {{data.manual.count}}
                   </div>
                   <div class="mp-card-today">
                       <label class="mp-card-today__label">
                           За сегодня:
                       </label>
                       <span class="mp-card-today__value">
                      {{data.manual.countToday}}
                    </span>
                   </div>

               </el-card>
               <el-card class="box-card" v-loading="data.manual.loading">
                   <div slot="header" class="clearfix">
                       <span>Последние</span>
                       <ul class="mt-2"  style="margin-left: 0; padding-left: 0; list-style-type: none ">
                           <li
                               v-for="(item, index) in data.manual.items"
                               class="d-flex justify-content-between" style="font-size: 12px">
                               <span>
                                   Заявка № {{item.id}}
                               </span>
                               <span>
                                   {{item.formatted_date}}
                               </span>
                           </li>
                       </ul>
                   </div>
               </el-card>
           </div>
       </div>
    </section>
</template>
<script>
import { mapGetters } from 'vuex';
import symbolsStatistic from "@/admin/js/components/symbols-statistic/index.vue";
import moment from "moment/moment";
    export default {
        components: {
            symbolsStatistic,
        },
        data() {
            return {
                loaded:false,
                data: {

                    rewrites: {
                        count:0,
                        countToday:0,
                        items:[],
                        loading:true,
                    },
                    sum: {
                        all:0,
                        sumToday:0,
                        loading:true,
                    },
                    auto: {
                        count:0,
                        countToday:0,
                        items:[],
                        loading:true,
                    },
                    free: {
                        count:0,
                        countToday:0,
                        items:[],
                        loading:true,
                    },
                    manual: {
                        count:0,
                        countToday:0,
                        items:[],
                        loading:true,
                    }
                }
            }
        },
        filters: {
            formatDate: function (value) {
                if (value) {
                    return moment(String(value)).format('DD.MM.YYYY hh:mm')
                }
            },
        },
        methods: {
            getData(key) {
                axios.get('/api/admin/dashboard',{params:{type:key}})
                    .then((response) => {
                      this.data[key] = response.data
                        this.data[key].loading = false;
                    })
            },
        },
        mounted() {
            //this.getData();
            for (var key in this.data) {
              this.getData(key);
            }
        }
    }
</script>
