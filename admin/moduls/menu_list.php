<?php
//РЕДАКТИРОВАНИЕ ПУНКТОВ МЕНЮ
if(isset($_POST['name_p']))$name_p = $_POST['name_p'];
if(isset($_POST['href_p']))$href_p = $_POST['href_p'];
if($_GET['id'])$id = $_GET['id'];
if(isset($name_p) AND isset($href_p))
{
	$edd_punct = mysql_query ("UPDATE menu SET name='$name_p',href='$href_p' WHERE id='$id'");
    header("location: ?page=menu_list"); //Перенаправление на страницу пунктов меню
    exit; 
}
//РЕДАКТИРОВАНИЕ ПУНКТОВ МЕНЮ

//УДАЛЕНИЕ ПУНКТА МЕНЮ
if($_GET['del_menu'])$del_menu = $_GET['del_menu'];
if(isset($del_menu))
{
	$result_del_menu = mysql_query ("DELETE FROM menu WHERE id='$del_menu'"); //Удаление записи из таблицы
    $res_delmenu = mysql_query("SELECT id FROM menu ORDER BY position"); //Вывод из БД пунктов меню сортируюя их по колонке position
    $my_delmenu = mysql_fetch_array($res_delmenu);
    $new_pos_menu = 1;	
    do
    {
        $edd_pos_menu = mysql_query ("UPDATE menu SET position='$new_pos_menu' WHERE id='$my_delmenu[id]'");
        $new_pos_menu++;
    }
    while($my_delmenu = mysql_fetch_array($res_delmenu));
    header("location: ?page=menu_list"); //Перенаправление на страницу пунктов меню
    exit;
}
//УДАЛЕНИЕ ПУНКТА МЕНЮ

//ДВИЖЕНИЕ ПУНКТОВ МЕНЮ ВВЕРХ/ВНИЗ
if($_GET['up_menu'])$up_menu = $_GET['up_menu'];
if($_GET['down_menu'])$down_menu = $_GET['down_menu'];
if(isset($up_menu) || isset($down_menu))
{
    if(isset($up_menu)) //Если движение вверх
    {
        $info_menu = mysql_query("SELECT position FROM menu WHERE id='$up_menu'"); //Получем значение колонки position из строки, где id = пункту который двигается
        $myrow_info_menu = mysql_fetch_array($info_menu);
        $new_pos = $myrow_info_menu[position] - 1; //Изменение значения позиции
        $nav_id = $up_menu; //Сохраняю id пункта который двигается в отдельную переменную
    }	
    if(isset($down_menu)) //Если движение вниз
    {
        $info_menu = mysql_query("SELECT position FROM menu WHERE id='$down_menu'"); //Получем значение колонки position из строки, где id = пункту который двигается
        $myrow_info_menu = mysql_fetch_array($info_menu);
        $new_pos = $myrow_info_menu[position] + 1; //Изменение значения позиции
        $nav_id = $down_menu; //Сохраняю id пункта который двигается в отдельную переменную		
    }
    $old_pos = $myrow_info_menu[position]; //Заношу в отдельную переменную значение позиции сдвигаемого пункта
    $new_pos_db = mysql_query ("UPDATE menu SET position='$old_pos' WHERE position='$new_pos'"); //Обновляю позицию пункта меню на новое значение
    $old_pos_db = mysql_query ("UPDATE menu SET position='$new_pos' WHERE id='$nav_id'"); //Заношу в пункт который сдвигался его новую позицию
    header("location: ?page=menu_list"); //Перенаправление на страницу пунктов меню
    exit;	
}
//ДВИЖЕНИЕ ПУНКТОВ МЕНЮ ВВЕРХ/ВНИЗ

