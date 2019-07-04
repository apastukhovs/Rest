<?php
include_once "Sql.php";
include_once '/home/user4/public_html/Rest/Server/config.php';   
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