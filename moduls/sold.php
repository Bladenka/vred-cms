<?php
@$result_meta = mysql_query("SELECT * FROM page WHERE id='1'"); //������ �� ����� ��������� ������ (��������� �����, ��������, �������� �����)
@$myrow_meta = mysql_fetch_array($result_meta);

if($myrow_meta != "") //���� ��������� ������� ����� ������...
{
	$meta_title = '��������� �������� DarkOrbit';
    $header_title = $meta_title." - ".$myrow_meta[title];//��������� �������� (��� �������� - ��� �����)
    $header_metaD = $myrow_meta[meta_d]; //��������
    $header_metaK = $myrow_meta[meta_k]; //�������� �����
}

function acc_sold()//������� ������ ��������� ���������
{
global $pn; //���������� ������������ ���������
include("moduls/sold_navigation.php"); //������ ���������
$limit = sold_navigation(10,$pn); //���������� ��������� ��� �� ���� ��������
$links = $limit[2];

	$result_index = mysql_query("SELECT * FROM accounts WHERE status = '2' ORDER BY sold_date DESC LIMIT $limit[0], $limit[1]");//����� �� ������� �� ��� ������ �� �������� "� �������"
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//���� ��������� ������� ����� ������...
		{
			$templates = file("templates/sold.html");//��������� ������
			$templates = implode("",$templates);//���������� �������, ������������� �������� file()
			preg_match("/\[_div_sold\](.*?)\[_div_sold\]/s",$templates,$div_content);//���������� ���������, ����������� �������� �� ������� ������ �� �����, ������� ������ ����������� (��������� ��������� � $div_content)
				do
				{
					$change_ids = $div_content[1];/*��� ��� ���� �������� ������� ������(�������� �������������� �� ���������� �� �������), ������� ���(������) � ��������� ����������, 
				����� �������� ������������ �������� file() ���� ��� 1 ���, � ��� �������������� �������� �� ������*/
					//������ ��������������� � ������� �� ���������� �� ��
					$change_ids = str_replace("[_id]",$myrow_index[id],$change_ids);//��
					$change_ids = str_replace("[_title]",$myrow_index[title],$change_ids);//���������
					$change_ids = str_replace("[_preview_ship]",$myrow_index[preview_ship],$change_ids);//������������ �������
					$change_ids = str_replace("[_server]",$myrow_index[server],$change_ids);//������
					$change_ids = str_replace("[_sold_date]",$myrow_index[sold_date],$change_ids);//���� �������
					$change_ids = str_replace("[_price]",number_format($myrow_index[price],0,'','.'),$change_ids);//����
					$acc_sold .= $change_ids;//����� ���� ��������������� ��� � ���� ����������
				}
				while($myrow_index = mysql_fetch_array($result_index));
			$acc_sold = preg_replace("/\[_div_sold\].*?\[_div_sold\]/s",$acc_sold,$templates);//������ [_div_sold]...[_div_sold] ����������� ��������������� html ��� �� $acc_sold
			if($links > 1)$acc_sold .= listnav($links,$pn,4);//����� ������ �� �������� (4 - ��� ���������� ������ � ����������� ����� ������ ���������)
			return $acc_sold;
		}
		else
		{
			$templates = file("templates/error.html"); //����������� ������� ������
			$templates = implode("",$templates); //���������� �������, ������������� �������� file()
			$title = '��������� ��������';//��������� ������
			$message = '�������� �� ���������� ���� ��� ��������� ���������'; //��������� ���������
			$templates = preg_replace("[err_title]",$title,$templates);//������ ��������������� � ������� �� ��������� ������
			$templates = preg_replace("[err_message]",$message,$templates);//������ ��������������� � ������� �� ��������� ���������
			$acc_sold .= $templates; //����� ���� ��������������� ��� � ���� ����������
		}
	return $acc_sold;//����� ���������������� html ����
}
?>