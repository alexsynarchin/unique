<template>
    <section class="check-unique-bl" id="check_unique">

        <div class="text-center">
            <h2 class="block-title  check-unique-bl__title">
                Проверить уникальность текста онлайн бесплатно <span class="block-title__cursor"></span>
            </h2>
            <p class="check-unique-bl__text">
                Все системы проверки в одном месте
            </p>
        </div>

        <section class="check-unique">
            <section class="check-unique__textarea-wrap">
                <div class="upload-file" v-if="fileName">
                    <span class="upload-file__file-name">{{fileName}}</span>
                    <button class="btn-link btn upload-file__delete" @click="handleFileDelete">Удалить</button>
                </div>
                <textarea class="check-unique__textarea form-control"
                          v-model="text"
                          :placeholder="symbolsCountString"></textarea>
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
        <google-re-captcha-v3
            v-model="gRecaptchaV3Response"
            ref="captcha3"
            id="contact_us_id"
            action="contact_us"
        ></google-re-captcha-v3>
        <systems-list @selectSystem="handleSelected" ref="systems_list"></systems-list>
        <free-check-modal ref="free_check_modal"></free-check-modal>
        <PayCheckModal ref="pay_check_nodal"></PayCheckModal>
        <CountrySelectModal></CountrySelectModal>
    </section>
</template>
<script>
    import SystemsList from './components/system-list';
    import FreeCheckModal from "./components/FreeCheckModal";
    import PayCheckModal from "./components/PayCheckModal";
    import CountrySelectModal from "./components/CountrySelectModal";
    import { bus } from '@/site/js/services/bus.js';
    import GoogleReCaptchaV3 from '@/js/components/googlerecaptchav3/GoogleReCaptchaV3';
    export default {
        components: {
            SystemsList, FreeCheckModal, PayCheckModal, CountrySelectModal, GoogleReCaptchaV3
        },
        computed: {
            symbolsCountString: function () {
                if(this.symbols_count) {
                    return 'Вставьте текст или загрузите документ до ' +  this.symbols_count + ' символов бесплатно';
                } else {
                    return ""
                }
            },

        },
        data() {
            return {
                gRecaptchaV3Response: null,
                symbols_count: 0,
                systems: [],
                text: "",
                file:"",
                fileName: "",
                textParams: {
                    symbolsCount: 0,
                    wordsCount:0,
                    sentenceCount:0,
                    text_id: null,
                    size:0,
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
                    plainText: "",
                    symbolsCount: 0,
                    wordsCount:0,
                    sentenceCount:0,
                    size:0,
                    pages:0,

                };
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
                    })
            },
            checkUniqueText(text) {
                if(text) {
                    axios.post('/api/check-unique', {text: this.text})
                        .then((response) => {
                          this.textParams = response.data;
                        })
                } else if(!text) {
                    this.textParams = {
                        plainText: "",
                        symbolsCount: 0,
                        wordsCount:0,
                        sentenceCount:0,
                        size:0,
                        pages:0,

                    };
                }

            },
            handleSelected(data) {
                console.log(data);
                axios.post('/api/check-unique/validate-modal',
                    {
                            length: data.list.length,
                            text:this.textParams.plainText,
                            symbols_count:this.textParams.symbolsCount
                    })
                    .then((response) => {
                        if(data.free && data.list.length > 0) {
                            this.$refs.free_check_modal.showModal(this.textParams, data.list);
                        } else if(data.list.length > 0) {
                            this.$refs.pay_check_nodal.showModal(this.textParams, data.list);
                        }
                    })
                    .catch((error) => {
                        this.$refs.systems_list.errors.record(error.response.data.errors);
                    })


            },
            changeSymbolsCount(data) {
                this.symbols_count = data;
            }

        },
        mounted() {

        },
        created() {
            bus.$on('change-symbols-count', this.changeSymbolsCount)
        }
    }
</script>
