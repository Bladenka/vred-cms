<?php
function main_menu()//������� ������ �������� ����� ���������
{
	$templates = file("templates/main_menu.html");//��������� ������
	$templates = implode("",$templates);//���������� �������, ������������� �������� file()
		$count_menu = mysql_query("SELECT COUNT(*) FROM menu");//����� ���������� ������� ����������������� ����
		$count_menu = mysql_fetch_array($count_menu);
	$templates = str_replace("[_countMENU]",$count_menu[0],$templates);
	
		$count_news = mysql_query("SELECT COUNT(*) FROM news");//����� ���������� ��������� ������
		$count_news = mysql_fetch_array($count_news);
	$templates = str_replace("[_countNEWS]",$count_news[0],$templates);
	
		$count_new = mysql_query("SELECT COUNT(*) FROM accounts WHERE status='0'");//����� ���������� ����� ���������
		$count_new = mysql_fetch_array($count_new);
	$templates = str_replace("[_countNEW]",$count_new[0],$templates);
	
		$count_sale = mysql_query("SELECT COUNT(*) FROM accounts WHERE status='1'");//����� ���������� ���������� ���������	
		$count_sale = mysql_fetch_array($count_sale);
	$templates = str_replace("[_countSALE]",$count_sale[0],$templates);
	
		$count_sold = mysql_query("SELECT COUNT(*) FROM accounts WHERE status='2'");//����� ���������� ��������� ���������	
		$count_sold = mysql_fetch_array($count_sold);	
	$templates = str_replace("[_countSOLD]",$count_sold[0],$templates);
	
		$count_unverified = mysql_query("SELECT COUNT(*) FROM reviews WHERE status='0'");//����� ���������� ����� �������
		$count_unverified = mysql_fetch_array($count_unverified);
	$templates = str_replace("[_countUNVERIFIED]",$count_unverified[0],$templates);
	
		$count_verified = mysql_query("SELECT COUNT(*) FROM reviews WHERE status='1'");//����� ���������� ���������� �������
		$count_verified = mysql_fetch_array($count_verified);
	$templates = str_replace("[_countVERIFIED]",$count_verified[0],$templates);
	return $templates;//����� ���������������� html ����
}
?>