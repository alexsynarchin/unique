<template>
    <service-form
        v-if="loaded"
        :form-action="formAction"
        :form="form"
        :save-msg="saveMsg"
        @submit="submit"
    ></service-form>
</template>
<script>
    import ServiceForm from './components/form';
    export default {
        components: {
            ServiceForm,
        },
        props:{
            id: {
                type:Number,
            }
        },
        data() {
            return {
                loaded:false,
                form: {},
                formAction: {
                    url: '/api/admin/service/' + this.id,
                    method: 'put',
                },
                saveMsg: "Информация обновлена"
            }
        },
        methods: {
            getData() {
                axios.get('/api/admin/service/' + this.id)
                    .then((response) => {
                        this.form = response.data;
                        this.loaded = true;
                    })
            },
            submit(data) {
                this.$emit('update', data)
            }
        },
        mounted() {
            this.getData();
        }

    }
</script>
