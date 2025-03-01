<?php
$db_hostname = "127.0.0.1";
//$db_hostname = "localhost";


$db_username = "fit2104";
$db_password = "fit2104";
$db_name = "fit2104_a3_group";

$dsn = "mysql:host=$db_hostname;dbname=$db_name";
$dbh = new PDO($dsn, "$db_username", "$db_password");