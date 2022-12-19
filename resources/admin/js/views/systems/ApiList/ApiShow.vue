<template>
    <section>
        test  {{ $route.params.id }}
    </section>
</template>
<script>
    export default {
        data() {
            return {
                item: {},
            }
        },
        methods: {
            getItemData() {

            },
        },

    }
</script>
