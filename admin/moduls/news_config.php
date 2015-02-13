<?php
//ОБРАБОТЧИК
if(isset($_POST['status']))$status = $_POST['status'];
if(isset($_POST['block']))$block = $_POST['block'];

if(isset($status) AND isset($block))//Если посланные переменные определены как существующие...
{
    $newCONFIG = mysql_query ("UPDATE news SET status='$status',block='$block' WHERE id='$id'");//Обновление настроек
    header("location: ?page=news_list");//Перенаправление к списку настроек
    exit;
}
//ОБРАБОТЧИК

function news_config($id)//Функция вывода списка настроек поста
{
	$result_index = mysql_query("SELECT status,block FROM news WHERE id='$id'");//Вывожу из таблицы "news(новости)" выбранную админом новость
	$myrow_index = mysql_fetch_array($result_index);
    if($myrow_index != "")//Если результат запроса имеет данные...
		{
			$templates = file("templates/news_config.html");//Подключаю шаблон
			$templates = implode("",$templates);//Склеивание массива, возвращенного функцией file()

			//-----Закрепить новость на Главной странице?----
			$vblQUEtxt = array("Нет","Да");//Вариант для человека
			$vblQUEint = array(0,1);//Вариант для скрипта
			$vbl = queCFG($myrow_index[block],$vblQUEtxt,$vblQUEint);//формируем option для пункта "Шапки" новостной страницы
			//-----Закрепить новость на Главной странице?----
			
			//-----Опубликовать новость?----
			$viQUEtxt = array("Нет","Да");//Вариант для человека
			$viQUEint = array(0,1);//Вариант для скрипта
			$vi = queCFG($myrow_index[status],$viQUEtxt,$viQUEint);//Формируется option для пункта "Публикации новости"
			//-----Опубликовать новость?----

			//Замена код-слов
			$templates = str_replace("[_id]",$id,$templates);//ID поста
			$templates = str_replace("[_cfgvi]",$vi,$templates);//видимость поста на главной странице
			$templates = str_replace("[_cfgblock]",$vbl,$templates);//блокировка поста на гл стр
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
//----------------------------------------------------------------------
function queCFG($sel)//Функция генерации вариантов ответов
{
for($i=0;$i<2;$i++)
{
	//в зависимости от переменной i формируется текстовый вариант
    if($i == 0)$txtsel = "Нет";
	else $txtsel = "Да";
    //определяю какой вариант сейчас выбран
    if($sel == $i)$result .= "<option value='$i' selected>$txtsel</option>";//В option выбранного варианта прописывается selected
    else $result .= "<option value='$i'>$txtsel</option>";//остальные варианты будут без атрибута selected
}
return $result;//выводим с генерированный html код
}
?>