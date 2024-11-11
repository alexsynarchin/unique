<template>
    <div class="cloudPayments-payment-page ">

        <h1 class="page-title text-center">
            Оплата проверки уникальности
        </h1>
        <div id="element"  class="cloudPayments-payment-page__form"></div>
    </div>
</template>
<script>
    export default {
        props: {
            order: {
                type:Object
            }
        },
        data() {
            return {

            }
        },
        created() {

        },
        mounted() {
            var blocksApp = new cp.PaymentBlocks({
                publicId: "pk_2180f0785984f6b018ba6da1fe0bd",
                description: "Оплата проверки уникальности",
                amount: this.order.sum,
                currency: "RUB",
                invoiceId: this.order.id,
               // debug:true,
                email: "",
                requireEmail: false,
                language: "ru-RU",
                applePaySupport: false,
                googlePaySupport: false,
                yandexPaySupport: false,
                tinkoffPaySupport: false,
                sbpSupport: false,
                data: {
                    CloudPayments: {
                        CustomerReceipt: {
                            "Items": [
                                {
                                    "label": "Проверка уникальности", //наименование товара
                                    "price": this.order.sum, //цена
                                    "quantity": 1.00, //количество
                                    "amount": this.order.sum, //сумма
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
                                    "electronic": this.order.sum, // Сумма оплаты электронными деньгами
                                    "advancePayment": 0.00, // Сумма из предоплаты (зачетом аванса) (2 знака после запятой)
                                    "credit": 0.00, // Сумма постоплатой(в кредит) (2 знака после запятой)
                                    "provision": 0.00 // Сумма оплаты встречным предоставлением (сертификаты, др. мат.ценности) (2 знака после запятой)
                                }
                        }, //онлайн-чек
                    }
                },
            }, {
                appearance: {
                    colors: {
                        primaryButtonColor: "#2e71fc",
                        primaryButtonTextColor: "#ffffff",
                        primaryHoverButtonColor: "#2e71fc",
                        primaryButtonHoverTextColor: "#ffffff",
                        activeInputColor: "#0b1e46",
                        inputBackground: "#ffffff",
                        inputColor: "#8c949f",
                        inputBorderColor: "#e2e8ef",
                        errorColor: "#eb5757"
                    },
                    borders: {
                        radius: "8px"
                    }
                },
                components: {
                    paymentButton: {
                        text: "Оплатить",
                        fontSize: "16px"
                    },
                    paymentForm: {
                        labelFontSize: "16px",
                        activeLabelFontSize: "12px",
                        fontSize: "16px"
                    }
                }
            });

            blocksApp.mount(document.getElementById("element"));
            blocksApp.on("destroy", () => {
                console.log("destroy");
            });
            blocksApp.on("success", (result) => {
               axios.post('/api/cloud-payment/success', {order_id:this.order.id})
                   .then((response)=> {
                       window.location.href = response.data;
                   })
            });
            blocksApp.on("fail", (result) => {
                console.log("fail", result);
            });
        }
    }
</script>
