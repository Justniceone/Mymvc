<?php
error_reporting(E_ALL);
//导入框架基础类
require './framework/Base.php';
//实例化框架类
$app = new Base();

//执行框架run
$app->run();