<?php
include("moduls/db.php");//����������� � ���� ������

//������ ����
include("moduls/menu.php");
$menu = menu();//����� ���������� ������� � ����������	
//������ ����

//������ �������
include("moduls/reviews.php");
if(!isset($error_reviews))$error_reviews = "";
$content2 = reviews($error_reviews);//����� ���������� ������� � ����������
//������ �������

include("templates/index.html");//����������� �������
?>