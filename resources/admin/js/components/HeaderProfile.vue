<template>
    <el-dropdown class="page-header-profile">
            <span class="el-dropdown-link" style="color: #fff">
             {{user.name}} <i class="el-icon-arrow-down el-icon--right"></i>
            </span>
        <el-dropdown-menu slot="dropdown" class="page-header-profile__nav">
            <el-dropdown-item><a href="/admin/profile" class="el-dropdown-menu__link">Профиль</a></el-dropdown-item>
            <el-dropdown-item divided ><a href="" class="el-dropdown-menu__link" @click.prevent="logout">Выход</a></el-dropdown-item>
        </el-dropdown-menu>
    </el-dropdown>
</template>
<script>
export default {
    props:['user'],
    methods: {
        logout: function () {
            axios.post('/api/admin/logout').then(response => {
                console.log(response.data);
                document.location.href= response.data;
            }).catch(error => {

            });
        }
    }
}
</script>
