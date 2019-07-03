<?php
include ('../../libs/Orders.php');
include ('../../libs/RestServer.php');

$orders = new Orders();
$server = new RestServer($orders);
