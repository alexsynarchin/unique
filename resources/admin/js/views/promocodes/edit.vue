<template>
    <promo-form :form="form"
                :action_type="action_type"
                :action_url="action_url"
                @close-modal="closeModal"
                @submit-form="submitForm"
    ></promo-form>
</template>
<script>
import PromoForm from './components/form';
export default {
    components: {PromoForm},
    props:['id'],
    data() {
        return {
            form: {},
            action_type: 'put',
            action_url: '/api/admin/promo-codes/' + this.id
        }
    },
    methods: {
        getData() {
            axios.get('/api/admin/promo-codes/' + this.id)
                .then((response) => {
                    this.form = response.data;
                    this.form.range = [response.data.start_time, response.data.end_time]
                })
        },
        closeModal() {

        },
        submitForm(data) {
            this.$emit('edit-promo-code', data);
        },
    },
    mounted() {
        this.getData();
    }
}
</script>
