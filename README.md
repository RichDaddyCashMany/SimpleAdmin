###
更稳定的vue管理台请移步：
* [管理台前端部分](https://github.com/HJaycee/app_admin)
* [管理台后台部分](https://github.com/HJaycee/app_admin_api)


### 介绍
`前后端分离`后台小网站
>- 前端使用vue+vue-router+element-ui+npm+webpack
>- 后台接口使用php

![预览](http://img2.ph.126.net/IQs28wtCmb3iVjjAI416cQ==/6632691744373838870.gif)

### 安装

```
git clone https://github.com/HJaycee/SimpleAdmin.git
cd SimpleAdmin
npm install
```

### 启动

```
npm run dev
```

### 部署到服务器

```
cd SimpleAdmin
npm run build
// 编译完成后，将dist目录下的文件上传到服务器目录下
```

```
// 因为使用vue-router的hitory模式，服务器需要做相关配置自动重定向到index.html
// apache下创建隐藏文件.htaccess，填以下内容
<IfModule mod_rewrite.c>
  RewriteEngine On
  RewriteBase /
  RewriteRule ^index\.html$ - [L]
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteRule . /index.html [L]
</IfModule>
```



### 前端部分

已实现功能
>- 登录/注册
>- 留言
>- 留言列表
>- 身份过期处理

相关配置

```
/config/index.js // 反向代理
/src/router/index.js // 路由
/url/api.js // 请求接口
```

### 后台部分

>- 环境要求php5
>- 使用ThinkPHP3.2.3
>- 提供前端需要的相关接口：登录接口返回token，其它接口效验token是否过期

### 数据库

```
user // 用户表
feedback // 留言表
```

