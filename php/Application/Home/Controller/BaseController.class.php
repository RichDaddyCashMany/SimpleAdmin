<?php
/**
 * Date: 2017/11/7
 */

namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller
{
    protected function jsonReturn ($code ,$message, $data) {
        $json['code'] = $code;
        $json['message'] = $message;
        $json['data'] = $data;

        header("Content-type: application/json; charset=utf-8");
        echo json_encode($json);
        exit();
    }

    protected function validToken() {
        if ($this->is_empty(I('token'))) {
            $this->jsonReturn(1000, '身份过期，请重新登录', null);
        }

        $result = M('user')->where(['token' => I('token')])->find();

        if (!$result) {
            $this->jsonReturn(1000, '身份过期，请重新登录', null);
        }
    }
    
    protected function is_empty($value) {
        if ($value == null ||
            $value == '') {
            return true;
        } else {
            return false;
        }
    }
    
}