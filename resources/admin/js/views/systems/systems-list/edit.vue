<template>
    <system-form
        :form="form"
        :action-url="actionUrl"
        @save="storeSystem"
        @cancel="cancelEdit"
    >
    </system-form>
</template>
<script>
    import SystemForm from "./form"
    export default {
        props:{
            id:{}
        },
        components: {
            SystemForm,
        },
        data() {
            return {
                actionUrl: '/api/admin/check-system/' + this.id + '/update',
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
              axios.get('/api/admin/check-system/' + this.id + '/show')
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
