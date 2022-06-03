<template>
<price-list-form
    :action_type="action_type"
    :action_url="action_url"
    :form="form"
    @submit="submitForm"></price-list-form>
</template>
<script>
    import PriceListForm from "./components/PriceListForm";
    export default {
        components: {
            PriceListForm,
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
