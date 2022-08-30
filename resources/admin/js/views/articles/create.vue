<template>
    <article-form
        :form="form"
        :form-action="formAction"
        @submit="submit"
    ></article-form>
</template>
<script>
import ArticleForm from './components/form';
export default {
    components: {
        ArticleForm,
    },
    data() {
        return {
            form: {
                title:'',
                preview:"",
                date:null,
                slug:'',
                published:true,
                content:{},
                seo:{},

            },
            formAction: {
                url: '/api/admin/article',
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
