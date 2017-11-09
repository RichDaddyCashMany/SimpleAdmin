<?php
/**
 * Date: 2017/11/7
 */

namespace Home\Controller;

class UserController extends BaseController
{

    public function login() {

        if ($this->is_empty(I('username')) ||
            $this->is_empty(I('password'))) {
            $this->jsonReturn(-1, '参数错误', null);
        }

        $result = M('user')->where(['username' => I('username')])->find();

        if (!$result) {
            $this->jsonReturn(-1, '账号不存在', null);
        }

        if ($result['password'] != I('password')) {
            $this->jsonReturn(-1, '登录密码错误', null);
        } else {
            $token = md5($result['username'] . $result['password'] . time()); // 返回token

            $ret = M('user')->where(['username' => I('username')])->save(['token' => $token]);

            if ($ret) {
                $this->jsonReturn(0, '登录成功', ['token' => $token]);
            } else {
                $this->jsonReturn(-1, '未知错误', null);
            }
        }

    }
    
    public function reg () {

        if ($this->is_empty(I('username')) ||
            $this->is_empty(I('password')) ||
            $this->is_empty(I('password2'))) {
            $this->jsonReturn(-1, '参数错误', null);
        }

        if (I('password') != I('password2')) {
            $this->jsonReturn(-1, '密码不一致', null);
        }

        $result = M('user')->where(['username' => I('username')])->find();

        if ($result) {
            $this->jsonReturn(-1, '账号已存在', null);
        }

        $data['username'] = I('username');
        $data['password'] = I('password');
        $data['phone'] = I('phone');
        $data['email'] = I('email');
        $data['create_at'] = time();

        $add_ret = M('user')->add($data);

        if (!$add_ret) {
            $this->jsonReturn(-1, '未知错误', null);
        } else {
            $this->jsonReturn(0, '注册成功', null);
        }
    }
}