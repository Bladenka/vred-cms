<?php
@$result_meta = mysql_query("SELECT title FROM page WHERE id='1'");//������ �� ����� ��������� ������ (��������� �����)
@$myrow_meta = mysql_fetch_array($result_meta);

if($myrow_meta != "")
{
    $result_meta_news = mysql_query("SELECT title,meta_d,meta_k FROM news WHERE id='$topic'");//������ �� ����� ��������� ��������� ������
    $meta_news = mysql_fetch_array($result_meta_news);
	if($meta_news[title] != "") $header_title = $meta_news[title]." - ".$myrow_meta[title];//��������� �������� (��� �������� - ��� �����)
		else $header_title = $meta_news[title];//��������� �������� (��� �������� - ��� �����)
	$header_metaD = $myrow_meta[meta_d]; //��������
    $header_metaK = $myrow_meta[meta_k]; //�������� �����
}

function news_topic($topic)//������� ������ ���������� �������� ��������
{
	$result_index = mysql_query("SELECT * FROM news WHERE id = '$topic'");//������ �� �� ��������� ������������� �������
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//���� ��������� ������� ����� ������...
		{
			$templates = file("templates/news_topic.html");//��������� ������
			$templates = implode("",$templates);//���������� �������, ������������� �������� file()

			$templates = str_replace("[_title]",$myrow_index[title],$templates);//�������� ������
			$templates = str_replace("[_text]",$myrow_index[text],$templates);//�����
			$templates = str_replace("[_publisher]",$myrow_index[publisher],$templates);//����� ������
			$templates = str_replace("[_date_pub]",$myrow_index[date_pub],$templates);//���� ����������
			$news_topic .= $templates;//����� ���� ��������������� ��� � ���� ����������
		}
		else //���� ��������� ������� ������ �� ����� (������)...
		{
			$templates = file("templates/error.html");//����������� ������� ������
			$templates = implode("",$templates); //���������� �������, ������������� �������� file()
			$title = '��������� �����'; //��������� ������
			$message = '���� �� ���������� ��� �� ������ ������������� (�����). ���� �� �������, ��� ������������ ���������� ������, ��������� � ��������������'; //��������� ���������
			$templates = preg_replace("[err_title]",$title,$templates);//������ ��������������� � ������� �� ��������� ������
			$templates = preg_replace("[err_message]",$message,$templates);//������ ��������������� � ������� �� ��������� ���������
			$news_topic .= $templates; //����� ���� ��������������� ��� � ���� ����������
		}
	return $news_topic;//����� ���������������� html ����
}
?>