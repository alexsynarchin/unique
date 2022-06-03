<template>
<question-list-form
    :action_type="action_type"
    :action_url="action_url"
    :form="form"
    @submit="submitForm"></question-list-form>
</template>
<script>
    import QuestionListForm from "./components/QuestionListForm";
    export default {
        components: {
            QuestionListForm,
        },
        props: {
            id: {
                type:Number,
            },
        },
        data() {
            return {
                action_type:'post',
                action_url:  '/api/admin/block-lists/'+ this.id +'/store-item',
                form: {
                    question:"",
                    answer: "",
                }
            }
        },
        methods: {
            submitForm(data){

                this.$emit('create', data);
            }
        }
    }
</script>
