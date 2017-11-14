import Vue from 'vue'
import Router from 'vue-router'
import notFound from '@/components/common/404'
import admin from '@/components/admin/admin'
import feedback from '@/components/admin/feedback'
import feedbacklist from '@/components/admin/feedbacklist'
import reg from '@/components/common/reg'
import login from '@/components/common/login'
Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/admin',
      title: '管理台',
      name: 'admin',
      component: admin,
      children: [
        {
          path: 'feedback',
          title: '留言',
          name: 'feedback',
          component: feedback
        },
        {
          path: 'feedbacklist',
          title: '留言列表',
          name: 'feedbacklist',
          component: feedbacklist
        }
      ]
    },
    {
      path: '/login',
      title: '登录',
      name: 'login',
      component: login
    },
    {
      path: '/reg',
      title: '注册',
      name: 'reg',
      component: reg
    },
    {
      path: '/',
      title: '管理台',
      component: admin,
      name: 'admin'
    },
    {
      path: '/404',
      component: notFound,
      name: 'notFound',
      hidden: true
    },
    {
      path: '*',
      hidden: true,
      redirect: { path: '/404' }
    }
  ],
  mode: 'history'
})
