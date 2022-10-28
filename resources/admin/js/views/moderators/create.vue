<template>
    <moderator-form
        :form="form"
        :formAction="formAction"
        :closeMsg="'Пользователь добавлен'"
        @close="closeModal"
       ></moderator-form>
</template>
<script>
import ModeratorForm from './components/form'
export default {
    components: {
        ModeratorForm,
    },
    data() {
        return {
            formAction: {
                url: '/api/admin/moderators',
                method: 'post',
            },
            form: {
                email:"",
                name:"",
                surname:"",
                last_name:"",
                password:"",
                password_confirmation:"",
                id:null,
                permissions_arr:[],
            }
        }
    },
    methods: {
        closeModal(data) {
            this.$emit('close', data)
        },
    },
}
</script>
