<template>
  <div class="errPage-container">
    <el-button icon="arrow-left" class="pan-back-btn" @click="back">
      {{ $t('common.back') }}
    </el-button>
    <el-row>
      <el-col :span="12">
        <h1 class="text-jumbo text-ginormous">
          Доступ запрещен
        </h1>
        <ul class="list-unstyled">
          <li>Вернуться на главную:</li>
          <li class="link-type">
            <router-link to="/dashboard">
              На главную
            </router-link>
          </li>
        </ul>
      </el-col>
      <el-col :span="12">

      </el-col>
    </el-row>
    <el-dialog :visible.sync="dialogVisible" title="Casual look">
      <img :src="ewizardClap" class="pan-img">
    </el-dialog>
  </div>
</template>

<script>


export default {
  name: 'Page401',
  data() {
    return {
      ewizardClap: 'https://i.redd.it/7jvcbsfjz1h11.gif',
      dialogVisible: false,
    };
  },
  methods: {
    back() {
      if (this.$route.query.noGoBack) {
        this.$router.push({ path: '/dashboard' });
      } else {
        this.$router.go(-1);
      }
    },
  },
};
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
  .errPage-container {
    width: 800px;
    max-width: 100%;
    margin: 100px auto;
    .pan-back-btn {
      background: #008489;
      color: #fff;
      border: none!important;
    }
    .pan-gif {
      margin: 0 auto;
      display: block;
    }
    .pan-img {
      display: block;
      margin: 0 auto;
      width: 100%;
    }
    .text-jumbo {
      font-size: 60px;
      font-weight: 700;
      color: #484848;
    }
    .list-unstyled {
      font-size: 14px;
      li {
        padding-bottom: 5px;
      }
      a {
        color: #008489;
        text-decoration: none;
        &:hover {
          text-decoration: underline;
        }
      }
    }
  }
</style>
