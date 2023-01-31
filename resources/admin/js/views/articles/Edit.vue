<template>
    <section>
        <article-form
            v-if="loaded"
            :form="form"
            :formAction="formAction"
            @submit="submit"
        ></article-form>
    </section>
</template>
<script>
import form from './components/form';
export default {
    props: {
        id: {}
    },
    components: {
        'ArticleForm': form,
    },
    data() {
        return {
            loaded:false,
            form: {},
            formAction: {
                url: '/api/admin/article/' + this.id,
                method: 'put',
            },
        }
    },
    methods: {
        submit(data) {
            this.$emit('update',data)
        },
        getFormData() {
            this.$root.isLoading = true;
            return axios.get('/api/admin/article/' + this.id)
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
