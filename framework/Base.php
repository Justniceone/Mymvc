<?php
/**
 * 框架基础类,1.读取配置,2自动加载,3请求分发
 */
class Base
{
    //创建run方法
    public function run()
    {
        //加载配置
        $this->loadConfig();
        //注册自动加载
        $this->registerAutoLoader();
        //获取请求参数
        $this->getRequestParams();
        //请求分发
        $this->dispatch();
    }

    private function loadConfig()
    {
        //使用全局变量保存配置信息
        $GLOBALS['config'] = require './application/config/config.php';
    }

    /**
     * 用户自定义类加载
     */
    public function userAutoLoad($classname)
    {
        //框架基础类
        $baseConfig = [
            'Model' => './framework/Model.php',
            'Db' => './framework/Db.php',
        ];

        //判断自动加载的类型,1.基础类,2模型类,3控制器类
       if (isset($baseConfig[$classname]))
       {
           require $baseConfig[$classname];
       }elseif (substr($classname,-5) == 'Model')
       {
           require './application/home/model/'.$classname.'.php';
       }elseif (substr($classname,-10) == 'Controller')
       {
           require './application/home/controller/'.$classname.'.php';
       }
    }

    private function registerAutoLoader()
    {
        spl_autoload_register([$this,'userAutoLoad']);
    }

    private function getRequestParams()
    {
        //请求的平台
        $default_platform = $GLOBALS['config']['app']['default_platform'];
        $platform = isset( $_GET['p'] ) ? $_GET['p'] : $default_platform;
        define('PLATFORM',$platform);
        //请求的控制器
        $default_controller = $GLOBALS['config'][PLATFORM]['default_controller'];
        $controller = isset( $_GET['c'] ) ? $_GET['c'] : $default_controller;
        define('CONTROLLER',$controller);
        //请求的方法
        $default_action = $GLOBALS['config'][PLATFORM]['default_action'];
        $action = isset( $_GET['a'] ) ? $_GET['a']: $default_action;
        define('ACTION',$action);
    }

    private function dispatch()
    {
        //实例化控制器
        $controller_name = CONTROLLER.'Controller';

        $controller = new $controller_name;
        //调用当前方法
        $action_name = ACTION.'action';
        $controller->$action_name();
    }
}