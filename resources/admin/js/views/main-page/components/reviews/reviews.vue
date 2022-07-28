<template>
    <section class="page-block">
        <el-form ref="form" class="mb-3">
            <el-form-item label="Заголовок">
                <el-input v-model="form.title"></el-input>
            </el-form-item>
            <div class="mt-3">
                <el-button type="success" @click.prevent = "submitForm">Сохранить</el-button>
            </div>
        </el-form>
        <reviews-list></reviews-list>
    </section>
</template>
<script>
import ReviewsList from "./reviews-list/ReviewsList";
export default {
    components: {
        ReviewsList,
    },
    data() {
        return {
            block: {},
            type: 'mp-reviews',
            form: {
               title:"",
            }
        }
    },
    methods: {
        submitForm() {
            axios.put('/api/admin/content-block/' + this.block.id + '/update', this.form)
                .then((response) => {
                    this.$notify({
                        title: 'Блок сохранен',
                        type: 'success'
                    });
                })
                .catch((error) => {

                })
        },
        getBlock() {
            axios.get('/api/admin/content-block/' + this.type)
                .then((response) => {
                    this.block = response.data;
                    for (var key in this.form) {
                        console.log(key);
                        if(this.block.content[key]) {
                            this.form[key] = this.block.content[key];
                        }
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
        }
    },
    async mounted() {
        await this.getBlock();
    },
}
</script>
