<?php
function statistics()//������� ������ ����������
{
	$templates = file("templates/module_statistics.html");//��������� ������
	$templates = implode("",$templates); //�.�. ������� file() ���������� ������, ��� ����� �������
	$result_index_sell = mysql_query("SELECT COUNT(*) FROM accounts WHERE status='1'");//������ �� �� ���������� ��������� � ������� =1
		$myrow_index_sell = mysql_fetch_array($result_index_sell);
	$result_index_sold = mysql_query("SELECT COUNT(*) FROM accounts WHERE status='2'");//������ �� �� ���������� ��������� ��������� =2
		$myrow_index_sold = mysql_fetch_array($result_index_sold);
		$templates = str_replace("[_sell]",$myrow_index_sell[0],$templates);//������ � ���������� ��������� ������� (���-�� ��������� � �������)
		$templates = str_replace("[_sold]",$myrow_index_sold[0],$templates);//������ � ���������� ��������� ������� (���-�� ��������� ���������)
	return $templates;//����� ���������������� html ����
}
?>