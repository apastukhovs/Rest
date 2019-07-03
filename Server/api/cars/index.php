<?php
include ('../../libs/Cars.php');
include ('../../libs/RestServer.php');

$cars = new Cars();
$server = new RestServer($cars);
