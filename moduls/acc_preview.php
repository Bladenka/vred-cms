<?php
@$result_meta = mysql_query("SELECT * FROM page WHERE id='1'"); //������ �� ����� ��������� ������ (��������� �����, ��������, �������� �����)
@$myrow_meta = mysql_fetch_array($result_meta);

if($myrow_meta != "") //���� ��������� ������� ����� ������...
{
	$meta_title = '������� ��������� DarkOrbit';
    $header_title = $meta_title." - ".$myrow_meta[title];//��������� �������� (��� �������� - ��� �����)
    $header_metaD = $myrow_meta[meta_d]; //��������
    $header_metaK = $myrow_meta[meta_k]; //�������� �����
}

function acc_preview()//������� ������ ���������� ��������� �� ������������
{
global $pn; //���������� ������������ ���������
include("moduls/acc_navigation.php"); //������ ���������
$limit = acc_navigation(10,$pn); //���������� ��������� ��������� �� ���� ��������
$links = $limit[2];
	$result_index = mysql_query("SELECT * FROM accounts WHERE status = '1' ORDER BY price DESC LIMIT $limit[0], $limit[1]");////������ �� �� �������� ���� ���������� ������� �� �������� "� �������"
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//���� ��������� ������� ����� ������...
		{
			$templates = file("templates/acc_preview.html");//��������� ������
			$templates = implode("",$templates);//�.�. ������� file() ���������� ������, ��� ����� �������
			preg_match("/\[_div_content\](.*?)\[_div_content\]/s",$templates,$div_content);//���������� ���������, ����������� �������� �� ������� ������ �� �����, ������� ������ ����������� (��������� ��������� � $div_content)
				do
				{
					$change_ids = $div_content[1];/*��� ��� ���� �������� ������� ������(�������� �������������� �� ���������� �� �������), ������� ���(������) � ��������� ����������, 
				����� �������� ������������ �������� file() ���� ��� 1 ���, � ��� �������������� �������� �� ������*/
					
					//������ ��������������� � ������� �� ���������� �� ��
					$change_ids = str_replace("[_id]",$myrow_index[id],$change_ids);//��
					$change_ids = str_replace("[_title]",$myrow_index[title],$change_ids);//���������
					$change_ids = str_replace("[_preview_ship]",$myrow_index[preview_ship],$change_ids);//������������ �������
					$change_ids = str_replace("[_server]",$myrow_index[server],$change_ids);//������
					$change_ids = str_replace("[_corp]",$myrow_index[corp],$change_ids);//������
					if($myrow_index[level] != "") $change_ids = str_replace("[_level]",'<tr><td class="line1">������� �������</td><td class="line2">'.$myrow_index[level].'</td></tr>',$change_ids);//������� �������
						else $change_ids = str_replace("[_level]",'',$change_ids);
					if($myrow_index[drones] != "") $change_ids = str_replace("[_drones]",'<tr><td class="line1">������ ('.strlen($myrow_index[drones]).')</td><td class="line2">'.$myrow_index[drones].'</td></tr>',$change_ids);//������
						else $change_ids = str_replace("[_drones]",'',$change_ids);
					if($myrow_index[uri] != "") $change_ids = str_replace("[_uri]",'<tr><td class="line1">�������</td><td class="line2">'.number_format($myrow_index[uri],0,'','.').'</td></tr>',$change_ids);//�������
						else $change_ids = str_replace("[_uri]",'',$change_ids);
					if($myrow_index[cr] != "") $change_ids = str_replace("[_cr]",'<tr><td class="line1">�������</td><td class="line2">'.number_format($myrow_index[cr],0,'','.').'</td></tr>',$change_ids);//�������
						else $change_ids = str_replace("[_cr]",'',$change_ids);
					if($myrow_index[jackpot] != "") $change_ids = str_replace("[_jackpot]",'<tr><td class="line1">�������</td><td class="line2">'.number_format($myrow_index[jackpot],0,'','.').'&nbsp;EUR</td></tr>',$change_ids);//�������
						else $change_ids = str_replace("[_jackpot]",'',$change_ids);
					if($myrow_index[prog] != "") $change_ids = str_replace("[_prog]",'<tr><td class="line1">���� ���������</td><td class="line2">'.$myrow_index[prog].'</td></tr>',$change_ids);//����� ������
						else $change_ids = str_replace("[_prog]",'',$change_ids);					
					$change_ids = str_replace("[_price]",number_format($myrow_index[price],0,'','.'),$change_ids);//����
					$preview .= $change_ids;//����� ���� ��������������� ��� � ���� ����������
				}
				while($myrow_index = mysql_fetch_array($result_index));
			$preview = preg_replace("/\[_div_content\].*?\[_div_content\]/s",$preview,$templates);//������ [_div_news]...[_div_news] ����������� ��������������� html ��� �� $preview
			if($links > 1)$preview .= listnav($links,$pn,4);//����� ������ �� �������� (4 - ��� ���������� ������ � ����������� ����� ������ ���������)
		}
		else //���� ��������� ������� ������ �� ����� (������)...
		{
			$templates = file("templates/error.html"); //����������� ������� ������
			$templates = implode("",$templates); //���������� �������, ������������� �������� file()
			$title = '������� ��������� Dark Orbit';//��������� ������
			$message = '�������� �� ���������� ��� � �������� ��������� �� ������ ������ ��� ������'; //��������� ���������
			$templates = preg_replace("[err_title]",$title,$templates);//������ ��������������� � ������� �� ��������� ������
			$templates = preg_replace("[err_message]",$message,$templates);//������ ��������������� � ������� �� ��������� ���������
			$preview .= $templates; //����� ���� ��������������� ��� � ���� ����������
		}
	return $preview;//����� ���������������� html ����
}
?>