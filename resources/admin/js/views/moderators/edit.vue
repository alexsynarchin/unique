<template>
    <section>
        <moderator-form
            v-if="loaded"
            :form="form"
            :formAction="formAction"
            @closeModal="closeModal"
        ></moderator-form>
    </section>

</template>
<script>
import ModeratorForm from "./components/form";
export default {
    components:{
        ModeratorForm
    },
    props:['id'],
    data() {
        return {
            loaded:false,
            form: {

            },
            formAction: {
                url: '/api/admin/moderators/' + this.id,
                method: 'put',
            },
        }
    },
    methods:{
        closeModal(data) {
            this.$emit('closeModal',data)
        },
        getFormData() {
            this.$root.isLoading = true;
            return axios.get('/api/admin/moderators/' + this.id)
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
