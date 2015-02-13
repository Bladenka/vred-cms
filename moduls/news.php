<?php
@$result_meta = mysql_query("SELECT * FROM page WHERE id='1'"); //Запрос на вывод системных данных (заголовок сайта, метатеги, ключивые слова)
@$myrow_meta = mysql_fetch_array($result_meta);

if($myrow_meta != "") //Если результат запроса имеет данные...
{
	$meta_title = 'Новости портала';
    $header_title = $meta_title." - ".$myrow_meta[title];//Заголовок страницы (Имя аккаунта - имя сайта)
    $header_metaD = $myrow_meta[meta_d]; //метатеги
    $header_metaK = $myrow_meta[meta_k]; //ключивые слова
}

function news()//Функция вывода новостей
{
global $pn; //Переменная постраничной навигации
include("moduls/news_navigation.php"); //Модуль навигации
$limit = news_navigation(5,$pn); //Количество выводимых тем на одну страницу
$links = $limit[2];

	$result_index = mysql_query("SELECT * FROM news WHERE status='1' ORDER BY id DESC LIMIT $limit[0], $limit[1]");//Вывожу из БД заданное выше количество записей
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//Если результат запроса имеет данные...
		{
			$templates = file("templates/news.html");//Подключаю шаблон
			$templates = implode("",$templates);//Т.к. функция file() возвращает массив, его нужно склеить
			preg_match("/\[_div_news\](.*?)\[_div_news\]/s",$templates,$div_content);//Регулярное выражение, позволяющее вырезать из шаблона только ту часть, которая должна повторяться (Результат заносится в $div_content)
				do
				{
					$change_ids = $div_content[1];/*Так как ниже придется править шаблон(заменить идентификаторы на информацию из запроса), сохраню его(шаблон) в отдельную переменную, 
				иначе придется пользоваться функцией file() чаще чем 1 раз, а это дополнительная нагрузка на сервер*/
					$link = "news.php?topic=".$myrow_index[id];//Формируется ссылка на пост
	
					$change_ids = str_replace("[_id]",$myrow_index[id],$change_ids);//id статьи, для вывода её отдельно
					$change_ids = str_replace("[_title]",$myrow_index[title],$change_ids);//Заголовок
					$change_ids = str_replace("[_text]",$myrow_index[text],$change_ids);//Текст
					$change_ids = str_replace("[_date_pub]",$myrow_index[date_pub],$change_ids);//Дата размещения
					$news .= $change_ids;//Склею весь сгенерированный код в одну переменную
				}
				while($myrow_index = mysql_fetch_array($result_index));
			$news = preg_replace("/\[_div_news\].*?\[_div_news\]/s",$news,$templates);//Вместо [_div_news]...[_div_news] вклеивается сгенерированный html код из $news
			if($links > 1)$news .= listnav($links,$pn,4);//Вывод ссылок на страницы (4 - это количество ссылок в центральной части панели навигации)
		}
		else //Если результат запроса данных не имеет (пустой)...
		{
			$templates = file("templates/error.html"); //Подключение шаблона ошибки
			$templates = implode("",$templates); //Склеивание массива, возвращенного функцией file()
			$title = 'Ошибка';//Заголовок ошибки
			$message = 'Страница не существует или указан не верный идентификатор (номер). Если вы уверены, что использовали правильную ссылку, свяжитесь с администрацией'; //Выводимое сообщение
			$templates = preg_replace("[err_title]",$title,$templates);//Замена идентификаторов в шаблоне на заголовок ошибки
			$templates = preg_replace("[err_message]",$message,$templates);//Замена идентификаторов в шаблоне на выводимое сообщение
			$news .= $templates; //Склею весь сгенерированный код в одну переменную
		}
	return $news;//Вывод сгенерированного html кода
}
?>