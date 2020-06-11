<?php

namespace framework\core;

use admin\controller\CreateTablesController;

class Framework
{
    public function __construct($module)
    {
        $GLOBALS["module"] = $module;

        //合并配置文件
        $this -> initConfig();
        //初始化自动加载
        $this -> initAutoload();
        // 初始化数据库信息
        $this -> initDabase();

        //初始化PATH_INFO
        $this -> initPathInfo();

        //初始化路径常量
        $this -> initConst();

        //初始化MCA
        $this -> initMCA();

        // 初始化数据表
        $this->initDbTables();

        //分发请求
        $this -> initDispatch();
    }

    // 配置文件设置
    private function initConfig()
    {
        //1.加载配置文件
        $framework_config = '../'.$GLOBALS["module"].'/config/config.php';
        $config = require_once $framework_config;

        //保存在超全局变量中，函数内、函数外都可以使用
        $GLOBALS['config'] = $config;
    }

    // 初始化自动加载
    private function initAutoload()
    {
        spl_autoload_register(array($this,'userAutoload'));
    }

    // 配置自动加载
    public function userAutoload($class)
    {
        if($class == 'Smarty'){
            require_once '../framework/vendor/smarty/Smarty.class.php';
            return;
        }
        //1. 拆分字符串成数组
        $arr = explode('\\',$class);
        //2. 让需要的类（包含命名空间的）home\controller\GoodsController
        $sub_path = str_replace('\\','/',$class);

        //3. 确定后缀，类后缀是.class.php，接口后缀：.interface.php
        if(substr($arr[count($arr)-1],0,2) == 'i_'){
            $extension = '.interface.php';
        }else{
            $extension = '.class.php';
        }
        //4. 文件名
        $class_file = "../".$sub_path.$extension;
        if(file_exists($class_file)){
            require_once $class_file;
        }
    }

    // 初始化数据库信息
    private function initDabase(){
        // 判断数据库
        $option['host'] = $GLOBALS['config']['host'];
        $option['user'] = $GLOBALS['config']['user'];
        $option['pass'] = $GLOBALS['config']['pass'];
        $option['dbname'] = $GLOBALS['config']['dbname'];
        $option['port'] = $GLOBALS['config']['port'];
        $option['charset'] = $GLOBALS["config"]["charset"];
        $GLOBALS["db_info"] = $option;
    }

    //直接从index.php拷贝过来的
    private function initMCA()
    {
        //访问哪个控制器
        $c = isset($_REQUEST['c']) ? $_REQUEST['c'] : $GLOBALS['config']['default_controller'];
        define('CONTROLLER',$c);

        //访问哪个方法
        $a = isset($_REQUEST['a']) ? $_REQUEST['a'] : $GLOBALS['config']['default_action'];
        define('ACTION',$a);
    }

    // 控制器派发
    private function initDispatch()
    {
        // 获取类名前缀
        $preString = substr(CONTROLLER,0,3);

        //实例化控制器对象
        if (strlen(CONTROLLER) > 0) {
            if ($preString == "API") {
                $controllerName = $GLOBALS["module"].'\\controller\\'.'API\\'.CONTROLLER.'Controller';
            }else {
                $controllerName = $GLOBALS["module"].'\\controller\\'.CONTROLLER.'Controller';
            }
        }

        $controller = new $controllerName;

        //调用控制器的方法
        $a = ACTION;
        $controller -> $a();
    }

    //初始化常量
    private function initConst()
    {
        $root = str_replace('\\','/',getcwd().'/');
        if ($GLOBALS["module"] == "admin"){
            //公共的静态资源路径
            define('PUBLIC_PATH','../public/');
            define('ADMIN',$root);
        }else {
            define('ROOT',$root);
            define('ADMIN',ROOT.'admin/');
            define('HOME',ROOT.'home/');
            define('FRAMEWORK',ROOT.'framework/');
            //公共的静态资源路径
            define('PUBLIC_PATH',ROOT.'public/');
        }
    }

    //初始化index.php后面的参数，PATHINFO
    private function initPathInfo()
    {
        if(isset($_SERVER['PATH_INFO']) && $info = $_SERVER['PATH_INFO']){
            //再处理: /home/index/index.html
            //1. 先将.html替换掉
            $extension = strrchr($info,'.');
            $path = str_replace($extension,'',$info);

            //2. 再将左边的 / 去掉： /home/index/index
            $path = substr($path,1); //   home/index/index

            //3. 炸开，炸成一个数组
            $arr = explode('/',$path);
            $count = count($arr);
            if($count == 3){
                $_REQUEST['m'] = $arr[0];
                $_REQUEST['c'] = $arr[1];
                $_REQUEST['a'] = $arr[2];
            }else if($count==2){
                $_REQUEST['m'] = $arr[0];
                $_REQUEST['c'] = $arr[1];
            }else if($count==1){
                $_REQUEST['m'] = $arr[0];
            }else{
                //大于3个情况：/home/index/index/page/5
                //从第三个参数之后，每2个是一对参数：
                $_REQUEST['m'] = $arr[0];
                $_REQUEST['c'] = $arr[1];
                $_REQUEST['a'] = $arr[2];

               for($i=3;$i<$count;$i+=2){
                   $_REQUEST[$arr[$i]] = $arr[$i+1];
               }
            }
        }

    }

    // 初始化数据表
    private function initDbTables(){
        new CreateTablesController();
    }
}