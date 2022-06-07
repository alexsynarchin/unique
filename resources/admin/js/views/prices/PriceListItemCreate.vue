<template>
<price-list-item-form
    :action_type="action_type"
    :action_url="action_url"
    :form="form"
    @submit="submitForm"></price-list-item-form>
</template>
<script>
    import PriceListItemForm from "./components/PriceListItemForm";
    export default {
        components: {
            PriceListItemForm,
        },
        props: {
            id: {
                type:Number,
            },
        },
        data() {
            return {
                action_type:'post',
                action_url:  '/api/admin/block-lists/'+ this.id +'/store-item',
                form: {
                    title:"",
                    description: "",
                    price: 0,
                    image: {
                        id: "",
                        link: "",
                    }
                }
            }
        },
        methods: {
            submitForm(data){

                this.$emit('create', data);
            }
        }
    }
</script>
