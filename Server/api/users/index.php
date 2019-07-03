<?php
include ('../../libs/Users.php');
include ('../../libs/RestServer.php');
$users = new Users();
$users = new RestServer($users);