<template>
    <promo-form :form="form"
                :action_type="action_type"
                :action_url="action_url"
                @close-modal="closeModal"
                @submit-form="submitForm"
    ></promo-form>
</template>
<script>
    import PromoForm from "./components/form"
    export default {
        components: {
            PromoForm,
        },
        data() {
            return {
                action_type:'post',
                action_url: '/api/promo-codes',
                form: {
                    discount_type:"",
                    range:"",
                    name:"",
                    discount:0,
                    max_count:0
                },
            }
        },
        methods: {
            closeModal() {
                this.$emit('close-modal');
            },
            submitForm(promo_code) {
                this.$emit('create-promo-code', promo_code);
            },
        },
    }
</script>
