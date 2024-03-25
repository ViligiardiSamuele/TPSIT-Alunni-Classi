<?php

class Database extends MySqli
{
    private static $instance;

    protected $host;
    protected $port;
    protected $user;
    protected $psw;
    protected $dbName;

    public function __construct($host, $user, $psw, $dbName, $port)
    {
        parent::__construct($host, $user, $psw, $dbName, $port);
    }

    public function getIntance()
    {
        if (isset($instance))
            return $instance;
        $instance = new Database(
            DbConfig::$host,
            DbConfig::$user,
            DbConfig::$psw,
            DbConfig::$dbName,
            DbConfig::$port
        );
    }

    //Database::getInstance()->select(new Alunno(),[],['id'=>['<>','1']])
    public function select(DBObject $obj, $fields=[], $where=[], $limit = null) {
        $query[] = "select";
        $query[] = count($fields)?implode(", ",$fields):'*';
        $query[] = "from";        
        $query[] = $obj->getTable();
        $query[] = "where";
        $query[] = count($fields)?implode("AND ",$where):'1';
        if(!is_null($limit)){
            $query[] = 'limit';
            $query[] = $limit;
        }
        
        $sql = implode(" ",$query);
        var_dump($sql); exit;
        $this->query($sql);

    }
}
