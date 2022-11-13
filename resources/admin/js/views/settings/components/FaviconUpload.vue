<template>
    <section class="mb-4 mt-4">
        <h4>Фавикон</h4>
        <el-upload
            class="upload-demo"
            action="/api/admin/setting/upload-favicon"
            :on-preview="handlePreview"
            :on-remove="handleRemove"
            :before-remove="beforeRemove"
            multiple
            :limit="3"
            :on-exceed="handleExceed"
            :file-list="fileList">
            <el-button size="small" type="primary">Загрузить</el-button>
            <div slot="tip" class="el-upload__tip">jpg/png Не более чем 500 КБ</div>
        </el-upload>
    </section>
</template>
<script>
    export default {
        data() {
            return {
                fileList:[],
            }
        },
        methods: {
            handleRemove(file, fileList) {
                console.log(file, fileList);
            },
            handlePreview(file) {
                console.log(file);
            },
            handleExceed(files, fileList) {
                this.$message.warning(`The limit is 3, you selected ${files.length} files this time, add up to ${files.length + fileList.length} totally`);
            },
            beforeRemove(file, fileList) {
                return this.$confirm(`Удалить файли ${ file.name } ?`);
            }
        }
    }
</script>
