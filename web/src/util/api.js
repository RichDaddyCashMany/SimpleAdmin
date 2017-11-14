import axios from 'axios'
import md5 from 'js-md5'
import router from '../router'

const request = (url, data, callback) => {
  axios.post('/interface/' + url, data)
  .then((response) => {
    if (response &&
      response.status === 200 &&
      response.data.code === 1000) {
      // need login
      router.push({
        name: 'login'
      })
    }
    callback(response)
  })
}

/**
 * reg
 */
const reg = (params, callback) => {
  var data = new URLSearchParams()
  data.append('username', params.username)
  data.append('password', md5(params.password))
  data.append('password2', md5(params.password2))
  data.append('phone', params.phone)
  data.append('email', params.email)

  request('user/reg', data, (response) => {
    callback(response)
  })
}

/**
 * login
 */
const login = (params, callback) => {
  var data = new URLSearchParams()
  data.append('username', params.username)
  data.append('password', md5(params.password))

  request('user/login', data, (response) => {
    if (response &&
      response.status === 200 &&
      response.data.code === 0) {
      localStorage.token = response.data.data.token // save token to localStorage
    }
    callback(response)
  })
}

/**
 * submit feedback
 */
const feedbackSubmit = (params, callback) => {
  var data = new URLSearchParams()
  data.append('content', params.content)
  data.append('token', localStorage.token)

  request('feedback/submit', data, (response) => {
    callback(response)
  })
}

/**
 * 留言列表
 */
const feedbackList = (params, callback) => {
  var data = new URLSearchParams()
  data.append('page', params.page)
  data.append('size', params.size)
  data.append('token', localStorage.token)

  request('feedback/records', data, (response) => {
    callback(response)
  })
}

const api = {
  reg: reg,
  login: login,
  feedbackSubmit: feedbackSubmit,
  feedbackList: feedbackList
}

export default api
