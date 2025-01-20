<template>
    <section>

        <smtpItem
            @change-main="changeMain"
            v-for="(group, index) in groups" :key="index" :is-main="group.isMain"
            :settings_group="group.group"></smtpItem>
    </section>
</template>
<script>
import smtpItem from './item.vue'
export default  {
    components: {
      smtpItem,
    },
    data(){
        return {
            groups: [],

        }
    },
    methods: {
        changeMain() {
            this.getData();
            this.$notify({
                title: 'Группа для SMTP изменена',
                type: 'success'
            });
        },
        getData() {
            axios.get('/api/admin/setting/get-smtp', {params: {groups:['smtp', 'smtp_reserve']}})
                .then((response) => {
                    this.groups = response.data;
                })
                .catch((error) => {
                    console.log(error)
                })
        }
    },
    mounted() {
        this.getData();
    }
}

</script>
