<template>
    <section>
        <section class="check-unique">
            <section class="check-unique__textarea-wrap">
                <div class="upload-file" v-if="fileName">
                    <span class="upload-file__file-name">{{fileName}}</span>
                    <button class="btn-link btn upload-file__delete" @click="handleFileDelete">Удалить</button>
                </div>
                <textarea class="check-unique__textarea rewrite-text form-control"
                          v-model="text"
                          placeholder="Вставьте ваш текст"></textarea>
                <div class="mt-3 alert alert-danger"
                     v-if="errors.has('file') ||
                           errors.has('plain_text')||
                           errors.has('symbolsCount')">
                    {{errors.get('file')}}
                    {{errors.get('plain_text')}}
                    {{errors.get('symbolsCount')}}
                </div>
            </section>
            <div class="check-unique__actions">

                <div class="check-unique__indicators order-lg-1">
                    <div class="check-unique-indicator">
                        <label class="check-unique-indicator__label">
                            Cтраниц:
                        </label>
                        <span class="check-unique-indicator__value">
                            {{textParams.pages}}
                        </span>
                    </div>
                    <div class="check-unique-indicator">
                        <label class="check-unique-indicator__label">
                            Слов:
                        </label>
                        <span class="check-unique-indicator__value">
                            {{textParams.wordsCount}}
                        </span>
                    </div>
                    <div class="check-unique-indicator">
                        <label class="check-unique-indicator__label">
                            Символов:
                        </label>
                        <span class="check-unique-indicator__value">
                            {{textParams.symbolsCount}}
                        </span>
                    </div>
                </div>
                <div class="upload-button__wrap">

                    <label for="file_rewrite" class="btn button upload-button">
                        <input type="file" id="file_rewrite" ref="file" class="upload-button__input"
                               v-on:change="handleFileUpload()">
                        <svg class="upload-button__icon" viewBox="0 0 20 22">
                            <use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-add-file-icon"></use>
                        </svg>
                        <span class="upload-button__text">
                    Загрузить документ
                    </span>
                    </label>

                </div>
            </div>
        </section>
    </section>
</template>
<script>
import { Errors } from  '@/common/js/services/errors.js';
export default {
    props: {

    },
    data() {
        return {
            text: "",
            file:"",
            fileName: "",
            textParams: {
                symbolsCount: 0,
                wordsCount:0,
                pages:0,
                plainText: "",
            },
            errors: new Errors(),
        }
    },
    watch: {
        text: function(val, oldVal) {
            this.checkUniqueText(val);
        }
    },
    methods: {
        handleFileDelete() {
            console.log('delete files');
            this.file = null;
            this.text = '';
            this.fileName= '';
            this.textParams = {
                symbolsCount: 0,
                wordsCount:0,
                pages:0,
                plainText: "",
            };
            this.$refs.file.value = null;

        },
        createErrors(data) {
            this.errors.record(data);
        },
        handleFileUpload() {
            this.$root.isLoading = true;
            this.file = this.$refs.file.files[0];
            this.fileName = this.file.name;
            const formData = new FormData();
            formData.append('file', this.file);

            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }
            axios.post('/api/check-unique-file', formData, config)
                .then((response) => {
                    this.$root.isLoading = false;
                    this.textParams = response.data;
                    this.$emit('inputText', response.data);
                    this.$emit('inputFile', this.file);
                })
                .catch((error) => {
                    this.$root.isLoading = false;
                    this.errors.record(error.response.data.errors);

                })
        },
        checkUniqueText(text) {
            if(text) {
                axios.post('/api/check-unique', {text: this.text})
                    .then((response) => {
                        this.textParams = response.data;
                        this.$emit('inputText', response.data);
                    })
            }

        },

    },
    mounted() {

    }
}
</script>
