<?php
//���������� ���������� ��������
if($_POST['post_title'])$post_title = $_POST['post_title'];
if($_POST['post_text'])$post_text = $_POST['post_text'];
if($_POST['post_metad'])$post_metad = $_POST['post_metad'];
if($_POST['post_metak'])$post_metak = $_POST['post_metak'];

if($post_title & $post_text)//���� ��������� ���������� ���������� ��� ������������...
{
	//������ ����� html �� ���� �������
	$post_metad = htmlspecialchars($post_metad);
	$post_metak = htmlspecialchars($post_metak);
	//������ ����� html �� ���� �������
		
	//������ ������� (') �� ���� ������
	$post_title = str_replace("'","&#039",$post_title);
	$post_text = str_replace("'","&#039",$post_text);
	$post_metad = str_replace("'","&#039",$post_metad);
	$post_metak = str_replace("'","&#039",$post_metak);
	//������ ������� (') �� ���� ������
		
	$result_add_cont = mysql_query ("INSERT INTO news (block,status,title,text,date_pub,meta_d,meta_k) VALUES ('0','0','$post_title','$post_text',NOW(),'$post_metad','$post_metak')");//������ ������ � ��
	$id = mysql_insert_id();//���������� �������������, ��������������� �������� � AUTO_INCREMENT ��������� ��������
	header("location: ?page=news_config&id=$id");//��������������� �� �������� � ����������� ���������� �������
	exit;
}
//���������� ���������� ��������

function news_add()//������� ������ ����� ���������� ��������
{
	$sm_read = file("templates/news_add.html");//��������� ������
	$sm_read = implode("",$sm_read);//�.�. ������� file() ���������� ������, ��� ����� �������
	return $sm_read;//����� ���������������� html ����
}
?>