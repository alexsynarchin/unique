<template>
    <section>
        <api-form
            :form="form"
            :formAction="formAction"
            @save="storeSystem"
            @cancel="cancelEdit"
        >
        </api-form>
    </section>
</template>
<script>
    import ApiForm from "./form"
    export default {
        components: {
            ApiForm,
        },
        props: {
            api_id: {},
        },
        data() {
            return {
                formAction: {
                    url: '/api/admin/api-accounts',
                    method: 'post',
                },
                form: {
                    email:"",
                    key:"",
                    password:"",
                    api_id: this.api_id
                },
            }
        },
        methods: {
            cancelEdit() {
                this.$emit('closeModal', 'cancel')
            },
            storeSystem() {
                this.$emit('closeModal', 'save')
            }
        }
    }
</script>
