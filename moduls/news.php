<?php
@$result_meta = mysql_query("SELECT * FROM page WHERE id='1'"); //������ �� ����� ��������� ������ (��������� �����, ��������, �������� �����)
@$myrow_meta = mysql_fetch_array($result_meta);

if($myrow_meta != "") //���� ��������� ������� ����� ������...
{
	$meta_title = '������� �������';
    $header_title = $meta_title." - ".$myrow_meta[title];//��������� �������� (��� �������� - ��� �����)
    $header_metaD = $myrow_meta[meta_d]; //��������
    $header_metaK = $myrow_meta[meta_k]; //�������� �����
}

function news()//������� ������ ��������
{
global $pn; //���������� ������������ ���������
include("moduls/news_navigation.php"); //������ ���������
$limit = news_navigation(5,$pn); //���������� ��������� ��� �� ���� ��������
$links = $limit[2];

	$result_index = mysql_query("SELECT * FROM news WHERE status='1' ORDER BY id DESC LIMIT $limit[0], $limit[1]");//������ �� �� �������� ���� ���������� �������
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//���� ��������� ������� ����� ������...
		{
			$templates = file("templates/news.html");//��������� ������
			$templates = implode("",$templates);//�.�. ������� file() ���������� ������, ��� ����� �������
			preg_match("/\[_div_news\](.*?)\[_div_news\]/s",$templates,$div_content);//���������� ���������, ����������� �������� �� ������� ������ �� �����, ������� ������ ����������� (��������� ��������� � $div_content)
				do
				{
					$change_ids = $div_content[1];/*��� ��� ���� �������� ������� ������(�������� �������������� �� ���������� �� �������), ������� ���(������) � ��������� ����������, 
				����� �������� ������������ �������� file() ���� ��� 1 ���, � ��� �������������� �������� �� ������*/
					$link = "news.php?topic=".$myrow_index[id];//����������� ������ �� ����
	
					$change_ids = str_replace("[_id]",$myrow_index[id],$change_ids);//id ������, ��� ������ � ��������
					$change_ids = str_replace("[_title]",$myrow_index[title],$change_ids);//���������
					$change_ids = str_replace("[_text]",$myrow_index[text],$change_ids);//�����
					$change_ids = str_replace("[_date_pub]",$myrow_index[date_pub],$change_ids);//���� ����������
					$news .= $change_ids;//����� ���� ��������������� ��� � ���� ����������
				}
				while($myrow_index = mysql_fetch_array($result_index));
			$news = preg_replace("/\[_div_news\].*?\[_div_news\]/s",$news,$templates);//������ [_div_news]...[_div_news] ����������� ��������������� html ��� �� $news
			if($links > 1)$news .= listnav($links,$pn,4);//����� ������ �� �������� (4 - ��� ���������� ������ � ����������� ����� ������ ���������)
		}
		else //���� ��������� ������� ������ �� ����� (������)...
		{
			$templates = file("templates/error.html"); //����������� ������� ������
			$templates = implode("",$templates); //���������� �������, ������������� �������� file()
			$title = '������';//��������� ������
			$message = '�������� �� ���������� ��� ������ �� ������ ������������� (�����). ���� �� �������, ��� ������������ ���������� ������, ��������� � ��������������'; //��������� ���������
			$templates = preg_replace("[err_title]",$title,$templates);//������ ��������������� � ������� �� ��������� ������
			$templates = preg_replace("[err_message]",$message,$templates);//������ ��������������� � ������� �� ��������� ���������
			$news .= $templates; //����� ���� ��������������� ��� � ���� ����������
		}
	return $news;//����� ���������������� html ����
}
?>