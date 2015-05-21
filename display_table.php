<?php header('Content-type: text/html; charset=utf-8')?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="style.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
</head>
<body>
<script>
function DeleteComment(number) //Функция для удаления комментария с id=number
{
	$.ajax({
		type: "POST",
		url: "action.php",					
		data: "user=1"+"&text="+number+"&ParentId=1"+"&action=delete",					
		success: function(html){						
			show_messages();				
		   }
	});
}

function AnswerComment (id) //Отправка номера комментария, на который отвечают
{
	$.ajax({
		type: "POST",
		url: "display_table.php",					
		data: "AnswerId="+id,					
		success: function(html){						
			$("#table_content").html(html);				
		   }
	});		
}

function SendComment () //отправка данных из формы 
{
	var user1 = $("#user").val();
	var text1  = $("#text").val();	
	var ParentId1  = $("#ParentId").val() + "";	
	if (user1 =='' || user1 =='Имя')
	{
		alert ("Введите имя пользователя");
		return false;
	}
	if (text1 =='' || text1 =='Комментарий')
	{
		alert ("Введите текст комментария");
		return false;
	}	
	
	$.ajax({
		type: "POST",
		url: "action.php",					
		data: "user="+user1+"&text="+text1+"&ParentId="+ParentId1+"&action=add",		
		success: function(html){				
			show_messages();
			clean_form();		
				 }
				 
	});
	return false;
}

</script>
<?php
function ShowForm($AnswerCommentId) //Форма для ввода комментария
{
	?><br/>	
	<form id="myForm">	
	<input id="user" name="user" value="Имя" autocomplete="off" 
		onfocus="if(this.value == 'Имя'){this.value = ''}" 
		onblur="if(this.value == ''){this.value = 'Имя'}"/> 				
	<br/><br/>
	<textarea id='text' name='text' value="Комментарий" 
			onfocus="if(this.value == 'Комментарий'){this.value = ''}" 
			onblur="if(this.value == ''){this.value = 'Комментарий'}" >Комментарий</Textarea>		
	<input id="ParentId" name="ParentId" type="hidden" value="<?echo($AnswerCommentId);?>"/>
	<br/>
	<button type='button' OnClick=SendComment()>Отправить</button>
	</form>
	<br/>
	<?
}

include ("db_connect.php"); //Подключение к базе данных

$query="SELECT * FROM `comments` ORDER BY id ASC";
$result = mysql_query($query);

//Чтение номера комментария, на который отвечают, если такой существует
if (isset($_REQUEST['AnswerId']))
{
	$AnswerId = $_REQUEST['AnswerId'];	
}
else
{
	$AnswerId = 0;
}

//Чтение комментариев из базы данных и запись в массив				
$i=0;
while ($mytablerow = mysql_fetch_row($result))
{
	$mytable[$i] = $mytablerow;	
	$i++;	
}

//функция построения дерева комментариев
function tree($treeArray, $level, $pid = 0) 
{
	global $AnswerId;
	
	if (! $treeArray) 
	{
		return;
	}	
	foreach($treeArray as $item) 
	{
		if ($item[1] == $pid)  		
		{
			?> 	
			<!-- Отображение каждого комментария с нужным отступом -->
			<div class="CommentWithReplyDiv" style="margin-left:<?echo($level*60);?>px"> 	
			<div class="CommentDiv">
			<pre class="Message"><? echo($item[3]) ; ?></pre>
			<div class="User"><? echo($item[2]) ; ?></div>
			<div class="Date"><? echo($item[4]) ; ?></div>
			<?				
			if ($level<=4)  //Ограничение уровня вложенности
			{
				echo '<a href="" class="ReplyLink" onclick="AnswerComment('.$item[0].');return false;">Ответить</a>';
			}
			
			echo '<a href="" class="DeleteLink" onclick="DeleteComment('.$item[0].');return false;">Удалить</a>';
			?> </div> <?
			
			//Выводим форму для ответа, если отвечают на данный комментарий
			if ($AnswerId == $item[0])
			{
				?><div id="InnerDiv"><?
				ShowForm($AnswerId);
				?></div><?	
			} 
			
			?> </div> <? 
			echo ('<br/>');
			
			tree($treeArray, $level+1, $item[0]);	//Рекурсия
		}		
	}
}


tree($mytable, 0);

?>
<!-- Форма ответа внизу страницы -->
<br/>
<a href="" id="LeaveCommentLink">Оставить комментарий</a>

<div id="MainAnswerForm" style="display:none">
<?
ShowForm(0);
?>
</div>
<div id="AfterMainAnswerForm">
</div>

<script>
//Появление формы ответа внизу страницы при нажатии на ссылку
$(document).ready(function(){	
    $("#LeaveCommentLink").click(function () {
		$("#InnerDiv").remove();
		$("#MainAnswerForm").slideToggle("normal");
		return false;
    });
});
</script>

</body>
</html>
