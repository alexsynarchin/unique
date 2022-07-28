<template>
    <section class="page-block">
        <el-form ref="form" class="mb-3">
            <el-form-item label="Заголовок списка">
                <el-input v-model="form.list_title"></el-input>
            </el-form-item>
            <div class="mt-3">
                <el-button type="success" @click.prevent = "submitForm">Сохранить</el-button>
            </div>
        </el-form>
       <ProcessList></ProcessList>
    </section>
</template>
<script>
import ProcessList from "./process-list/ProcessList";
export default {
    components: {
        ProcessList,
    },
    data() {
        return {
            block: {},
            type: 'mp-process',
            form: {
                list_title:"",
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
