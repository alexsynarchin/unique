<template>
    <div>
        <el-form :model="form" label-position="top">
            <el-form-item label="Title">
                <el-input v-model="form.title"></el-input>
            </el-form-item>
            <el-form-item label="Description">
                <el-input type="textarea" v-model="form.description" rows="5"></el-input>
            </el-form-item>
            <el-form-item label="Keywords">
                <el-input type="textarea" v-model="form.keywords" rows="3"></el-input>
            </el-form-item>
        </el-form>

    </div>
</template>
<script>
export default {
    props:['form'],
    data() {
        return {

        }
    }

}
</script>
