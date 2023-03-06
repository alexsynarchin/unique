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
            <el-form-item  :error="errors.get('report_file')">
                <el-upload
                    class="upload-demo"
                    ref="upload"
                    action=""
                    :file-list="fileList"
                    :limit="1"
                    :on-change="handleFileChange"
                    :on-remove="handleFileRemove"
                    :on-exceed="clearFiles"
                    :auto-upload="false"
                >
                    <el-button slot="trigger" size="small" type="primary" v-if="!form.report_file ">Прикрепить файл отчета</el-button>

                    <div class="el-upload__tip" slot="tip"></div>
                </el-upload>
            </el-form-item>
        </el-form>

        <span slot="footer" class="dialog-footer">
    <el-button @click="dialogVisible = false">Отмена</el-button>
    <el-button type="primary" @click="sendReport">Отправить</el-button>
  </span>
    </el-dialog>
</template>
<script>
import { Errors } from  '@/common/js/services/errors.js';

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
                    report_file: "",
                },
                errors: new Errors(),
            }
        },
        methods: {
            handleClose() {
                this.dialogVisible = false;
                this.errors.clear('report_file');
            },
            openModal() {
                this.dialogVisible = true;
            },
            sendReport() {
                let formData = new FormData();
                formData.append('report_file', this.form.report_file);
                formData.append('unique_percent', this.form.unique_percent);
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                };
                axios.post('/api/admin/report/' + this.report.id + '/send', formData, config)
                    .then((response) => {
                        console.log(response.data);
                        this.handleClose();
                        this.$emit('refresh-data')

                    })
                    .catch((error) => {
                        this.errors.record(error.response.data.errors);
                    })

            },
            handleFileChange(file, filelist) {

                this.form.report_file = file.raw;
            },
            handleFileRemove(file, fileList) {
               this.form.report_file = "";
            },
            clearFiles(files, fileList) {
                //this.$refs.upload.clearFiles();
                console.log(files)
                console.log(this.$refs.upload);
            }

        },
        mounted() {
            if(this.report.result) {
                this.form.unique_percent = this.report.data.unique;
            }
        }
    }
</script>
