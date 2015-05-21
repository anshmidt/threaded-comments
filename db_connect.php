<?php
//Соединение с базой данных
$db='test'; //база данных
$host = 'localhost'; 
$user = 'comments';
$password = '123';
$link=mysql_connect($host,$user,$password);
mysql_query('SET NAMES utf8');
if ( !$link )
	die ('Невозможно соединиться с сервером MySQL!');
mysql_select_db($db) or die ('Не удалось найти базу данных');
?>
