<template>
<price-list-form :form="form" @submit="submitForm"></price-list-form>
</template>
<script>
    import PriceListForm from "./components/PriceListForm";
    export default {
        components: {
            PriceListForm,
        },
        data() {
            return {
                form: {
                    title:"",
                    description: "",
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
