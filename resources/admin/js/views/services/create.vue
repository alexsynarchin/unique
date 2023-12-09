<template>
    <service-form
        :form="form"
        :form-action="formAction"
        @submit="submit"
    ></service-form>
</template>
<script>
    import ServiceForm from './components/form';
    export default {
        components: {
            ServiceForm,
        },
        data() {
            return {
                form: {
                    title:"",
                    logo: null,
                    price: 0,
                    price_2: 0,
                    description: "",
                },
                formAction: {
                    url: '/api/admin/service',
                    method: 'post',
                },
            }
        },
        methods: {
            submit(data) {
                this.$emit('store', data);
            }
        }

    }
</script>
