<template>
    <el-dialog
        title="Отправить отчет"
        :visible.sync="dialogVisible"
        width="30%"
        :before-close="handleClose">
        <el-form :model="form" label-position="top">
            <el-form-item label="Процент уникальности" prop="unique_percent">
                <el-input-number v-model="form.unique_percent" :min="0" :max="100"></el-input-number>
            </el-form-item>
        </el-form>
        <el-upload
            class="upload-demo"
            ref="upload"
            action=""
            :file-list="fileList"
            :limit="1"
            :on-change="onFileChange"
            :auto-upload="false"
            >
            <el-button slot="trigger" size="small" type="primary">Прикрепить файл отчета</el-button>
            <div class="el-upload__tip" slot="tip"></div>
        </el-upload>
        <span slot="footer" class="dialog-footer">
    <el-button @click="dialogVisible = false">Отмена</el-button>
    <el-button type="primary" @click="sendReport">Отправить</el-button>
  </span>
    </el-dialog>
</template>
<script>
    export default {
        props: {
            report: { }
        },
        data() {
            return {
                dialogVisible:false,
                fileList: [],
                form: {
                    unique_percent: 0,
                    file: "",
                }
            }
        },
        methods: {
            handleClose() {
                this.dialogVisible = false;
            },
            openModal() {
                this.dialogVisible = true;
            },
            handleRemove(file, fileList) {
                console.log(file, fileList);
            },
            sendReport() {
                console.log(this.fileList[0].raw)
            },
            onFileChange(file, filelist) {
                console.log(filelist)
            }

        },
        mounted() {
            if(this.report.result) {
                this.form.unique_percent = this.report.data.unique;
            }
        }
    }
</script>
