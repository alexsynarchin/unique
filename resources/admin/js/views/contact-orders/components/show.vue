<template>
    <section>
        <div class="mb-2">
            <label>Имя:</label> {{form.name}}
        </div>
        <div class="mb-2">
            <label>Телефон:</label> {{form.phone}}
        </div>
        <div class="mb-2">
            <label>Комментарий:</label><br> {{form.comment}}
        </div>
    </section>
</template>
<script>
    export default {
        props: {
            id: {
                type:Number
            }
        },
        data() {
            return {
                form: {}
            }
        },
        methods: {
            getData() {
                axios.get('/api/admin/contact-order/' + this.id)
                    .then((response) => {
                        this.form = response.data;
                    })
            },
        },
        mounted() {
            this.getData();
        }
    }
</script>
