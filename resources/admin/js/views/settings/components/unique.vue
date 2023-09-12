<template>
    <section>
        <h3 class="block-title">
            Проверки уникальности
        </h3>
        <div class="mb-3">
            <!--<el-button type="primary" icon="el-icon-upload">Скачать архив платных проверок за последний месяц</el-button>-->
            <el-button type="danger" icon="el-icon-delete" @click.prevent="removeFiles()">Удалить файлы бесплатных проверок (2-ух ненельной давности)</el-button>

            <el-button type="danger" icon="el-icon-delete" @click.prevent="removeFiles()">Удалить файлы платных проверок (месячной давности)</el-button>
        </div>
    </section>
</template>
<script>
export default {
    data() {
        return {

        }
    },
    methods: {
        removeFiles() {
            this.$confirm('Вы уверены что хотите очистить файлы отчетов и текстов для проверок уникальности', 'Очистка файлов', {
                confirmButtonText: 'Очистить',
                cancelButtonText: 'Отмена',
                type: 'warning'
            }).then(() => {
                this.$message({
                    type: 'success',
                    message: 'Задача по очистке запущена'
                });
            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: 'Очистка отменена'
                });
            });
        }
    }
}
</script>
