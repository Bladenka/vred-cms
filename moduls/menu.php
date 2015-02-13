<?
function menu()//Функция вывода пользовательского меню навигации
{
	$result_index = mysql_query("SELECT * FROM menu ORDER BY position");//Выводим из БД(меню) все пункты группируя по позиции
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//Если результат запроса имеет данные...
		{
			$templates = file("templates/menu.html");//Подключение шаблона
			$templates = implode("",$templates);//Функция file() возвращает массив, поэтому его нужно склеить
			preg_match("/\[_div_menu\](.*?)\[_div_menu\]/s",$templates,$div_menu);//Регулярное выражение, позволяющее вырезать из шаблона только ту часть, которая должна повторяться (Результат заносится в $div_menu)
				do//Цикл do while
				{
					$change_ids = $div_menu[1];/*Так как ниже придется править шаблон(заменить идентификаторы на информацию из запроса), сохраню его(шаблон) в отдельную переменную, 
				иначе придется пользоваться функцией file() чаще чем 1 раз, а это дополнительная нагрузка на сервер*/
					if($myrow_index[href] == "") $change_ids = str_replace("[_href]","/index.php",$change_ids);//Если ссылки нет
					else $change_ids = str_replace("[_href]",$myrow_index[href],$change_ids);//Ссылка
					$change_ids = str_replace("[_link]",$myrow_index[name],$change_ids);//Текст ссылки
					$menu .= $change_ids;//Склею весь сгенерированный код в одну переменную
				}
			while($myrow_index = mysql_fetch_array($result_index));
			$menu = preg_replace("/\[_div_menu\].*?\[_div_menu\]/s",$menu,$templates);//Вместо [_div_menu]...[_div_menu] вклеиить сгенерированный код из $menu
		}
	else $menu = "";//Если результат запроса данных не имеет (пустой)...
	return $menu;//Вывод сгенерированного html кода
}
?>