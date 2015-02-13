<?php
//УДАЛЕНИЕ
if($_GET['del_post'])$del_post = $_GET['del_post'];//Объявляю GET-переменную содержащею ID удаляемого отзыва
if($del_post)//Если переменная существует...
{
    $result_del_post = mysql_query ("DELETE FROM reviews WHERE id='$del_post'");//Удаляю запись в которой id равен GET-переменной
    header("location: ?page=reviews_unverified");//Перенаправление пользователя после удаления отзыва
    exit;
}
//УДАЛЕНИЕ

function reviews_unverified()//Функция вывода неподтвержденных отзывов
{
	$result_index = mysql_query("SELECT * FROM reviews WHERE status = '0' ORDER BY post_date ASC");//Вывожу из таблицы "reviews(отзывы)" все записи со статусом "0 = Ожидает" (сортировка по Возрастанию)
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//Если результат запроса имеет данные...
		{
			$templates = file("templates/reviews_unverified.html");//Подключаю шаблон
			$templates = implode("",$templates);//Т.к. функция file() возвращает массив, его нужно склеить
			preg_match("/\[_while\](.*?)\[_while\]/s",$templates,$tamp_while);//Регулярное выражение, позволяющее вырезать из шаблона только ту часть, которая должна повторяться
				do
				{
					$copy_tamp = $tamp_while[1];/*Так как ниже придется править шаблон(заменить идентификаторы на информацию из запроса), сохраню его(шаблон) в отдельную переменную, 
					иначе придется пользоваться функцией file() чаще чем 1 раз, а это дополнительная нагрузка на сервер*/
					
					//Замена идентификаторов на информацию из запроса
					$copy_tamp = str_replace("[_id]",$myrow_index[id],$copy_tamp);//ID
					$copy_tamp = str_replace("[_title]",$myrow_index[title],$copy_tamp);//Заголовок
					$copy_tamp = str_replace("[_user_text]",$myrow_index[user_text],$copy_tamp);//Отзыв
					$copy_tamp = str_replace("[_author]",$myrow_index[author],$copy_tamp);//Подпись Автора отзыва
					$copy_tamp = str_replace("[_admin_text]",$myrow_index[admin_text],$copy_tamp);//Ответ Администратора
					$copy_tamp = str_replace("[_post_date]",$myrow_index[post_date],$copy_tamp);//Дата размещения
					$list .= $copy_tamp;//Склею весь сгенерированный код в одну переменную
				}
				while($myrow_index = mysql_fetch_array($result_index));
			$templates = preg_replace("/\[_while\].*?\[_while\]/s",$list,$templates);//Вместо [_while]...[_while] вклеивается сгенерированный html код из $list
		}
		else 
		{//Если результат запроса данных не имеет (пустой)...
			$templates = file("templates/error.html"); //Подключение шаблона
			$templates = implode("",$templates); //Склеивание массива, возвращенного функцией file()
			$title = 'Новые отзывы'; //Заголовок ошибки
			$message = 'Нет записей в базе данных'; //Выводимое сообщение
			$templates = preg_replace("[err_title]",$title,$templates);//Замена идентификаторов в шаблоне на заголовок ошибки
			$templates = preg_replace("[err_message]",$message,$templates);//Замена идентификаторов в шаблоне на выводимое сообщение
		}
	return $templates;//Вывод сгенерированного html кода
}
?>