<template>
    <api-form
        :form="form"
        :form-action="formAction"
        @save="storeSystem"
        @cancel="cancelEdit"
    >
    </api-form>
</template>
<script>
    import ApiForm from "./form"
    export default {
        props:{
            id:{},
        },
        components: {
            ApiForm,
        },
        data() {
            return {
                formAction: {
                    url: '/api/admin/api-accounts/' + this.id,
                    method: 'put',
                },
                form: {},
                loaded: false,
            }
        },
        methods: {
            cancelEdit() {
                this.$emit('closeModal', 'cancel')
            },
            storeSystem() {
                this.$emit('closeModal', 'save')
            },
            getData() {
              axios.get('/api/admin/api-accounts/' + this.id)
                  .then((response) => {
                      this.form = response.data;
                      this.loaded = true;
                  })
            },
        },
        mounted() {
            this.getData();
        }
    }
</script>
