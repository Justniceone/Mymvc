<?php

/**
 * Class Db PDO 数据库操作
 */
class Db
{
    private $dbConfig = [
        'db' => 'mysql', //数据库类型
        'host' => 'localhost', //主机名称
        'port' => '3306',
        'user' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'dbname' => 'test',
    ];

    //新增主键id
    public $insertId = null;

    //受影响的条数
    public $number = 0;

    private static $instance = null;

    //pdo单例对象
    private $pdo = null;

    private function __construct($params)
    {
        //初始化连接参数
        $this->dbConfig = array_merge($this->dbConfig,$params);
        //连接数据库
        $this->connect();
    }

    private function __clone(){}

    public static function getInstance($params = [])
    {
        if(self::$instance === null)
        {
            self::$instance = new self($params);
        }
        return self::$instance;
    }

    /**
     *
     */
    private function connect()
    {
        try
        {
            //配置数据源DSN
            $dsn = "{$this->dbConfig['db']}:host={$this->dbConfig['host']};
            port={$this->dbConfig['port']};dbname={$this->dbConfig['dbname']};
            charset={$this->dbConfig['charset']}";

            //创建PDO对象
            $this->pdo = new PDO($dsn,$this->dbConfig['user'],$this->dbConfig['password']);

            //设置默认字符集
            $this->pdo->query("SET NAMES {$this->dbConfig['charset']}");
        }catch (PDOException $e)
        {
            die('数据库连接失败'.$e->getMessage());
        }
    }

    /**
     * @param $sql
     */
    public function execute($sql)
    {
        $affect = $this->pdo->exec($sql);

        if($affect > 0)
        {
            //如果是新增操作,初始化新增id属性
            if($this->pdo->lastInsertId() !==null )
            {
                $this->insertId = $this->pdo->lastInsertId();
            }
            $this->number = $affect;
        }else
        {
            $error = $this->pdo->errorInfo();
            echo '操作失败!'.$error[0].$error[1].$error[2];
        }
    }

    /**
     * @param $sql
     * @return mixed
     */
    public function fetch($sql)
    {
        return  $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param $sql
     * @return mixed
     */
    public function fetchAll($sql)
    {
        return  $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}