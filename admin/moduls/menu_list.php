<?php
//�������������� ������� ����
if(isset($_POST['name_p']))$name_p = $_POST['name_p'];
if(isset($_POST['href_p']))$href_p = $_POST['href_p'];
if($_GET['id'])$id = $_GET['id'];
if(isset($name_p) AND isset($href_p))
{
	$edd_punct = mysql_query ("UPDATE menu SET name='$name_p',href='$href_p' WHERE id='$id'");
    header("location: ?page=menu_list"); //��������������� �� �������� ������� ����
    exit; 
}
//�������������� ������� ����

//�������� ������ ����
if($_GET['del_menu'])$del_menu = $_GET['del_menu'];
if(isset($del_menu))
{
	$result_del_menu = mysql_query ("DELETE FROM menu WHERE id='$del_menu'"); //�������� ������ �� �������
    $res_delmenu = mysql_query("SELECT id FROM menu ORDER BY position"); //����� �� �� ������� ���� ��������� �� �� ������� position
    $my_delmenu = mysql_fetch_array($res_delmenu);
    $new_pos_menu = 1;	
    do
    {
        $edd_pos_menu = mysql_query ("UPDATE menu SET position='$new_pos_menu' WHERE id='$my_delmenu[id]'");
        $new_pos_menu++;
    }
    while($my_delmenu = mysql_fetch_array($res_delmenu));
    header("location: ?page=menu_list"); //��������������� �� �������� ������� ����
    exit;
}
//�������� ������ ����

//�������� ������� ���� �����/����
if($_GET['up_menu'])$up_menu = $_GET['up_menu'];
if($_GET['down_menu'])$down_menu = $_GET['down_menu'];
if(isset($up_menu) || isset($down_menu))
{
    if(isset($up_menu)) //���� �������� �����
    {
        $info_menu = mysql_query("SELECT position FROM menu WHERE id='$up_menu'"); //������� �������� ������� position �� ������, ��� id = ������ ������� ���������
        $myrow_info_menu = mysql_fetch_array($info_menu);
        $new_pos = $myrow_info_menu[position] - 1; //��������� �������� �������
        $nav_id = $up_menu; //�������� id ������ ������� ��������� � ��������� ����������
    }	
    if(isset($down_menu)) //���� �������� ����
    {
        $info_menu = mysql_query("SELECT position FROM menu WHERE id='$down_menu'"); //������� �������� ������� position �� ������, ��� id = ������ ������� ���������
        $myrow_info_menu = mysql_fetch_array($info_menu);
        $new_pos = $myrow_info_menu[position] + 1; //��������� �������� �������
        $nav_id = $down_menu; //�������� id ������ ������� ��������� � ��������� ����������		
    }
    $old_pos = $myrow_info_menu[position]; //������ � ��������� ���������� �������� ������� ����������� ������
    $new_pos_db = mysql_query ("UPDATE menu SET position='$old_pos' WHERE position='$new_pos'"); //�������� ������� ������ ���� �� ����� ��������
    $old_pos_db = mysql_query ("UPDATE menu SET position='$new_pos' WHERE id='$nav_id'"); //������ � ����� ������� ��������� ��� ����� �������
    header("location: ?page=menu_list"); //��������������� �� �������� ������� ����
    exit;	
}
//�������� ������� ���� �����/����

function menu_list() //������� ������ ������ ����
{
	$result_index = mysql_query("SELECT * FROM menu ORDER BY position"); //������� �� ���� ������ ������ ����
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//���� ��������� ������� ����� ������...
		{
			$templates = file("templates/menu_list.html"); //����������� �������
			$templates = implode("",$templates); //���������� �������, ������������� �������� file()
			preg_match("/\[_while\](.*?)\[_while\]/s",$templates,$tamp_while); //���������� ���������, ����������� �������� �� ������� ������ �� �����, ������� ������ �����������
			$col = mysql_num_rows($result_index); //���������� ������� � ���� ������
				do
				{
					$copy_tamp = $tamp_while[1]; /*��� ��� ���� �������� ������� ������(�������� �������������� �� ���������� �� �������), ������� ���(������) � ��������� ����������, 
				����� �������� ������������ �������� file() ���� ��� 1 ���, � ��� �������������� �������� �� ������*/
				//������ ��������������� �� ���������� �� �������
				   
					//���� ��� ������ �����, �� ��������� ����� ������ "������� ����� �����"
					if($myrow_index[position] == 1)$copy_tamp = preg_replace("/\[_up\].*?\[_up\]/s","&nbsp;",$copy_tamp);
					else $copy_tamp = str_replace("[_up]","",$copy_tamp); //���� ����� �� ������, �� ��� ����� ��������� �� �������
					
					//���� ��� ��������� �����, �� ��������� ����� ������ "�������� ����� ����"
					if($myrow_index[position] == $col)$copy_tamp = preg_replace("/\[_down\].*?\[_down\]/s","&nbsp;",$copy_tamp);
					else $copy_tamp = str_replace("[_down]","",$copy_tamp); //���� ����� �� ���������, �� ��� ����� ��������� �� �������
					
					//������ ���-����
					$copy_tamp = str_replace("[_name]",$myrow_index[name],$copy_tamp); //�������� ������
					$copy_tamp = str_replace("[_id]",$myrow_index[id],$copy_tamp); //ID ������
					$list .= $copy_tamp; //����� ���� ��������������� ��� � ���� ����������
					
				}
				while($myrow_index = mysql_fetch_array($result_index));
			$templates = preg_replace("/\[_while\].*?\[_while\]/s",$list,$templates);//������ [_while]...[_while] ����������� ��������������� html ��� �� $list
		}
		else 
		{//���� ��������� ������� ������ �� ����� (������)...
			$message = '<tr><td class="bottom_cfg" align="center" height="16"><font>��� ������� � ���� ������</font></tr></td>'; //��������� ���������
			$templates = preg_replace("/\[_while\].*?\[_while\]/s",$message,$templates);//������ ��������������� �� ��������� ���������
		}
	return $templates; //����� ���������������� html ����
}

function menu_update($id) //������� ������ ����� �������������� ����
{
    $result_index = mysql_query("SELECT name,href FROM menu WHERE id = '$id'"); //����� �� ���� ������ ���������� ������ ����
    $myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//���� ��������� ������� ����� ������...
		{
			$templates = file("templates/menu_update.html"); //����������� �������
			$templates = implode("",$templates); //���������� �������, ������������� �������� file()
			$templates = str_replace("[_name]",$myrow_index[name],$templates); //�������� ������
			$templates = str_replace("[_href]",$myrow_index[href],$templates); //������ ������
			$templates = str_replace("[_id]",$id,$templates); //ID ������	
		}
		else 
		{//���� ��������� ������� ������ �� ����� (������)...
			$templates = file("templates/error.html"); //����������� �������
			$templates = implode("",$templates); //���������� �������, ������������� �������� file()
			$title = '������'; //��������� ������
			$message = '������ �������������� �������������'; //��������� ���������
			$templates = preg_replace("[err_title]",$title,$templates);//������ ��������������� � ������� �� ��������� ������
			$templates = preg_replace("[err_message]",$message,$templates);//������ ��������������� � ������� �� ��������� ���������
		}
    return $templates; //����� html ����
}
?>