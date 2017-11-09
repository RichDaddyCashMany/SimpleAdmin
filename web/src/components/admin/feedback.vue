<template>
  <el-form :model="form" :rules="rules" ref="form" label-width="100px" class="form">
    <el-form-item label="留言内容" prop="content">
      <el-input type="textarea" v-model="form.content"></el-input>
    </el-form-item>
    <el-form-item>
      <el-button type="primary" :loading="buttonLoading" @click="submitForm">留言</el-button>
    </el-form-item>
  </el-form>
</template>

<script>
  import api from '../../util/api.js'

  export default {
    data () {
      return {
        buttonLoading: false,
        form: {
          content: ''
        },
        rules: {
          content: [
            {
              validator: (rule, value, callback) => {
                if (value === '') {
                  callback(new Error('请输入留言内容'))
                } else if (value.length > 200) {
                  callback(new Error('留言长度不能大于200个字符'))
                }
                callback()
              },
              trigger: 'blur'
            }
          ]
        }
      }
    },
    methods: {
      submitForm () {
        this.$refs['form'].validate((valid) => {
          if (valid) {
            this.request()
          } else {
            return false
          }
        })
      },
      request () {
        this.buttonLoading = false

        api.feedbackSubmit({
          content: this.form.content
        }, (res) => {
          this.buttonLoading = false

          if (res.status === 200) {
            const data = res.data
            if (data.code === 0) {
              this.$message('留言成功')
              this.form.content = ''
            } else {
              this.$message(data.message)
            }
          } else {
            this.$message('请求超时')
          }
        })
      }
    },
    created: function () {
    }
  }
</script>

<style scoped>
  .el-form {
    width: 500px;
  }
</style>