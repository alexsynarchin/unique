<template>
    <section>

    </section>
</template>
<script>
    import { bus } from '@/site/js/services/bus.js';
    export default {
        data() {
           return {
               order: {}
           }
        },
        methods: {
            payment(order) {
                console.log(order)
                this.order = order;
                var payments = new cp.CloudPayments({
                    language: "ru-RU",
                    email: "",
                    applePaySupport: false,
                    googlePaySupport: false,
                    yandexPaySupport: false,
                    tinkoffPaySupport: true,
                    tinkoffInstallmentSupport: false,
                    sbpSupport: false
                })
                payments.pay("charge", {
                    //test_api_00000000000000000000002
                    //pk_2180f0785984f6b018ba6da1fe0bd
                    publicId: "pk_2180f0785984f6b018ba6da1fe0bd",
                    description: order.description ? order.description : 'Проверка уникальности',
                    amount: Number(order.sum),
                    currency: "RUB",
                    invoiceId: order.id,
                    email: "",
                    skin: "classic",
                    requireEmail: false,
                    data: {
                    CloudPayments: {
                        CustomerReceipt: {
                            "Items": [
                                {
                                    "label": order.description ? order.description : 'Проверка уникальности', //наименование товара
                                    "price": Number(order.sum), //цена
                                    "quantity": 1.00, //количество
                                    "amount": Number(order.sum), //сумма
                                    "vat": 0, //ставка НДС
                                    "method": 0, // тег-1214 признак способа расчета - признак способа расчета
                                    "object": 0, // тег-1212 признак предмета расчета - признак предмета товара, работы, услуги, платежа, выплаты, иного предмета расчета
                                    "measurementUnit": "шт" //единица измерения
                                }
                            ],
                            "calculationPlace": "проверить-уникальность.рф", //место осуществления расчёта, по умолчанию берется значение из кассы
                            "taxationSystem": 0, //система налогообложения; необязательный, если у вас одна система налогообложения
                            "email": "", //e-mail покупателя, если нужно отправить письмо с чеком
                            "phone": "", //телефон покупателя в любом формате, если нужно отправить сообщение со ссылкой на чек
                            "customerInfo": "", // тег-1227 Покупатель - наименование организации или фамилия, имя, отчество (при наличии), серия и номер паспорта покупателя (клиента)
                            // "customerInn": "7708806063", // тег-1228 ИНН покупателя
                            "isBso": false, //чек является бланком строгой отчётности
                            "AgentSign": null, //признак агента, тег ОФД 1057
                            "amounts":
                                {
                                    "electronic": Number(order.sum), // Сумма оплаты электронными деньгами
                                    "advancePayment": 0.00, // Сумма из предоплаты (зачетом аванса) (2 знака после запятой)
                                    "credit": 0.00, // Сумма постоплатой(в кредит) (2 знака после запятой)
                                    "provision": 0.00 // Сумма оплаты встречным предоставлением (сертификаты, др. мат.ценности) (2 знака после запятой)
                                }
                        }, //онлайн-чек
                    }
                }
                },
                    {
                        onSuccess:  (options) =>  { // success

                            axios.post('/api/cloud-payment/success', {order_id:options.invoiceId})
                                .then((response)=> {
                                    if(response.data) {
                                        window.location.href = response.data;
                                    } else {
                                        this.$toast("Оплата прошла успешно." +
                                            "Наш менеджер свяжется с вами в близжайшее время.", {
                                            timeout: 2000,
                                            type: 'success',
                                            hideProgressBar: true,
                                        });
                                    }

                                })
                        },
                        onFail: (reason, options) =>  { // fail
                            //действие при неуспешной оплате
                        },
                        onComplete:  (paymentResult, options) =>  { //Вызывается как только виджет получает от api.cloudpayments ответ с результатом транзакции.
                          // console.log(paymentResult)
                           // console.log(options);
                        }
                    })

            },
        },
        created() {
            bus.$on('make-cloudpayments', this.payment)
        }
    }
</script>
