<template>
  <el-form :model="form" label-position="top">

      <div class="row">
          <el-form-item class="col-lg-6" prop="free_email_send" label="Платежи для РФ">
              <el-select v-model="form.payment_ru" placeholder="Выбрать">
                  <el-option
                      v-for="item in paymentsRuList"
                      :key="item.value"
                      :label="item.label"
                      :value="item.value">
                  </el-option>
              </el-select>
          </el-form-item>
          <el-form-item class="col-lg-6" prop="free_email_send" label="Платежи для не РФ">
              <el-select v-model="form.payment_not_ru" placeholder="Выбрать">
                  <el-option
                      v-for="item in paymentsNotRuList"
                      :key="item.value"
                      :label="item.label"
                      :value="item.value">
                  </el-option>
              </el-select>
          </el-form-item>

      </div>
      <div class="row mb-4">
          <el-form-item class="col-lg-6" prop="currency_ru" label="Валюта для платежей РФ">
              <el-input v-model="form.currency_ru"></el-input>
          </el-form-item>
          <el-form-item class="col-lg-6" prop="currency_not_ru" label="Валюта для платежей не из  РФ">
              <el-input v-model="form.currency_not_ru"></el-input>
          </el-form-item>
      </div>
      <el-button type="success" @click="submitForm">Сохранить</el-button>
  </el-form>
</template>
<script>
    export default {
        data() {
            return {
                paymentsNotRuList: [
                    {
                        label:'Unitpay',
                        value:'unitpay'
                    },
                    {
                        label:'Robokassa',
                        value:'robokassa'
                    },
                ],
                paymentsRuList: [
                    {
                        label:'Unitpay',
                        value:'unitpay'
                    },
                    {
                        label:'CloudPayments',
                        value:'cloudpayments'
                    },
                ],
                form: {
                    payment_not_ru: '',
                    payment_ru: '',
                    currency_ru: '',
                    currency_not_ru: ''
                }
            }
        },
        methods: {
            submitForm() {
                for(var key in this.form) {
                    axios.post('/api/admin/setting/update',{value:this.form[key], group:'payment',name:key})
                        .then((response) => {

                        })
                        .catch((error)=>{
                            console.log(error);
                        });
                }
                this.$notify({
                    title: 'Основные настройки сохранены',
                    type: 'success'
                });
            },
            getData() {
                axios.get('/api/admin/setting/get', {params: {group:'payment'}})
                    .then((response) => {
                        var data = response.data;
                        for (var key in data) {
                            if(key in this.form){
                                this.form[key] = data[key];
                            }
                        }
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            }
        },
        mounted() {
            this.getData()
        }
    }
</script>
