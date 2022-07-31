<template>
    <section >
        <section class="check-unique">
            <section class="check-unique__textarea-wrap">
                <textarea class="check-unique__textarea rewrite-text form-control"
                          v-model="text"
                          placeholder="Вставьте ваш текст"></textarea>
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
                        <input type="file" id="file_rewrite" ref="file" class="upload-button__input" v-on:change="handleFileUpload()">
                        <svg class="upload-button__icon" viewBox="0 0 20 22">
                            <use xlink:href="assets/site/images/sprites.svg?ver=15#sprite-add-file-icon"></use>
                        </svg>
                        <span class="upload-button__text">
                    Загрузить документ
                    </span>
                    </label>
                    <div class="upload-button__actions" v-if="fileName">
                        <span class="upload-button__file-name">{{fileName}}</span>
                        <button class="btn-link btn upload-button__delete" @click="handleFileDelete">Удалить</button>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>
<script>
export default {
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
            }
        }
    },
    watch: {
        text: function(val, oldVal) {
            this.checkUniqueText(val);
        }
    },
    methods: {
        handleFileDelete() {
            this.file = null;
            this.fileName= '';
            this.textParams = {
                symbolsCount: 0,
                wordsCount:0,
                pages:0,
                plainText: "",
            };
           Array.from(this.$refs.file.files).splice(0, 1);

        },
        handleFileUpload() {
            console.log('test');
            this.file = this.$refs.file.files[0];
            this.fileName = this.file.name;
            const formData = new FormData();
            formData.append('file', this.file);

            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }
            axios.post('/api/check-unique-file', formData, config)
                .then((response) => {
                    this.textParams = response.data;
                    this.$emit('inputText', response.data);
                    this.$emit('inputFile', this.file);
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
