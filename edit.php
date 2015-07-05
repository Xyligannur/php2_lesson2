<?php
include_once ('module/db.php');
// Установка параметров, подключение к БД, запуск сессии.
startdb();

// Обработка отправки формы.
if (!empty($_POST))
{
	if (articles_new($_POST['title'], $_POST['content']))
	{
		header('Location: index.php');
		die();
	}
	
	$title = $_POST['title'];
	$content = $_POST['content'];
	$error = true;
}
else
{
	$title = '';
	$content = '';
	$error = false;
}


// Кодировка.
header('Content-type: text/html; charset=utf-8');

// Вывод в шаблон.
include('template/edit.php');
