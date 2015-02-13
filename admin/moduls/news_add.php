<?php
//ОБРАБОТЧИК ДОБАВЛЕНИЯ НОВОСТЕЙ
if($_POST['post_title'])$post_title = $_POST['post_title'];
if($_POST['post_text'])$post_text = $_POST['post_text'];
if($_POST['post_metad'])$post_metad = $_POST['post_metad'];
if($_POST['post_metak'])$post_metak = $_POST['post_metak'];

if($post_title & $post_text)//Если посланные переменные определены как существующие...
{
	//Замена тегов html на спец символы
	$post_metad = htmlspecialchars($post_metad);
	$post_metak = htmlspecialchars($post_metak);
	//Замена тегов html на спец символы
		
	//Замена символа (') на спец символ
	$post_title = str_replace("'","&#039",$post_title);
	$post_text = str_replace("'","&#039",$post_text);
	$post_metad = str_replace("'","&#039",$post_metad);
	$post_metak = str_replace("'","&#039",$post_metak);
	//Замена символа (') на спец символ
		
	$result_add_cont = mysql_query ("INSERT INTO news (block,status,title,text,date_pub,meta_d,meta_k) VALUES ('0','0','$post_title','$post_text',NOW(),'$post_metad','$post_metak')");//Запись данных в БД
	$id = mysql_insert_id();//Возвращает идентификатор, сгенерированный колонкой с AUTO_INCREMENT последним запросом
	header("location: ?page=news_config&id=$id");//Перенаправление на страницу с настройками добавленой новости
	exit;
}
//ОБРАБОТЧИК ДОБАВЛЕНИЯ НОВОСТЕЙ

function news_add()//Функция вывода формы добавления новостей
{
	$sm_read = file("templates/news_add.html");//Подключаю шаблон
	$sm_read = implode("",$sm_read);//Т.к. функция file() возвращает массив, его нужно склеить
	return $sm_read;//Вывод сгенерированного html кода
}
?>