<template>
    <section>
        <system-form
            :form="form"
            :action-url="actionUrl"
            @save="storeSystem"
            @cancel="cancelEdit"
        >
        </system-form>
    </section>
</template>
<script>
    import SystemForm from "./form"
    export default {
        components: {
            SystemForm,
        },
        data() {
            return {
                actionUrl: '/api/admin/check-system/store',
                form: {
                    title: "",
                    description:"",
                    api_id:null,
                    logo:"",
                    price_ru:0,
                    price_not_ru: 0,
                    report_file: '',
                    symbols_count: 100000,
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
