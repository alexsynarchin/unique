<template>
    <section>
        <page-form
            v-if="loaded"
            :form="form"
            :formAction="formAction"
            @submit="closeModal"
        ></page-form>
    </section>

</template>
<script>
import form from "./components/form";
export default {
    components:{
        'PageForm':form,
    },
    props:['id'],
    data() {
        return {
            loaded:false,
            form: {},
            formAction: {
                url: '/api/admin/static-page/' + this.id,
                method: 'put',
            },
        }
    },
    methods:{
        closeModal(value) {
            this.$emit('closeModal',value)
        },
        getFormData() {
            this.$root.isLoading = true;
            return axios.get('/api/admin/static-page/' + this.id)
                .then((response) => {
                    this.form = response.data;
                    this.loaded = true;
                    this.$root.isLoading = false;

                })
        }
    },
    async mounted() {
        await this.getFormData();
    }
}
</script>
