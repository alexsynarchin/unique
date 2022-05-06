<template>
    <section class="check-unique-bl" id="check_unique">
        <h3 class="block-title  check-unique-bl__title">
            Проверьте текст на уникальность <span class="block-title__cursor"></span>
        </h3>
        <p class="check-unique-bl__text">
            Вставьте или загрузите до 15 000 символов бесплатно
        </p>
        <section class="check-unique">
            <section class="check-unique__textarea-wrap">
                <textarea class="check-unique__textarea form-control"
                          v-model="text"
                          placeholder="Вставьте ваш текст"></textarea>
            </section>
            <div class="check-unique__actions">

                <div class="check-unique__indicators order-lg-1">
                    <div class="check-unique-indicator">
                        <label class="check-unique-indicator__label">
                            Размер:
                        </label>
                        <span class="check-unique-indicator__value">
                            {{textParams.size}}
                        </span>
                    </div>
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
                            Предложений:
                        </label>
                        <span class="check-unique-indicator__value">
                            {{ textParams.sentenceCount }}
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

                    <label for="file" class="btn button upload-button">
                        <input type="file" id="file" ref="file" class="upload-button__input" v-on:change="handleFileUpload()">
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
        <div class="check-unique-descr">
            <figure class="check-unique-descr__icon">
                <img src="/assets/site/images/chat.png">
            </figure>
            <div class="check-unique-descr__content">
                <div class="check-unique-descr__text">
                    8 текстов в очереди, вы можете проверить текст без ожидания,
                    выбрав одну или несколько платных систем
                </div>
                <button  class="btn btn-link check-unique-descr__link" data-bs-toggle="modal" data-bs-target="#what_system_check">
                        <span>
                            Какую систему выбрать
                        </span>
                    <svg viewBox="0 0 10 10" class="check-unique-descr__link-icon">
                        <use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-arrow-dig-top"></use>
                    </svg>
                </button>
            </div>
        </div>
        <systems-list></systems-list>
        <button class="btn button">
            Проверить уникальность полного текста
        </button>
    </section>
</template>
<script>
    import SystemsList from './components/system-list'
    export default {
        components: {
            SystemsList,
        },
        data() {
            return {
                index: 0,
                text: "",
                file:"",
                fileName: "",
                textParams: {
                    symbolsCount: 0,
                    wordsCount:0,
                    sentenceCount:0,
                    size:0,
                    pages:0,

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
                    sentenceCount:0,
                    size:0,
                    pages:0,

                };
            },
            handleFileUpload() {
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
                    })
            },
            checkUniqueText(text) {
                if(text) {
                    axios.post('/api/check-unique', {text: this.text})
                        .then((response) => {
                          this.textParams = response.data;
                        })
                }

            },
        },
    }
</script>
