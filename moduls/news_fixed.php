<?php
function news_fixed()//������� ������ ������������� �����
{
    $result_index = mysql_query("SELECT title,text FROM news WHERE block='1'");//������ �� �� ����, ��� ������� block ����� �������, �.�. "���������"
    $myrow_index = mysql_fetch_array($result_index);
    if($myrow_index != "")//���� ��������� ������� ����� ������...
    {
        $templates = file("templates/news_topic.html");//��������� ������
        $templates = implode("",$templates);//�.�. ������� file() ���������� ������, ��� ����� �������
		$templates = str_replace("[_title]",$myrow_index[title],$templates);//������ ��������������� � ������� �� ��������� ������������� �����
        $templates = str_replace("[_text]",$myrow_index[text],$templates);//������ ��������������� � ������� �� ����� ������������� �����
        return $templates;//����� ���������������� html ����
    }
    else return "";//...���� ��� - ����������� ������� ����� �������
}
?>