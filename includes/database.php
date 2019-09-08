<?php
//Connect to Database
$db_host = 'localhost';
$db_name = 'test';
$db_user = 'root';
$db_pass = 'HAPPYsummer67';

//Create mysqli Object
$mysqli = new mysqli($db_host,$db_user,$db_pass,$db_name);

//Deal with Error
if(mysqli_connect_errno()){
	echo 'This Connection was denied by MySQL'. mysqli1_connect_error();
	die();
}