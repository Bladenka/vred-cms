<?php
function statistics()//Функция вывода статистики
{
	$templates = file("templates/module_statistics.html");//Подключаю шаблон
	$templates = implode("",$templates); //Т.к. функция file() возвращает массив, его нужно склеить
	$result_index_sell = mysql_query("SELECT COUNT(*) FROM accounts WHERE status='1'");//Вывожу из БД количество аккаунтов в продаже =1
		$myrow_index_sell = mysql_fetch_array($result_index_sell);
	$result_index_sold = mysql_query("SELECT COUNT(*) FROM accounts WHERE status='2'");//Вывожу из БД количество проданных аккаунтов =2
		$myrow_index_sold = mysql_fetch_array($result_index_sold);
		$templates = str_replace("[_sell]",$myrow_index_sell[0],$templates);//Заношу в переменную результат запроса (кол-во аккаунтов в продаже)
		$templates = str_replace("[_sold]",$myrow_index_sold[0],$templates);//Заношу в переменную результат запроса (кол-во проданных аккаунтов)
	return $templates;//Вывод сгенерированного html кода
}
?>