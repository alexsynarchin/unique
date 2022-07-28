<template>
    <item-form
        :action_type="action_type"
        :action_url="action_url"
        :form="form"
        @submit="submitForm"></item-form>
</template>
<script>
import ItemForm from "./ItemForm";
export default {
    components: {
       ItemForm,
    },
    props: {
        type: {
            type:String,
        },
    },
    data() {
        return {
            action_type:'post',
            action_url:  '/api/admin/content-block/'+ this.type +'/store',
            form: {
                title:"",
                description: "",
                name:"",
                date:""
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
