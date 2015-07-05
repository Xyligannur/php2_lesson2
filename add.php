<?php
include_once ('module/db.php');

// Установка параметров, подключение к БД, запуск сессии.
startdb();
// Обработка отправки формы.
if (!empty($_POST))
{
	if (articles_new($_POST['title'], $_POST['content'], $_POST['short'], $_FILE['file']))
	{
		header('Location: index.php');
		die();
	}
	
	$title = $_POST['title'];
	$content = $_POST['content'];
	$short = $_POST['short'];
	$file = $_FILES['file'];
	$error = true;
}
else
{
	$title = '';
	$content = '';
	$short = '';
	$file = '';
	$error = false;
}

// Кодировка.
header('Content-type: text/html; charset=utf-8');

// Вывод в шаблон.
include('template/add.php');
