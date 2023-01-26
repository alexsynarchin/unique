<template>
    <header class="page-header">
        <div class="page-header__logo">
            <div class="page-header-logo__text" >Проверка Уникальности </div>
        </div>
        <section class="page-header__content">
            <div class="page-header__left page-header__container">
                <hamburger id="hamburger-container" :is-active="!sidebar.opened" class="hamburger-container" @toggleClick="toggleSideBar" />
                <breadcrumb id="breadcrumb-container" class="breadcrumb-container" />
            </div>
            <div class="page-header__right page-header__container">
                <el-dropdown class="avatar-container right-menu-item hover-effect" trigger="click">
                    <div class="avatar-wrapper">
                        <img :src="'/assets/admin/images/no-avatar-user.png'" class="user-avatar">
                        <span class="avatar-name">{{name}}</span>
                        <i class="el-icon-caret-bottom" />
                    </div>
                    <el-dropdown-menu slot="dropdown">
                        <router-link to="/">
                            <el-dropdown-item>
                                {{ $t('navbar.dashboard') }}
                            </el-dropdown-item>
                        </router-link>
                        <router-link v-show="userId !== null" :to="`/profile/edit`">
                            <el-dropdown-item>
                                {{ $t('navbar.profile') }}
                            </el-dropdown-item>
                        </router-link>
                        <el-dropdown-item divided>
                            <span style="display:block;" @click="logout">{{ $t('navbar.logOut') }}</span>
                        </el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
            </div>

        </section>
    </header>
</template>
<script>
import { mapGetters } from 'vuex';
import Hamburger from '@/admin/js/components/Hamburger';
import Breadcrumb from '@/admin/js/components/Breadcrumb';
 export default {
     components: {
         Breadcrumb,
         Hamburger,
     },
    computed: {
        ...mapGetters([
            'sidebar',
            'userId',
            'name',
        ]),
    },
     methods: {
         toggleSideBar() {
             this.$store.dispatch('app/toggleSideBar');
         },
         async logout() {
             await this.$store.dispatch('user/logout');
             this.$router.push(`/login?redirect=${this.$route.fullPath}`);
         },
     },
 }
</script>
<style lang="scss" scoped>
.hamburger-container {
    position: relative;
    cursor: pointer;
    width: 37px;
    height: 18px;
    overflow: hidden;
}
.avatar-container {
    margin-right: 30px;

    .avatar-wrapper {
        margin-top: 5px;
        position: relative;
        .avatar-name {
            margin-left: 4px;
        }
        .user-avatar {
            cursor: pointer;
            width: 30px;
            height: 30px;
            border-radius: 100%;
        }

        .el-icon-caret-bottom {
            cursor: pointer;
            position: absolute;
            right: -20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 12px;
        }
    }
}
</style>
