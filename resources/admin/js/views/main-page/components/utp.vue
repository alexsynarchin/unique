<template>
    <section class="page-block">
        <el-form ref="form">
            <el-form-item label="Заголовок">
                <el-input v-model="form.title"></el-input>
            </el-form-item>
            <el-form-item label="Описание">

            </el-form-item>
        </el-form>
    </section>
</template>
<script>
    export default {
        data() {
            return {
                form: {
                    title: "",
                    description: "",
                }
            }
        }
    }
</script>
