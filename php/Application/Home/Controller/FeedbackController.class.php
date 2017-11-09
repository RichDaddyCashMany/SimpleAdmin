<?php
/**
 * Date: 2017/11/7
 */

namespace Home\Controller;

class FeedbackController extends BaseController
{
    public function submit() {
        $this->validToken();

        if ($this->is_empty(I('content'))) {
            $this->jsonReturn(-1, '留言内容不能为空', null);
        }

        $user = M('user')->where(['token' => I('token')])->find();

        $data['content'] = I('content');
        $data['user_id'] = $user['id'];
        $data['username'] = $user['username'];
        $data['create_at'] = time();

        $result = M('feedback')->add($data);

        if (!$result) {
            $this->jsonReturn(-1, '未知错误', null);
        } else {
            $this->jsonReturn(0, '留言成功', null);
        }
    }

    public function records() {
        $this->validToken();

        if (is_null(I('page')) ||
            is_null(I('size'))) {
            $this->jsonReturn(-1, '参数错误', null);
        }

        $from = I('page') * I('size');

        $result = M('feedback')->order('create_at desc')->limit($from, I('size'))->select();

        $arr = [];

        foreach ($result as $item) {
            $name = substr($item['username'], 0, strlen($item['username']) - 2) . '**';
            array_push($arr, ['create_at' => date("Y-m-d H:i:s", $item['create_at']),
            'username' => $name,
            'content' => $item['content']]);
        }

        $count = M('feedback')->count();

        $data['list'] = $arr;
        $data['pages'] = ceil($count / I('size'));

        $this->jsonReturn(0, '查询成功', $data);
    }
}