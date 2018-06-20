<?php
/**
 * 公共模型类
 */
class Model
{
    protected $db = null; //数据库连接对象

    protected $data = null;

    protected $config = [
        'user' => 'root',
        'password' => 'root',
        'dbname' => 'test'
    ]; //配置信息

    public function __construct()
    {
        $this->init(); //连接数据库
    }

    private function init()
    {
        $this->db = Db::getInstance($this->config);
    }

    public function getAll()
    {
        $sql = "select * from users";
        return $this->data = $this->db->fetchAll($sql);
    }

    public function get($id)
    {
        $sql = "select * from users where id = $id";
        return $this->data = $this->db->fetch($sql);
    }
}