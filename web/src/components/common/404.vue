<template>
  <div>
    <span @click="onclick">迷路了？点此登录</span>
  </div>
</template>

<style scoped>
  div {
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
  }
  span {
    cursor: pointer;
    font-size: 40px;
    font-weight: 700;
    color: #409EFF;
  }
</style>

<script>
  export default {
    data () {
      return {
      }
    },
    methods: {
      onclick () {
        this.$router.push({
          name: 'login'
        })
      }
    },
    created: function () {
    }
  }
</script>