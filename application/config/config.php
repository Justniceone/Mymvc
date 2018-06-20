<?php
return [
    /**
     * 数据库配置
     */
    'db' => [
        'user' => 'root',
        'password' => 'root',
        'dbname' => 'test',
    ],

    /**
     * APP应用整体配置
     */
    'app' => [
        'default_platform' => 'home',
    ],

    /**
     * 前台模块配置
     */
    'home' => [
        'default_controller' => 'User',
        'default_action' => 'users',
    ],

    /**
     * 后台模块配置
     */
    'admin' => [
        'default_controller' => 'User',
        'default_action' => 'users',
    ],
];