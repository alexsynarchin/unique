<template>
    <section v-if="loaded">
        <div class="row mb-4">
            <div class="col-md-4">
                <el-card class="box-card">
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
               <el-card class="box-card mb-2">
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
               <el-card class="box-card">
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
                                   {{item.formatted_date}}
                               </span>
                           </li>
                       </ul>
                   </div>
               </el-card>
           </div>
           <div class="col-md-3 mb-3">
               <el-card class="box-card mb-2">
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
               <el-card class="box-card">
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
               <el-card class="box-card mb-2">
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
               <el-card class="box-card">
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
               <el-card class="box-card mb-2">
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
               <el-card class="box-card">
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
    export default {
        data() {
            return {
                loaded:false,
                data: {
                    rewrites: {
                        count:0,
                        countToday:0,
                        items:[],
                    },
                    sum: {
                        all:0,
                        sumToday:0,
                    },
                    auto: {
                        count:0,
                        countToday:0,
                        items:[],
                    },
                    free: {
                        count:0,
                        countToday:0,
                        items:[],
                    },
                    manual: {
                        count:0,
                        countToday:0,
                        items:[],
                    }
                }
            }
        },
        methods: {
            getData() {
                axios.get('/api/admin/home')
                    .then((response) => {

                      this.data = response.data
                        this.loaded = true;
                    })
            },
        },
        mounted() {
            this.getData();
        }
    }
</script>
