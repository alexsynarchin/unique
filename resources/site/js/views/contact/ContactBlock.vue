<template>
    <section class="contact-block">
        <div class="contact-block-content">
            <div class="contact-block-content__left">
                <div class="contact-item">
                    <figure class="contact-item__icon">
                        <svg viewBox="0 0 24 24" >
                            <use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-phone"></use>
                        </svg>
                    </figure>
                    <span class="contact-item__val">8 800 555 65 65</span>
                </div>
                <div class="contact-item">
                    <figure class="contact-item__icon">
                        <svg viewBox="0 0 24 24" >
                            <use xlink:href="/assets/site/images/sprites.svg?ver=12#sprite-mail-white"></use>
                        </svg>
                    </figure>
                    <span class="contact-item__val">index@mail.com</span>
                </div>
            </div>
            <div class="contact-block-content__right">
                <ul class="contact-social">
                    <li class="contact-social__item">
                        <a href="#" class="contact-social__link">
                            <svg viewBox="0 0 24 24" >
                                <use xlink:href="/assets/site/images/sprites.svg?ver=12#sprite-whatsup-white"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="contact-social__item">
                        <a href="#" class="contact-social__link">
                            <svg viewBox="0 0 24 24" >
                                <use xlink:href="/assets/site/images/sprites.svg?ver=12#sprite-vk-white"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="contact-social__item">
                        <a href="#" class="contact-social__link">
                            <svg viewBox="0 0 24 24" >
                                <use xlink:href="/assets/site/images/sprites.svg?ver=12#sprite-insta-white"></use>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <contact-form></contact-form>
    </section>
</template>
<script>
import ContactForm from "./ContactForm";
    export default {
        components: {
            ContactForm,
        },
    }
</script>
