<template>

    <section class="import-tasks justify-content-between row align-items-center mb-4">
        <div class=" col">
            <label class="upload-file" :class="{'upload-file--error':  fileErrors}">
                <input class="upload-file__input"
                       @change="uploadFile"
                       type="file"
                       ref="file">
                <span class="upload-file__btn el-button upload-file__btn el-button--primary el-button--medium">
                    <i class="el-icon-document"></i>
                    <span>
                        Выберите файл
                    </span>
                </span>
                <span class="upload-file__text">
                        <template v-if="!fileName">
                            {{value ? value : 'Файл не выбран'}}
                        </template>
                        <template v-else>
                             {{fileName}}
                        </template>
                    <template v-if="(fileName && this.file) || value">
                      <el-button icon="el-icon-close" @click.stop.prevent="clearUploadFile">
                        Очистить
                      </el-button>
                    </template>

                </span>
                <span class="upload-file__error" v-if="fileErrors">
                    {{fileErrors}}
                </span>
            </label>
        </div>

    </section>
</template>
<script>

    export default {
       props:['value'],


        data() {
            return {
                fileName: '',
                file:"",
                fileErrors: '',
                fileArr: [],
                successArr: [],
                modalVisible:false,
            }
        },
        methods: {

           changeFileName() {
               let name = "Файл не выбран";
               if(this.file && this.file.name) {
                   name = this.file.name;
               }
               this.fileName = name;
           },
            uploadFile() {

                this.file = this.$refs.file.files[0];
                this.changeFileName();
                this.$emit('fileUpload', this.file);
            },
            ImportFile() {
                const formData = new FormData();
                formData.append('file', this.file);
                formData.append('project_id', this.$route.params.project_id);
                const headers = { 'Content-Type': 'multipart/form-data' };
                axios.post('/api/admin/project-key/import',formData, {headers})
                    .then((response) => {
                        this.errors.clear();
                        this.successArr = response.data.successArr;
                        this.failArr = response.data.failArr;
                        this.modalVisible = true;
                        this.$emit('imported');
                    })
                    .catch((error) => {
                        this.errors.record(error.response.data.errors);
                    })
            },
            clearUploadFile() {
                this.file = "";
                this.$refs.file.value=null;
                this.fileErrors = '';
                this.$emit('clearFile');
            }
        },


    }
</script>
