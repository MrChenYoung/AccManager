<?php


namespace admin\controller\API;
use framework\core\Controller;

class API_BaseController extends Controller
{
    /**
     * 请求失败调用
     * @param $data
     * @return string
     */
    protected function failed($message,$data=[]){
        return $this -> putJson(0,$message,$data);
    }

    /**
     * 请求成功调用
     * @param $data 数据
     * @return string 返回json字符串结果
     */
    protected function success($data){
        return $this -> putJson(200,"成功",$data);
    }

    /**
     * 按json方式输出通信数据
     * @param integer $code 状态码
     * @param string  $message 提示信息
     * @param array   $data 数据
     * @return string 返回值为json数据
     */
    protected function putJson($code, $message = '', $data = ''){
        if (!is_numeric($code)) {
            return '';
        }
        // 返回值默认json
        header('Content-type: application/json');
        $result = array('code' => $code, 'message' => $message, 'data' => $data);
        return json_encode($result);
    }

    // 解密
    public function decrypt(){
        // 密码id
        if (!isset($_GET["pass"])){
            echo $this->failed("需要pass参数");
            die;
        }
        $pass = $_GET["pass"];

        $decryptPass = $this->getDecryptPass($pass);
        echo $this->success($decryptPass);
    }
}