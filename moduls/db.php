<?php
$nameDB = "vred";//�������� ��
$nameSERVER = "localhost";//������
$nameUSER = "root";//��� ������������ ��
$passUSER = "";//������ ������������ ��
mysql_select_db($nameDB, mysql_connect($nameSERVER,$nameUSER,$passUSER));

mysql_query("set character_set_client='cp1251'"); 
mysql_query("set character_set_results='cp1251'"); 
mysql_query("set collation_connection='cp1251_general_ci'"); 

if(isset($_GET["server_root"])){$server_root = $_GET["server_root"];unset($server_root);}
if(isset($_POST["server_root"])){$server_root = $_POST["server_root"];unset($server_root);}

$server_root = "http://���.ru/";
?>