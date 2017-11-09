<template>
  <div>

    <el-table :data="tableData">
      <el-table-column prop="create_at" label="日期" width="200">
      </el-table-column>
      <el-table-column prop="username" label="用户名" width="200">
      </el-table-column>
      <el-table-column prop="content" label="留言" >
      </el-table-column>
    </el-table>

    <el-pagination
      layout="prev, pager, next"
      :total="pages"
      @current-change="onCurrentChange">
    </el-pagination>

  </div>
</template>

<script>
  import api from '../../util/api.js'

  export default {
    data () {
      return {
        tableData: null,
        pages: 0
      }
    },
    methods: {
      onCurrentChange (page) {
        this.request(page - 1)
      },
      request (page) {
        const size = 10
        api.feedbackList({
          page: page,
          size: size
        }, (res) => {
          if (res.status === 200) {
            const data = res.data
            if (data.code === 0) {
              this.tableData = data.data.list
              this.pages = data.data.pages * size
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
      this.request(0)
    }
  }
</script>