Данный проект представляет собой страницу, на которой можно оставлять комментарии. 

Структура комментариев древовидна, то есть можно отвечать как в корень дискуссии, так и на существующие комментарии: 
ответ будет отображаться в соответствующей ветви. Максимальный уровень вложенности комментариев - 5. 

Комментарии можно удалять. При удалении комментария удаляются все его дочерние комментарии.

Комментарии хранятся в базе данных.
Для отображения комментариев используется рекурсивная функция. 

Добавление и удаление комментариев организовано с помощью Ajax. 
Дерево комментариев обновляется при добавлении/удалении комментариев без перезагрузки страницы.

-----------------------------------
Структура проекта: 

1) page.php - основная страница, на которой отображаются комментарии,
2) display_table.php - файл, вызываемый для отображения комментариев внутри контейнера на page.php,  
3) action.php - осуществляет добавление комментариев в базу данных и удаление их из базы,  
4) db_connect.php - соединение с базой данных,  
5) table_comments.sql - создание в базе данных таблицы для хранения комментариев,
6) style.css - таблица стилей,
7) jquery-1.11.2.min.js - библиотека jQuery,
8) readme.txt - краткое описание проекта.

-------------------------------------
E-mail автора: anshmidt_ilya@list.ru
