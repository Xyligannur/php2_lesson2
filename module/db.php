<?php

$link = null;

function startdb(){
global $link;

setlocale(LC_ALL, 'ru_RU.UTF-8');
mb_internal_encoding('UTF-8');

$conf = parse_ini_file('./conf.ini');
$link = mysqli_connect($conf['host'],$conf['user'],$conf['pass'],$conf['db']) or die('Нет подключения к $dbName');

mysqli_query($link, 'SET NAMES utf8');
mysqli_query($link, 'SET CHARACTER SET utf8');
}

//Вывод всех новостей
 function articles_all(){
 	global $link;


	$result = mysqli_query($link,'SELECT * from lesson2 ORDER BY id DESC ');
    while($row = mysqli_fetch_assoc($result)){
        
        echo '<img src="'.'img_small/'.$row['img'] . '"' . 'alt= ""' . '>';
    	echo "<div class='title'> <h4>Название: ".$row['title']."</h4><br></div>";
        echo "<div class='content'> <strong>Краткое описание:</strong> ".$row ['short']."<br><br></div>";
        echo "<p><em class='time'>Дата добавления: ".$row ['time']."</em>";
        echo '<a class="acont" href ="'."view.php?id=" . $row['id'] . '"' .'>Читать далее</a>';
        echo '<a class="acontdel" href ="'."delete.php?id=" . $row['id'] . '"' .'>Удалить статью</a>';
        echo '<a class="aedit" href ="'."edit.php?id=" . $row['id'] . '"' .'>Изменить статью</a></p>';
        echo "<hr>";
    }
 }

 function view(){

 	global $link;
 	        if(isset($_GET['id'])){

        	$view = $_GET['id'];
        	$res = mysqli_query($link, "SELECT title, short, content, time, img FROM lesson2 WHERE id=$view");
        	$row = mysqli_fetch_assoc($res);
}
		echo "<div class='title'> <h1>".$row['title']."</h1><br></div>";
		echo "<hr>";
		echo '<img src="'.'img_small/'.$row['img'] . '"' . 'alt= ""' . '>';
		echo "<div class='content'> <p>".$row ['content']."</p><br><br></div>";
		echo "<p><em class='time'>Дата добавления: ".$row ['time']."</em>";
 }

function articles_new($title, $short, $content, $img){
	global $link;
	// Подготовка.
	$title = trim($title);
	$content = trim($content);
	// $img = trim($img);
	// $short = trim($short);

	// Проверка.
	if ($title == '')
		return false;
	
	// Запрос.
	$t = "INSERT INTO lesson2 (title, short, content, img) VALUES ('%s', '%s', '%s', '%s')";
	
	$query = sprintf($t, 
	                 mysqli_real_escape_string($link, $title),
	                 mysqli_real_escape_string($link, $short),
	                 mysqli_real_escape_string($link, $content),
					 mysqli_real_escape_string($link, $img));
	
	$result = mysqli_query($link, $query);
							
	if (!$result)
		die(mysqli_error($link));
		
	return true;
}
function delete_view(){
	global $link;
if(isset($_GET['id'])){
	$view = $_GET['id'];
	$result = mysqli_query($link, "DELETE FROM lesson2 WHERE id=$view");
	if ( $result) 
	  {
	  echo  "<h1>Запись удалена</h1>";
	  }
	  else
	  {
	  echo  "<h1>Запись не удалена: ".mysqli_error($link)."</h1>";

	  }
}
}

function edit_view($title, $content){
	global $link;
	// Подготовка.
if(isset($_POST['id'])){
	$view = $_POST['id'];
	$result = mysqli_query($link, "UPDATE lesson2 SET title = '$title', content = '$content' WHERE id='$view'");
	if ( $result == true ) 
	  {
	  $_SESSION['msg'] = "<p>Название и содержимое изменено!</p>";
	  header("Location: index.php");
	  }
	  else
	  {
	  $_SESSION['msg'] = "<p>Название и содержимое не изменено!: ".mysqli_error($link)."</p>";
	  header("Location: index.php");

	  }
}
}

// ================Функция создания миниатюры=================== 
function resize($source){
	global $link;
  $nw = 320; //Ширина миниатюры
  $nh = 240; //Высота миниатюры
  $dest = "./img_small/$source"; //
  $source = "./upload/$source";
  $stype = explode(".", $source);
  $stype = $stype [count($stype) -1];//
  $size = getimagesize($source);
  $w = $size[0];
  $h = $size[1];
  switch ($stype) {
    case 'gif':
      $simg = imagecreatefromgif($source);
      break;
    
    case 'jpg':
      $simg = imagecreatefromjpeg($source);
      break;

    case 'png':
      $simg = imagecreatefrompng($source);
      break;
  }
  $dimg = imagecreatetruecolor($nw, $nh);
  $wm = $w/$nw;
  $hm = $h/$nh;
  $h_height = $nh/2;
  $w_height = $nw/2;

  if($w > $h){
    $adjusted_width = $w / $hm;
    $half_width = $adjusted_width / 2;
    $int_width = $half_width - $w_height;
    imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);

  }elseif (($w < $h) || ($w == $h)){
    $adjusted_height = $h / $wm;
    $half_height = $adjusted_height / 2;
    $int_height = $half_height - $h_height;
    imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);

  }else{
    imagecopyresampled($dimg, $simg, 0, 0, 0, 0, $nw, $nh, $w, $h);
  }
  imagejpeg($dimg, $dest, 100);
  }
// =======================Транслитирация==========================

    function translate($string) {
    	global $link;
        $replace = array(
        "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
        "Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
        "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
        "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
        "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
        "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
        "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
        "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
        "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
        "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
        " "=>"_", "-"=>"_"
        );
        
        $string = mb_strtolower($string, 'utf-8'); //Переводим строку в нижний регистр
        return strtr($string, $replace);
        
    }


// ====Функция проверки файла на размер, тип, изменения названия====
  function upload_file($file){
  	global $link;
  if ($file['name'] == ''){
    echo 'Файл не выбран!';
  return;
  }

  elseif ($file['size'] >= 1048576){ // 1 мб
    echo "Размер файла привышает 1024кб!";
  return;
  }

  elseif (($file['type'] != "image/jpg") and ($file['type'] != "image/jpeg") and ($file['type'] != "image/png") and ($file['type'] != "image/gif")){
    echo "Загружать файлы только с расширением jpg, png, gif!";
  return;
  }

  $newfalename = date('d_m_Y_H_i_s').$file['name'];
  $newfalename = translate($newfalename);
  $uploadfile = "./upload/".$newfalename;
  if(move_uploaded_file($file['tmp_name'], $uploadfile)){
    if (resize ($newfalename)){
      echo '<center>Миниатюра создана.</center>';
  }else{
      echo '<center>Ошибка загрузки файла</center>';  
  }
    $newfalename = mysqli_real_escape_string($link, $newfalename);//Экранируем
    mysqli_query($link, "INSERT INTO lesson2 (img) values ('$newfalename')");

      echo "Файл загружен.";
  }else{
      echo "Ошибка загрузки файла.";
  }
  
      header('Location: index.php');
  }
// ================================================================


?>