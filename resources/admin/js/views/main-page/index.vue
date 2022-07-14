<template>
    <section>
        <h1>
            Настройки главной
        </h1>
        <el-form :model="form">

        </el-form>
    </section>
</template>
<script>
    import utp from "./components/utp";
export default {
    components: {
        utp,
    },
    data() {
     return {
        form: {

        }
     }
 }
}
</script>
