<?
function menu()//������� ������ ����������������� ���� ���������
{
	$result_index = mysql_query("SELECT * FROM menu ORDER BY position");//������� �� ��(����) ��� ������ ��������� �� �������
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//���� ��������� ������� ����� ������...
		{
			$templates = file("templates/menu.html");//����������� �������
			$templates = implode("",$templates);//������� file() ���������� ������, ������� ��� ����� �������
			preg_match("/\[_div_menu\](.*?)\[_div_menu\]/s",$templates,$div_menu);//���������� ���������, ����������� �������� �� ������� ������ �� �����, ������� ������ ����������� (��������� ��������� � $div_menu)
				do//���� do while
				{
					$change_ids = $div_menu[1];/*��� ��� ���� �������� ������� ������(�������� �������������� �� ���������� �� �������), ������� ���(������) � ��������� ����������, 
				����� �������� ������������ �������� file() ���� ��� 1 ���, � ��� �������������� �������� �� ������*/
					if($myrow_index[href] == "") $change_ids = str_replace("[_href]","/index.php",$change_ids);//���� ������ ���
					else $change_ids = str_replace("[_href]",$myrow_index[href],$change_ids);//������
					$change_ids = str_replace("[_link]",$myrow_index[name],$change_ids);//����� ������
					$menu .= $change_ids;//����� ���� ��������������� ��� � ���� ����������
				}
			while($myrow_index = mysql_fetch_array($result_index));
			$menu = preg_replace("/\[_div_menu\].*?\[_div_menu\]/s",$menu,$templates);//������ [_div_menu]...[_div_menu] �������� ��������������� ��� �� $menu
		}
	else $menu = "";//���� ��������� ������� ������ �� ����� (������)...
	return $menu;//����� ���������������� html ����
}
?>