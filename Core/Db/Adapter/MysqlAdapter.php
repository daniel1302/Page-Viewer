<?php
namespace PageViewer\Core\Db\Adapter;


use PDO;

class MysqlAdapter extends PDO implements DatabaseAdapter
{
    public function __construct($host, $user, $pass, $dbName)
    {
        parent::__construct('mysql:dbname='.$dbName.';host='.$host, $user, $pass);
    }
}