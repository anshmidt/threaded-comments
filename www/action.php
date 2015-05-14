<?php
include ("db_connect.php"); //Подключение к базе данных

	//получаем переменные из формы	
	$user = $_REQUEST['user'];
	$text = $_REQUEST['text'];
	$ParentId = $_REQUEST['ParentId'];
	$action = $_REQUEST['action'];	
		
	if ($action=="add")
	{
		//добавление данных в базу 		
		$query="INSERT into `comments` VALUES (NULL,'{$ParentId}','{$user}','{$text}',NOW())";
		$result = mysql_query($query);
	}
	
	if ($action=="delete")
	{
		//удаление данных из базы 		
		$result = mysql_query ("DELETE FROM `comments` WHERE id=$text");
	}
?>