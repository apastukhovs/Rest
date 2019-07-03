<?php
include_once "Sql.php";
include_once '/../config.php';   
class MySql extends Sql
{
    function connect()
    {
        $this->setDsn("mysql:host=".HOSTNAME.";dbname=".DBNAME);
        $this->setUsername(USERNAME);
        $this->setPassword(PASSWORD);
        parent::connect();
    }
}