<template>
  <div class="container">
    <el-card>
      <div class="head">
        <span>SIMPLE ADMIN</span>
      </div>
      <el-form :model="form" :rules="rules" ref="form" label-width="100px" class="form">
        <el-form-item label="账号" prop="username">
          <el-input v-model="form.username" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item label="密码" prop="password">
          <el-input v-model="form.password" auto-complete="off" type="password"></el-input>
        </el-form-item>
        <el-form-item class="button-container">
          <el-button type="primary" :loading="loginButtonLoading" @click="submitForm">登录</el-button>
          <el-button type="default" @click="onGotoReg">注册</el-button>
        </el-form-item>
      </el-form>
    </el-card>
  </div>
</template>

<script>
  import api from '../../util/api.js'

  export default {
    data () {
      return {
        loginButtonLoading: false,
        form: {
          username: '',
          password: ''
        },
        rules: {
          username: [
            { required: true, message: '请输入账号', trigger: 'blur' }
          ],
          password: [
            { required: true, message: '请输入密码', trigger: 'blur' }
          ]
        }
      }
    },
    methods: {
      submitForm () {
        this.$refs['form'].validate((valid) => {
          if (valid) {
            localStorage.username = this.form.username
            this.requestLogin()
          } else {
            return false
          }
        })
      },
      onGotoReg () {
        this.$router.push({
          name: 'reg'
        })
      },
      requestLogin () {
        this.regButtonLoading = true

        api.login({
          'username': this.form.username,
          'password': this.form.password
        }, (res) => {
          this.regButtonLoading = false

          if (res.status === 200) {
            const data = res.data
            if (data.code === 0) {
              this.$message('登录成功')
              this.$router.push({
                name: 'feedback'
              })
            } else {
              this.$message(data.message)
            }
          } else {
            this.$message('请求超时')
          }
        })
      }
    }
  }
</script>

<style scoped>
  div.container {
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
  }
  .head {
    display: flex;
    justify-content: center;
  }
  .head span {
    height: 60px;
    line-height: 60px;
    color: #409EFF;
    font-size: 24px;
    font-weight: 700;
  }
  .form {
    width: 400px;
    padding: 20px 50px 20px 0;
  }
  .button-container {
    display: flex;
  }
</style>