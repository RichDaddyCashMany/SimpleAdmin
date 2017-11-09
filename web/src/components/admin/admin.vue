<template>
  <el-container>

    <el-container>
      <el-header height="54px">
        <span class="title">SIMPLE ADMIN</span>
        <el-dropdown>
          <span class="el-dropdown-link">
            {{username}}<i class="el-icon-arrow-down el-icon--right"></i>
          </span>
          <el-dropdown-menu slot="dropdown">
            <el-dropdown-item @click.native="onExitAccount">退出登录</el-dropdown-item>
          </el-dropdown-menu>
        </el-dropdown>
      </el-header>
      
      <el-main>
        <!-- 内容区域 -->
        <router-view></router-view>
      </el-main>

    </el-container>

    <el-aside width="150px">
      <el-menu :default-openeds="['1']" :default-active="menuIndex">
        <el-submenu index="1">
          <template slot="title">菜单</template>
          <el-menu-item-group>
            <el-menu-item index="0-0" @click="onNavSelect('feedback')">留言</el-menu-item>
            <el-menu-item index="0-1" @click="onNavSelect('feedbacklist')">留言列表</el-menu-item>
          </el-menu-item-group>
        </el-submenu>
      </el-menu>
    </el-aside>
    
  </el-container>
</template>

<script>
  
  export default {
    data () {
      return {
        menuIndex: '0-0',
        username: localStorage.username
      }
    },
    methods: {
      onNavSelect (page) {
        this.$router.push({
          name: page
        })
      },
      onExitAccount () {
        this.$confirm('是否退出当前账号？', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'default'
        }).then(() => {
          localStorage.removeItem('token')
          this.$router.push({name: 'login'})
        }).catch(() => {
        })
      }
    },
    created: function () {
    },
    beforeRouteEnter: (to, from, next) => {
      // console.log('new: %s, old: %s', JSON.stringify(to), JSON.stringify(from))

      next(vm => {
        if (to.name === 'feedback') {
          vm.menuIndex = '0-0'
        } else if (to.name === 'feedbacklist') {
          vm.menuIndex = '0-1'
        }
      })
    }
  }
</script>

<style scoped>
  .el-dropdown-link {
    cursor: pointer;
    color: white;
  }
  .el-icon-arrow-down {
    font-size: 12px;
  }
  .el-header {
    font-size: 12px;
    position: fixed;
    left: 0;
    right: 0;
    top: 0;
    background-color: rgb(30,47,68);
    color: #333;
    line-height: 54px;
    z-index: 999;
    display: flex;
    justify-content: space-between;
  }
  .title {
    font-size: 14px;
    color: white;
  }
  .el-aside {
    color: #333;
    position: fixed;
    left: 0;
    top: 54px;
    bottom: 0;
    background-color: rgb(248, 248, 248);
  }
  .el-menu {
    border-right: 1px solid rgb(248,248,248);
  }
  .el-main {
    position: absolute;
    left: 150px;
    top: 54px;
    right: 0;
    bottom: 0;
  }
  .el-breadcrumb {
    margin-bottom: 20px;
  }
  .el-table {
    margin-bottom: 20px;
  }
  .el-pagination {
    margin-bottom: 20px;
  }
</style>