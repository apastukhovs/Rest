<?php

include_once 'Sql.php';
include_once 'MySql.php';
include_once '/home/user4/public_html/Rest/Server/config.php';   
class Users
{
    public function getUsers()
    {
    }
    public function postUsers2()
    {
        header('Content-Type: application/json');
        $ar = ['errors' => 'All is good!'];
        return json_encode($ar);
    }
    public function postUsers()
    {
        $username = $_POST['register-username'];
        $password = $_POST['register-password'];
        if (!$this->isUserExist($username, $password))
        {
            try
            {
                $mysql = new MySQL();
                $mysql->setSql('INSERT INTO Users(id, username, password) VALUE(?, ?, ?)');
                $result = $mysql->insert([0, $username, $password]);
            }
            catch (Exception $e)
            {
                throw new Exception($e->getMessage());
            }
        }
        else
        {
            throw new Exception('The username is alreary exist!');
        }
        return json_encode(['status' => 'success']);
    }
    public function putUsers()
    {
        if (!isset($_SERVER['PHP_AUTH_USER']))
        {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Canceled';
            exit;
        }
        else
        {
            $username = $_SERVER['PHP_AUTH_USER'];
            $password = $_SERVER['PHP_AUTH_PASSWORD'];
            if ($this->isUserExist($username, $password))
            {
                echo json_encode(['username' => $username]);
            }
        }
    }
    public function deleteUsers()
    {
        if (isset($_SERVER['PHP_AUTH_USER']))
        {
            unset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'], $_SERVER['AUTH_TYPE'], $_SERVER['REMOTE_USER']);
            // header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            // exit;
        }
        echo json_encode(['logout' => 'success']);
        exit;
    }
    private function isUserExist($username, $password)
    {
        return true;
    }
}
