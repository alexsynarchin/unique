<template>
    <el-dialog
        title="Отправить отчет"
        :visible.sync="dialogVisible"
        width="30%"
        :before-close="handleClose">

        <span slot="footer" class="dialog-footer">
    <el-button @click="dialogVisible = false">Отмена</el-button>
    <el-button type="primary" @click="dialogVisible = false">Отправить</el-button>
  </span>
    </el-dialog>
</template>
<script>
    export default {
        props: {
            id: {}
        },
        data() {
            return {
                dialogVisible:false,
            }
        },
        methods: {
            handleClose() {
                this.dialogVisible = false;
            },
            openModal() {
                this.dialogVisible = true;
            }
        }
    }
</script>