function menu_list() //Функция вывода списка меню
{
	$result_index = mysql_query("SELECT * FROM menu ORDER BY position"); //Выводим из базы данных пункты меню
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//Если результат запроса имеет данные...
		{
			$templates = file("templates/menu_list.html"); //Подключение шаблона
			$templates = implode("",$templates); //Склеивание массива, возвращенного функцией file()
			preg_match("/\[_while\](.*?)\[_while\]/s",$templates,$tamp_while); //Регулярное выражение, позволяющее вырезать из шаблона только ту часть, которая должна повторяться
			$col = mysql_num_rows($result_index); //Количество пунктов в базе данных
				do
				{
					$copy_tamp = $tamp_while[1]; /*Так как ниже придется править шаблон(заменить идентификаторы на информацию из запроса), сохраню его(шаблон) в отдельную переменную, 
				иначе придется пользоваться функцией file() чаще чем 1 раз, а это дополнительная нагрузка на сервер*/
				//Замена идентификаторов на информацию из запроса
				   
					//Если это первый пункт, то запрещаем вывод кнопки "поднять пункт вверх"
					if($myrow_index[position] == 1)$copy_tamp = preg_replace("/\[_up\].*?\[_up\]/s","&nbsp;",$copy_tamp);
					else $copy_tamp = str_replace("[_up]","",$copy_tamp); //Если пункт не первый, то код слово удаляется из шаблона
					
					//Если это последний пункт, то запрещаем вывод кнопки "опустить пункт вниз"
					if($myrow_index[position] == $col)$copy_tamp = preg_replace("/\[_down\].*?\[_down\]/s","&nbsp;",$copy_tamp);
					else $copy_tamp = str_replace("[_down]","",$copy_tamp); //Если пункт не последний, то код слово удаляется из шаблона
					
					//Замена код-слов
					$copy_tamp = str_replace("[_name]",$myrow_index[name],$copy_tamp); //Название пункта
					$copy_tamp = str_replace("[_id]",$myrow_index[id],$copy_tamp); //ID пункта
					$list .= $copy_tamp; //Склею весь сгенерированный код в одну переменную
					
				}
				while($myrow_index = mysql_fetch_array($result_index));
			$templates = preg_replace("/\[_while\].*?\[_while\]/s",$list,$templates);//Вместо [_while]...[_while] вклеивается сгенерированный html код из $list
		}
		else 
		{//Если результат запроса данных не имеет (пустой)...
			$message = '<tr><td class="bottom_cfg" align="center" height="16"><font>Нет записей в базе данных</font></tr></td>'; //Выводимое сообщение
			$templates = preg_replace("/\[_while\].*?\[_while\]/s",$message,$templates);//Замена идентификаторов на выводимое сообщение
		}
	return $templates; //Вывод сгенерированного html кода
}

function menu_update($id) //Функция вывода формы редактирования меню
{
    $result_index = mysql_query("SELECT name,href FROM menu WHERE id = '$id'"); //Вывод из базы данных выбранного пункта меню
    $myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//Если результат запроса имеет данные...
		{
			$templates = file("templates/menu_update.html"); //Подключение шаблона
			$templates = implode("",$templates); //Склеивание массива, возвращенного функцией file()
			$templates = str_replace("[_name]",$myrow_index[name],$templates); //Название пункта
			$templates = str_replace("[_href]",$myrow_index[href],$templates); //Ссылка пункта
			$templates = str_replace("[_id]",$id,$templates); //ID пункта	
		}
		else 
		{//Если результат запроса данных не имеет (пустой)...
			$templates = file("templates/error.html"); //Подключение шаблона
			$templates = implode("",$templates); //Склеивание массива, возвращенного функцией file()
			$title = 'Ошибка'; //Заголовок ошибки
			$message = 'Указан несуществующий идентификатор'; //Выводимое сообщение
			$templates = preg_replace("[err_title]",$title,$templates);//Замена идентификаторов в шаблоне на заголовок ошибки
			$templates = preg_replace("[err_message]",$message,$templates);//Замена идентификаторов в шаблоне на выводимое сообщение
		}
    return $templates; //Вывод html кода
}
?>