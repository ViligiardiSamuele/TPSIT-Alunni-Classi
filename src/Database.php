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

    public static function getInstance()
    {
        if (!isset($instance))
            $instance = new Database(
                DbConfig::$host,
                DbConfig::$user,
                DbConfig::$psw,
                DbConfig::$dbName,
                DbConfig::$port
            );
        return $instance;
    }

    //Database::getInstance()->select(new Alunno(),[],['id'=>['<>','1']])
    public function select(DBObject $obj, $fields = [], $where = [], $limit = null)
    {
        $query[] = "select";
        $query[] = count($fields) ? implode(", ", $fields) : '*';
        $query[] = "from";
        $query[] = $obj->getTable();
        $query[] = "where";
        $query[] = count($fields) ? implode("AND ", $where) : '1';
        if (!is_null($limit)) {
            $query[] = 'limit';
            $query[] = $limit;
        }

        $this->query(implode(" ", $query));
    }

    //Database::getInstance()->insert(new Alunno())
    public function insert(DBObject $obj)
    {
        $query[] = 'insert into';
        $query[] = $obj->getTable();

        // colonne
        $query[] = '(';
        $query[] = implode(',', $obj->getVars());
        $query[] = ')';

        $query[] = 'values';

        // valori
        $query[] = '(';
        $query[] = implode(',', $obj->getValues());
        $query[] = ')';


        return $this->query(implode(" ", $query));
    }
}
