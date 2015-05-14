<?php
include ("db_connect.php"); //Подключение к базе данных
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="style.css" rel="stylesheet" type="text/css"/>	
	<script type="text/javascript" src="jquery-1.11.2.min.js"></script> 
</head>
<body>

<h1>Комментарии:</h1>
<div id="table_content"> <!-- Контейнер для комментариев -->
</div>
<br/>

<script>  	
	function show_messages() //Функция для вывода в контейнер всех комментариев из базы
	{
		$.ajax({
			url: "display_table.php",
			cache: false,
			success: function(html){
				$("#table_content").html(html);
			}
		});
	} 
	
	function clean_form() //Очистка формы ввода комментария
	{
		$("#user").val('name');
		$("#text").val('comment');
	}
		
	$(document).ready(function(){
		show_messages();
			
	});
</script> 

<?php
mysql_close($link);
?>
</body>
</html>