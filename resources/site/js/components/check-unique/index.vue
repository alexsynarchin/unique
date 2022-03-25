<template>
    <section class="check-unique-bl">
        <h3 class="block-title  check-unique-bl__title">
            Проверьте текст на уникальность <span class="block-title__cursor"></span>
        </h3>
        <p class="check-unique-bl__text">
            Вставьте или загрузите до 15 000 символов бесплатно
        </p>
        <section class="check-unique">
            <section class="check-unique__textarea-wrap">
                <textarea class="check-unique__textarea form-control" placeholder="Вставьте ваш текст"></textarea>
            </section>
            <div class="check-unique__actions">

                <div class="check-unique__indicators order-lg-1">
                    <div class="check-unique-indicator">
                        <label class="check-unique-indicator__label">
                            Размер:
                        </label>
                        <span class="check-unique-indicator__value">
                            0
                        </span>
                    </div>
                    <div class="check-unique-indicator">
                        <label class="check-unique-indicator__label">
                            Cтраниц:
                        </label>
                        <span class="check-unique-indicator__value">
                            0
                        </span>
                    </div>
                    <div class="check-unique-indicator">
                        <label class="check-unique-indicator__label">
                            Предложений:
                        </label>
                        <span class="check-unique-indicator__value">
                            0
                        </span>
                    </div>
                    <div class="check-unique-indicator">
                        <label class="check-unique-indicator__label">
                            Слов:
                        </label>
                        <span class="check-unique-indicator__value">
                            0
                        </span>
                    </div>
                    <div class="check-unique-indicator">
                        <label class="check-unique-indicator__label">
                            Символов:
                        </label>
                        <span class="check-unique-indicator__value">
                            0
                        </span>
                    </div>
                </div>
                <button class="btn button upload-button">
                    <svg class="upload-button__icon" viewBox="0 0 20 22">
                        <use xlink:href="assets/site/images/sprites.svg?ver=15#sprite-add-file-icon"></use>
                    </svg>
                    <span class="upload-button__text">
                    Загрузить документ
                    </span>
                </button>
            </div>
            <div class="check-unique-descr">
                <figure class="check-unique-descr__icon">
                    <img src="/assets/site/images/chat.png">
                </figure>
                <div class="check-unique-descr__content">
                    <div class="check-unique-descr__text">
                        8 текстов в очереди, вы можете проверить текст без ожидания,
                        выбрав одну или несколько платных систем
                    </div>
                    <button  class="btn btn-link check-unique-descr__link">
                        <span>
                            Какую систему выбрать
                        </span>
                        <svg viewBox="0 0 10 10" class="button__icon">
                            <use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-arrow-dig-top"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </section>
    </section>
</template>
<script>
    export default {

    }
</script>
