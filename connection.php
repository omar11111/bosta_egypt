<?php 

$host = 'localhost';
$db_name = 'db_app';
$username ='root';
$pass = '';
$option = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', );

try {
    $con = new PDO("mysql:host=$host;dbname=$db_name",$username,$pass,$option);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $con->query("SET NAMES utf8");
    $con->query("SET CHARACTER SET utf8");
} catch (PDOException $e) {
    echo "Failed".$e->getMassage();
}