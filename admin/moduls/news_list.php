<?php
//УДАЛЕНИЕ
if($_GET['del_post'])$del_post = $_GET['del_post'];//Объявляю GET-переменную содержащею ID удаляемой новости
if($del_post)//Если переменная существует...
{
    $result_del_post = mysql_query ("DELETE FROM news WHERE id='$del_post'");//Удаляю запись в которой id равен GET-переменной
    header("location: ?page=news_list");//Перенаправление на страницу со списком новостей
    exit;
}
//УДАЛЕНИЕ

//------ОБРАБОТЧИК РЕДАКТИРОВАНИЯ НОВОСТИ
//Объявляю переменные, если форма была отправлена (sumbit на форме редактирования данных)
if($_POST['update_post_id'])$update_post_id = $_POST['update_post_id'];//ID
if($_POST['update_post_title'])$update_post_title = $_POST['update_post_title'];//Заголовок
if($_POST['update_post_text'])$update_post_text = $_POST['update_post_text'];//Текст новости
if($_POST['update_post_metad'])$update_post_metad = $_POST['update_post_metad'];
if($_POST['update_post_metak'])$update_post_metak = $_POST['update_post_metak'];
//Объявляю переменные, если форма была отправлена (sumbit на форме редактирования данных)

if($update_post_title & $update_post_text)//Если посланные переменные определены как существующие...
{   
    //Замена символа (') на спец символ
    $update_post_title = str_replace("'","&#039",$update_post_title);
    $update_post_text = str_replace("'","&#039",$update_post_text);
    $update_post_metad = str_replace("'","&#039",$update_post_metad);
	$update_post_metak = str_replace("'","&#039",$update_post_metak);
    //Замена символа (') на спец символ	

    $edd_blog = mysql_query ("UPDATE news SET title='$update_post_title', text='$update_post_text', meta_d = '$update_post_metad', meta_k = '$update_post_metak' WHERE id='$update_post_id'");//обновляю данные в БД   
    header("location: ?page=news_config&id=$update_post_id");//Перенаправление на страницу с настройками статьи
    exit;
}
//------ОБРАБОТЧИК РЕДАКТИРОВАНИЯ НОВОСТИ

function news_list()//Функция вывода списка новостей
{
	$templates = file("templates/news_list.html");//Подключаю шаблон
	$templates = implode("",$templates);//Склеивание массива, возвращенного функцией file()
	$result_index = mysql_query("SELECT * FROM news ORDER BY id DESC");//Вывожу из таблицы "news(новости)" все записи (сортировка по Убыванию)
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//Если результат запроса имеет данные...
		{
			preg_match("/\[_while\](.*?)\[_while\]/s",$templates,$tamp_while);//Регулярное выражение, позволяющее вырезать из шаблона только ту часть, которая должна повторяться
			do
			{
				$copy_tamp = $tamp_while[1];/*Так как ниже придется править шаблон(заменить идентификаторы на информацию из запроса), сохраню его(шаблон) в отдельную переменную, 
				иначе придется пользоваться функцией file() чаще чем 1 раз, а это дополнительная нагрузка на сервер*/
				
				//Замена идентификаторов на информацию из запроса
				$copy_tamp = str_replace("[_id]",$myrow_index[id],$copy_tamp);//ID
				$copy_tamp = str_replace("[_block]",$myrow_index[block],$copy_tamp);//Статус - шапка ленты новостей
				$copy_tamp = str_replace("[_status]",$myrow_index[status],$copy_tamp);//Статус - отображается ли новость в ленте новостей
				$copy_tamp = str_replace("[_title]",$myrow_index[title],$copy_tamp);//Заголовок
				$copy_tamp = str_replace("[_date_pub]",$myrow_index[date_pub],$copy_tamp);//Дата
				$list .= $copy_tamp;//Склею весь сгенерированный код в одну переменную
			}
			while($myrow_index = mysql_fetch_array($result_index));
			$templates = preg_replace("/\[_while\].*?\[_while\]/s",$list,$templates);//Вместо [_while]...[_while] вклеивается сгенерированный html код из $list
		}
		else 
		{//Если записей нет, вывести сообщение...
			$message = '<tr><td class="bottom_cfg" align="center" height="16"><font>Нет записей в базе данных</font></tr></td>'; //Выводимое сообщение
			$templates = preg_replace("/\[_while\].*?\[_while\]/s",$message,$templates);//Замена идентификаторов на выводимое сообщение
		}
	return $templates;//Вывод сгенерированного html кода
}

function news_update($id)//Функция вывода выбранной новости для редактирования
{
	$result_index = mysql_query("SELECT * FROM news WHERE id='$id'");//Вывожу из таблицы "news(новости)" запись с определённым id
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//Если результат запроса имеет данные...
		{
			$templates = file("templates/news_update.html");//Подключаю шаблон
			$templates = implode("",$templates);//Склеивание массива, возвращенного функцией file()

			$text_post = str_replace("<BR>","",$myrow_index[text]);//Замена тега <br> на пустоту
			//Замена идентификаторов на информацию из запроса
			$templates = str_replace("[_id]",$myrow_index[id],$templates);//ID
			$templates = str_replace("[_title]",$myrow_index[title],$templates);//Заголовок
			$templates = str_replace("[_text]",$text_post,$templates);//Текст поста
			$templates = str_replace("[_date_pub]",$myrow_index[date_pub],$templates);//Автор
			$templates = str_replace("[_metad]",$myrow_index[meta_d],$templates);//Описание поста
			$templates = str_replace("[_metak]",$myrow_index[meta_k],$templates);//Ключевые слова поста
		}
		else 
		{//Если результат запроса данных не имеет (пустой)...
			$templates = file("templates/error.html"); //Подключение шаблона
			$templates = implode("",$templates); //Склеивание массива, возвращенного функцией file()
			$title = 'Ошибка'; //Заголовок ошибки
			$message = 'Указан несуществующий идентификатор новости'; //Выводимое сообщение
			$templates = preg_replace("[err_title]",$title,$templates);//Замена идентификаторов в шаблоне на заголовок ошибки
			$templates = preg_replace("[err_message]",$message,$templates);//Замена идентификаторов в шаблоне на выводимое сообщение
		}
	return $templates;//Вывод сгенерированного html кода
}
?>