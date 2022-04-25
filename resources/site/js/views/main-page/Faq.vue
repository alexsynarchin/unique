<template>
    <section>
        <accordion-item v-for="(item, index) in faqList" :key="index">
            <template v-slot:question>
                {{item.question}}
            </template>
            <template v-slot:answer>
                {{item.answer}}
            </template>
        </accordion-item>
    </section>
</template>
<script>
    import AccordionItem from "../../components/accordion/AccordionItem";
    export default {
        components: {
            AccordionItem,
        },
        data() {
            return {
                faqList: [
                    {
                        question: "Как проверить работу на антиплагиат?",
                        answer: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget dolor lacinia, semper dolor aliquet, luctus neque. Sed sagittis lacus nunc, eu vestibulum elit dignissim id. Donec luctus ornare elit, a elementum erat maximus in. Suspendisse non nunc vel eros consectetur aliquam vel placerat quam. Integer et urna scelerisque, laoreet quam mattis, eleifend tellus. Nunc et arcu at sapien suscipit facilisis. Mauris congue vel arcu id vehicula."
                    },
                    {
                        question: "Как происходит сам процесс оформления заказа?",
                        answer: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget dolor lacinia, semper dolor aliquet, luctus neque. Sed sagittis lacus nunc, eu vestibulum elit dignissim id. Donec luctus ornare elit, a elementum erat maximus in. Suspendisse non nunc vel eros consectetur aliquam vel placerat quam. Integer et urna scelerisque, laoreet quam mattis, eleifend tellus. Nunc et arcu at sapien suscipit facilisis. Mauris congue vel arcu id vehicula."

                    },
                    {
                        question: "Сколько времени занимает проверка? ",
                        answer: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget dolor lacinia, semper dolor aliquet, luctus neque. Sed sagittis lacus nunc, eu vestibulum elit dignissim id. Donec luctus ornare elit, a elementum erat maximus in. Suspendisse non nunc vel eros consectetur aliquam vel placerat quam. Integer et urna scelerisque, laoreet quam mattis, eleifend tellus. Nunc et arcu at sapien suscipit facilisis. Mauris congue vel arcu id vehicula."

                    },
                    {
                        question: "Вы занимаетесь рерайтом?",
                        answer: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget dolor lacinia, semper dolor aliquet, luctus neque. Sed sagittis lacus nunc, eu vestibulum elit dignissim id. Donec luctus ornare elit, a elementum erat maximus in. Suspendisse non nunc vel eros consectetur aliquam vel placerat quam. Integer et urna scelerisque, laoreet quam mattis, eleifend tellus. Nunc et arcu at sapien suscipit facilisis. Mauris congue vel arcu id vehicula."

                    },
                    {
                        question: "Как проверить работу на антиплагиат? Вы можете мне в этом помочь?",
                        answer: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget dolor lacinia, semper dolor aliquet, luctus neque. Sed sagittis lacus nunc, eu vestibulum elit dignissim id. Donec luctus ornare elit, a elementum erat maximus in. Suspendisse non nunc vel eros consectetur aliquam vel placerat quam. Integer et urna scelerisque, laoreet quam mattis, eleifend tellus. Nunc et arcu at sapien suscipit facilisis. Mauris congue vel arcu id vehicula."

                    },
                    {
                        question: "Как проверить работу на антиплагиат?",
                        answer: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget dolor lacinia, semper dolor aliquet, luctus neque. Sed sagittis lacus nunc, eu vestibulum elit dignissim id. Donec luctus ornare elit, a elementum erat maximus in. Suspendisse non nunc vel eros consectetur aliquam vel placerat quam. Integer et urna scelerisque, laoreet quam mattis, eleifend tellus. Nunc et arcu at sapien suscipit facilisis. Mauris congue vel arcu id vehicula."

                    },
                ],
            }
        },
    }
</script>
