<?php
@$result_meta = mysql_query("SELECT * FROM page WHERE id='1'"); //Запрос на вывод системных данных (заголовок сайта, метатеги, ключивые слова)
@$myrow_meta = mysql_fetch_array($result_meta);

if($myrow_meta != "") //Если результат запроса имеет данные...
{
	$meta_title = 'Каталог аккаунтов DarkOrbit';
    $header_title = $meta_title." - ".$myrow_meta[title];//Заголовок страницы (Имя аккаунта - имя сайта)
    $header_metaD = $myrow_meta[meta_d]; //метатеги
    $header_metaK = $myrow_meta[meta_k]; //ключивые слова
}

function acc_preview()//Функция вывода одобренных аккаунтов на предпросмотр
{
global $pn; //Переменная постраничной навигации
include("moduls/acc_navigation.php"); //Модуль навигации
$limit = acc_navigation(10,$pn); //Количество выводимых аккаунтов на одну страницу
$links = $limit[2];
	$result_index = mysql_query("SELECT * FROM accounts WHERE status = '1' ORDER BY price DESC LIMIT $limit[0], $limit[1]");////Вывожу из БД заданное выше количество записей со статусом "В продаже"
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//Если результат запроса имеет данные...
		{
			$templates = file("templates/acc_preview.html");//Подключаю шаблон
			$templates = implode("",$templates);//Т.к. функция file() возвращает массив, его нужно склеить
			preg_match("/\[_div_content\](.*?)\[_div_content\]/s",$templates,$div_content);//Регулярное выражение, позволяющее вырезать из шаблона только ту часть, которая должна повторяться (Результат заносится в $div_content)
				do
				{
					$change_ids = $div_content[1];/*Так как ниже придется править шаблон(заменить идентификаторы на информацию из запроса), сохраню его(шаблон) в отдельную переменную, 
				иначе придется пользоваться функцией file() чаще чем 1 раз, а это дополнительная нагрузка на сервер*/
					
					//Замена идентификаторов в шаблоне на переменные из БД
					$change_ids = str_replace("[_id]",$myrow_index[id],$change_ids);//ид
					$change_ids = str_replace("[_title]",$myrow_index[title],$change_ids);//Заголовок
					$change_ids = str_replace("[_preview_ship]",$myrow_index[preview_ship],$change_ids);//Предпросмотр корабля
					$change_ids = str_replace("[_server]",$myrow_index[server],$change_ids);//Сервер
					$change_ids = str_replace("[_corp]",$myrow_index[corp],$change_ids);//Сервер
					if($myrow_index[level] != "") $change_ids = str_replace("[_level]",'<tr><td class="line1">Игровой уровень</td><td class="line2">'.$myrow_index[level].'</td></tr>',$change_ids);//Игровой уровень
						else $change_ids = str_replace("[_level]",'',$change_ids);
					if($myrow_index[drones] != "") $change_ids = str_replace("[_drones]",'<tr><td class="line1">Дроиды ('.strlen($myrow_index[drones]).')</td><td class="line2">'.$myrow_index[drones].'</td></tr>',$change_ids);//Дроиды
						else $change_ids = str_replace("[_drones]",'',$change_ids);
					if($myrow_index[uri] != "") $change_ids = str_replace("[_uri]",'<tr><td class="line1">Уридиум</td><td class="line2">'.number_format($myrow_index[uri],0,'','.').'</td></tr>',$change_ids);//Уридиум
						else $change_ids = str_replace("[_uri]",'',$change_ids);
					if($myrow_index[cr] != "") $change_ids = str_replace("[_cr]",'<tr><td class="line1">Кредиты</td><td class="line2">'.number_format($myrow_index[cr],0,'','.').'</td></tr>',$change_ids);//Кредиты
						else $change_ids = str_replace("[_cr]",'',$change_ids);
					if($myrow_index[jackpot] != "") $change_ids = str_replace("[_jackpot]",'<tr><td class="line1">Джекпот</td><td class="line2">'.number_format($myrow_index[jackpot],0,'','.').'&nbsp;EUR</td></tr>',$change_ids);//Джекпот
						else $change_ids = str_replace("[_jackpot]",'',$change_ids);
					if($myrow_index[prog] != "") $change_ids = str_replace("[_prog]",'<tr><td class="line1">Очки прогресса</td><td class="line2">'.$myrow_index[prog].'</td></tr>',$change_ids);//Древо умений
						else $change_ids = str_replace("[_prog]",'',$change_ids);					
					$change_ids = str_replace("[_price]",number_format($myrow_index[price],0,'','.'),$change_ids);//Цена
					$preview .= $change_ids;//Склею весь сгенерированный код в одну переменную
				}
				while($myrow_index = mysql_fetch_array($result_index));
			$preview = preg_replace("/\[_div_content\].*?\[_div_content\]/s",$preview,$templates);//Вместо [_div_news]...[_div_news] вклеивается сгенерированный html код из $preview
			if($links > 1)$preview .= listnav($links,$pn,4);//Вывод ссылок на страницы (4 - это количество ссылок в центральной части панели навигации)
		}
		else //Если результат запроса данных не имеет (пустой)...
		{
			$templates = file("templates/error.html"); //Подключение шаблона ошибки
			$templates = implode("",$templates); //Склеивание массива, возвращенного функцией file()
			$title = 'Каталог аккаунтов Dark Orbit';//Заголовок ошибки
			$message = 'Страница не существует или в каталоге аккаунтов на данный момент нет товара'; //Выводимое сообщение
			$templates = preg_replace("[err_title]",$title,$templates);//Замена идентификаторов в шаблоне на заголовок ошибки
			$templates = preg_replace("[err_message]",$message,$templates);//Замена идентификаторов в шаблоне на выводимое сообщение
			$preview .= $templates; //Склею весь сгенерированный код в одну переменную
		}
	return $preview;//Вывод сгенерированного html кода
}
?>