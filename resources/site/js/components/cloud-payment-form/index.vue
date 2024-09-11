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
