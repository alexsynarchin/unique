<template>
    <section>
        <el-descriptions title="Основная информация" border :column="2">
            <el-descriptions-item label="Имя">{{item.name}}</el-descriptions-item>
            <el-descriptions-item label="E-mail">{{item.email}}</el-descriptions-item>
            <el-descriptions-item label="Необходимые сроки">{{item.date}}</el-descriptions-item>
            <el-descriptions-item label="Статус">
                <el-tag size="small">School</el-tag>
            </el-descriptions-item>
            <el-descriptions-item label="Комментарий">{{item.comment}}</el-descriptions-item>
        </el-descriptions>
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
                item: {}
            }
        },
        methods: {
            getData() {
                axios.get('/api/admin/rewrite/' + this.id)
                    .then((response) => {
                        this.item = response.data;
                    })
            },
        },
        mounted() {
            this.getData();
        }
    }
</script>
