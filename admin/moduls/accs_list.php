<?php
//��������
if($_GET['del_post'])$del_post = $_GET['del_post'];//�������� GET-���������� ���������� ID ��������� �������
if($del_post)//���� ���������� ����������...
{
    $result_del_post = mysql_query ("DELETE FROM accounts WHERE id='$del_post'");//������ ������ � ������� id ����� GET-����������
    header("location: ".getenv('HTTP_REFERER'));//��������������� �� ��� �� ��������
    exit;
}
//��������

//------���������� �������������� ��������
//��������� ������������� ��������� ���������� �� ����� �������� ������
//--------��������--------
if(isset($_POST['update_post_id_acc']))$update_post_id_acc = $_POST['update_post_id_acc'];
if(isset($_POST['update_post_preview_ship']))$update_post_preview_ship = $_POST['update_post_preview_ship'];
if(isset($_POST['update_post_title']))$update_post_title = $_POST['update_post_title'];
if(isset($_POST['update_post_server']))$update_post_server = $_POST['update_post_server'];
if(isset($_POST['update_post_corp']))$update_post_corp = $_POST['update_post_corp'];
if(isset($_POST['update_post_level']))$update_post_level = $_POST['update_post_level'];
if(isset($_POST['update_post_exp']))$update_post_exp = $_POST['update_post_exp'];
if(isset($_POST['update_post_honor']))$update_post_honor = $_POST['update_post_honor'];
if(isset($_POST['update_post_rank']))$update_post_rank = $_POST['update_post_rank'];
if(isset($_POST['update_post_uri']))$update_post_uri = $_POST['update_post_uri'];
if(isset($_POST['update_post_cr']))$update_post_cr = $_POST['update_post_cr'];
if(isset($_POST['update_post_jackpot']))$update_post_jackpot = $_POST['update_post_jackpot'];
if(isset($_POST['update_post_hangar']))$update_post_hangar = $_POST['update_post_hangar'];
if(isset($_POST['update_post_tech']))$update_post_tech = $_POST['update_post_tech'];
if(isset($_POST['update_post_prog']))$update_post_prog = $_POST['update_post_prog'];
//--------��������--------

//--------������--------
if(isset($_POST['update_post_drones']))$update_post_drones = $_POST['update_post_drones'];
//--------������--------

//--------������/����������--------
if(isset($_POST['update_post_lf3']))$update_post_lf3 = $_POST['update_post_lf3'];
if(isset($_POST['update_post_lf4']))$update_post_lf4 = $_POST['update_post_lf4'];
if(isset($_POST['update_post_g3n7900']))$update_post_g3n7900 = $_POST['update_post_g3n7900'];
if(isset($_POST['update_post_sg3nb02']))$update_post_sg3nb02 = $_POST['update_post_sg3nb02'];
//--------������/����������--------

//--------����������--------
if(isset($_POST['update_post_mcb25']))$update_post_mcb25 = $_POST['update_post_mcb25'];
if(isset($_POST['update_post_mcb50']))$update_post_mcb50 = $_POST['update_post_mcb50'];
if(isset($_POST['update_post_sab50']))$update_post_sab50 = $_POST['update_post_sab50'];
if(isset($_POST['update_post_ucb100']))$update_post_ucb100 = $_POST['update_post_ucb100'];
if(isset($_POST['update_post_rsb75']))$update_post_rsb75 = $_POST['update_post_rsb75'];
if(isset($_POST['update_post_cbo100']))$update_post_cbo100 = $_POST['update_post_cbo100'];
if(isset($_POST['update_post_job100']))$update_post_job100 = $_POST['update_post_job100'];
if(isset($_POST['update_post_plt2021']))$update_post_plt2021 = $_POST['update_post_plt2021'];
if(isset($_POST['update_post_plt3030']))$update_post_plt3030 = $_POST['update_post_plt3030'];
if(isset($_POST['update_post_dcr250']))$update_post_dcr250 = $_POST['update_post_dcr250'];
if(isset($_POST['update_post_hstrm01']))$update_post_hstrm01 = $_POST['update_post_hstrm01'];
if(isset($_POST['update_post_ubr100']))$update_post_ubr100 = $_POST['update_post_ubr100'];
if(isset($_POST['update_post_sar02']))$update_post_sar02 = $_POST['update_post_sar02'];
if(isset($_POST['update_post_cbr']))$update_post_cbr = $_POST['update_post_cbr'];
if(isset($_POST['update_post_acm1']))$update_post_acm1 = $_POST['update_post_acm1'];
if(isset($_POST['update_post_empm01']))$update_post_empm01 = $_POST['update_post_empm01'];
if(isset($_POST['update_post_subm01']))$update_post_subm01 = $_POST['update_post_subm01'];
if(isset($_POST['update_post_ddm01']))$update_post_ddm01 = $_POST['update_post_ddm01'];
if(isset($_POST['update_post_slm01']))$update_post_slm01 = $_POST['update_post_slm01'];
if(isset($_POST['update_post_emp01']))$update_post_emp01 = $_POST['update_post_emp01'];
//--------����������--------

if(isset($_POST['update_post_more']))$update_post_more = $_POST['update_post_more'];
if(isset($_POST['update_post_admin_text']))$update_post_admin_text = $_POST['update_post_admin_text'];
if($update_post_admin_text == "") $update_post_admin_text = "��������� � �������� �� ��������. ������� ������������� ���������� ���������������.";
if(isset($_POST['update_post_price']))$update_post_price = $_POST['update_post_price'];

//�������� ����������, ���� ����� ���� ���������� (sumbit �� ����� �������������� ������)
if($update_post_title & $update_post_price)//���� ��������� ���������� ���������� ��� ������������...
{   
	$result = mysql_query ("UPDATE accounts SET id_acc='$update_post_id_acc',preview_ship='$update_post_preview_ship',title='$update_post_title',server='$update_post_server',corp='$update_post_corp',level='$update_post_level',
	exp='$update_post_exp',honor='$update_post_honor',rank='$update_post_rank',uri='$update_post_uri',cr='$update_post_cr',jackpot='$update_post_jackpot',hangar='$update_post_hangar',tech='$update_post_tech',
	prog='$update_post_prog',drones='$update_post_drones',lf3='$update_post_lf3',lf4='$update_post_lf4',g3n7900='$update_post_g3n7900',sg3nb02='$update_post_sg3nb02',mcb25='$update_post_mcb25',mcb50='$update_post_mcb50',
	sab50='$update_post_sab50',ucb100='$update_post_ucb100',rsb75='$update_post_rsb75',cbo100='$update_post_cbo100',job100='$update_post_job100',plt2021='$update_post_plt2021',plt3030='$update_post_plt3030',
	dcr250='$update_post_dcr250',hstrm01='$update_post_hstrm01',ubr100='$update_post_ubr100',sar02='$update_post_sar02',cbr='$update_post_cbr',acm1='$update_post_acm1',empm01='$update_post_empm01',subm01='$update_post_subm01',
	ddm01='$update_post_ddm01',slm01='$update_post_slm01',emp01='$update_post_emp01',more='$update_post_more',admin_text='$update_post_admin_text',price='$update_post_price' WHERE id='$id'");//������ ������ � �� 
    header("location: ?page=accs_config&id=$id");//��������������� �� �������� � �����������
    exit;
}
//------���������� �������������� ��������

function accs_unverified()//������� ������ ������ ����� ���������
{
	$result_index = mysql_query("SELECT * FROM accounts WHERE status='0' ORDER BY price DESC");//������ �� ������� "accounts(��������)" ������ �� �������� 0 (�����) (���������� �� �������� ����)
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//���� ��������� ������� ����� ������...
		{
			$templates = file("templates/accs_unverified.html");//��������� ������
			$templates = implode("",$templates);//���������� �������, ������������� �������� file()
			preg_match("/\[_while\](.*?)\[_while\]/s",$templates,$tamp_while);//���������� ���������, ����������� �������� �� ������� ������ �� �����, ������� ������ �����������
			do
			{
				$copy_tamp = $tamp_while[1];/*��� ��� ���� �������� ������� ������(�������� �������������� �� ���������� �� �������), ������� ���(������) � ��������� ����������, 
				����� �������� ������������ �������� file() ���� ��� 1 ���, � ��� �������������� �������� �� ������*/
				//������ ��������������� �� ���������� �� �������
				$copy_tamp = str_replace("[_id]",$myrow_index[id],$copy_tamp);//ID
				$copy_tamp = str_replace("[_server]",$myrow_index[server],$copy_tamp);//������
				$copy_tamp = str_replace("[_login_acc]",$myrow_index[login_acc],$copy_tamp);//����� ��������
				$copy_tamp = str_replace("[_pass_acc]",$myrow_index[pass_acc],$copy_tamp);//������ ��������
				$copy_tamp = str_replace("[_mail]",$myrow_index[mail],$copy_tamp);//����
				$copy_tamp = str_replace("[_mail_pass]",$myrow_index[mail_pass],$copy_tamp);//������ �� �����
				$copy_tamp = str_replace("[_price]",number_format($myrow_index[price],0,'','.'),$copy_tamp);//����
				$list .= $copy_tamp;//����� ���� ��������������� ��� � ���� ����������
			}
			while($myrow_index = mysql_fetch_array($result_index));
			$templates = preg_replace("/\[_while\].*?\[_while\]/s",$list,$templates);//������ [_while]...[_while] ����������� ��������������� html ��� �� $list
		}
		else 
		{//���� ��������� ������� ������ �� ����� (������)...
			$templates = file("templates/error.html"); //����������� �������
			$templates = implode("",$templates); //���������� �������, ������������� �������� file()
			$title = '����� ��������'; //��������� ������
			$message = '��� ������� � ���� ������'; //��������� ���������
			$templates = preg_replace("[err_title]",$title,$templates);//������ ��������������� � ������� �� ��������� ������
			$templates = preg_replace("[err_message]",$message,$templates);//������ ��������������� � ������� �� ��������� ���������
		}
	return $templates;//����� ���������������� html ����
}

function accs_verified()//������� ������ ������ ���������� ���������
{
	$result_index = mysql_query("SELECT * FROM accounts WHERE status='1' ORDER BY id DESC");//������ �� ������� "accounts(��������)" ������ �� �������� 1 (����������) (���������� �� �������� id)
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//���� ��������� ������� ����� ������...
		{
			$templates = file("templates/accs_verified.html");//��������� ������
			$templates = implode("",$templates);//���������� �������, ������������� �������� file()
			preg_match("/\[_while\](.*?)\[_while\]/s",$templates,$tamp_while);//���������� ���������, ����������� �������� �� ������� ������ �� �����, ������� ������ �����������
			do
			{
				$copy_tamp = $tamp_while[1];/*��� ��� ���� �������� ������� ������(�������� �������������� �� ���������� �� �������), ������� ���(������) � ��������� ����������, 
				����� �������� ������������ �������� file() ���� ��� 1 ���, � ��� �������������� �������� �� ������*/
				//������ ��������������� �� ���������� �� �������
				$copy_tamp = str_replace("[_id]",$myrow_index[id],$copy_tamp);//ID
				$copy_tamp = str_replace("[_title]",$myrow_index[title],$copy_tamp);//���������
				$copy_tamp = str_replace("[_price]",number_format($myrow_index[price],0,'','.'),$copy_tamp);//����
				$list .= $copy_tamp;//����� ���� ��������������� ��� � ���� ����������
			}
			while($myrow_index = mysql_fetch_array($result_index));
			$templates = preg_replace("/\[_while\].*?\[_while\]/s",$list,$templates);//������ [_while]...[_while] ����������� ��������������� html ��� �� $list
		}
		else 
		{//���� ��������� ������� ������ �� ����� (������)...
			$templates = file("templates/error.html"); //����������� �������
			$templates = implode("",$templates); //���������� �������, ������������� �������� file()
			$title = '���������� ��������'; //��������� ������
			$message = '��� ������� � ���� ������'; //��������� ���������
			$templates = preg_replace("[err_title]",$title,$templates);//������ ��������������� � ������� �� ��������� ������
			$templates = preg_replace("[err_message]",$message,$templates);//������ ��������������� � ������� �� ��������� ���������
		}
	return $templates;//����� ���������������� html ����
}

function accs_sold()//������� ������ ������ ��������� ���������
{
	$result_index = mysql_query("SELECT * FROM accounts WHERE status='2' ORDER BY sold_date DESC");//������ �� ������� "accounts(��������)" ������ �� �������� 2 (���������) (���������� �� �������� ����)
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//���� ��������� ������� ����� ������...
		{ 
			$templates = file("templates/accs_sold.html");//��������� ������
			$templates = implode("",$templates);//���������� �������, ������������� �������� file()
			preg_match("/\[_while\](.*?)\[_while\]/s",$templates,$tamp_while);//���������� ���������, ����������� �������� �� ������� ������ �� �����, ������� ������ �����������
			do
			{
				$copy_tamp = $tamp_while[1];/*��� ��� ���� �������� ������� ������(�������� �������������� �� ���������� �� �������), ������� ���(������) � ��������� ����������, 
				����� �������� ������������ �������� file() ���� ��� 1 ���, � ��� �������������� �������� �� ������*/
				
				//������ ��������������� �� ���������� �� �������
				$copy_tamp = str_replace("[_id]",$myrow_index[id],$copy_tamp);//ID
				$copy_tamp = str_replace("[_payout]",$myrow_index[payout],$copy_tamp);//������ �������
				$copy_tamp = str_replace("[_title]",$myrow_index[title],$copy_tamp);//���������
				$copy_tamp = str_replace("[_sold_date]",$myrow_index[sold_date],$copy_tamp);//����
					$price = round($myrow_index[price] * 0.2); //
					$total += $price; //���� ������ ������� �������
				$copy_tamp = str_replace("[_price]",number_format($price,0,'','.'),$copy_tamp);//������ ������� � ��������
				$list .= $copy_tamp;//����� ���� ��������������� ��� � ���� ����������
			}
			while($myrow_index = mysql_fetch_array($result_index));
			$templates = str_replace("[_total]",number_format($total,0,'','.'),$templates); //���� � �������� ��������� �������
			$templates = preg_replace("/\[_while\].*?\[_while\]/s",$list,$templates);//������ [_while]...[_while] ����������� ��������������� html ��� �� $list
		}
		else 
		{//���� ��������� ������� ������ �� ����� (������)...
			$templates = file("templates/error.html"); //����������� �������
			$templates = implode("",$templates); //���������� �������, ������������� �������� file()
			$title = '��������� ��������'; //��������� ������
			$message = '��� ������� � ���� ������'; //��������� ���������
			$templates = preg_replace("[err_title]",$title,$templates);//������ ��������������� � ������� �� ��������� ������
			$templates = preg_replace("[err_message]",$message,$templates);//������ ��������������� � ������� �� ��������� ���������
		}
	return $templates;//����� ���������������� html ����
}

function accs_update($id)//������� �������������� ������ �� ��������
{
	$result_index = mysql_query("SELECT * FROM accounts WHERE id='$id'");//������ �� ������� "accounts(��������)" ��������� ������
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//���� ��������� ������� ����� ������...
		{
			$templates = file("templates/accs_update.html");//��������� ������
			$templates = implode("",$templates);//���������� �������, ������������� �������� file()
			//������ ��������������� � ������� �� ���������� �� ��
			$templates = str_replace("[_id]",$myrow_index[id],$templates);//��
			$templates = str_replace("[_title]",$myrow_index[title],$templates);//���������
			$templates = str_replace("[_id_acc]",$myrow_index[id_acc],$templates);//�� ��������
			$templates = str_replace("[_preview_ship]",$myrow_index[preview_ship],$templates);//������������ �������
			$templates = str_replace("[_server]",$myrow_index[server],$templates);//������
			$templates = str_replace("[_corp]",$myrow_index[corp],$templates);//��������
			$templates = str_replace("[_level]",$myrow_index[level],$templates);//������� �������
				
		//--------��������--------			
			if($myrow_index[drones] != "") $templates = str_replace("[_drones]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_drones" value="'.$myrow_index[drones].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>������ ('.strlen($myrow_index[drones]).')</font></td></tr>',$templates);
			else $templates = str_replace("[_drones]",'',$templates);//������
			if($myrow_index[rank] != "") $templates = str_replace("[_rank]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_rank" value="'.$myrow_index[rank].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>���� �����</font></td></tr>',$templates);
			else $templates = str_replace("[_rank]",'',$templates);//���� �����
			if($myrow_index[exp] != "") $templates = str_replace("[_exp]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_exp" value="'.$myrow_index[exp].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>����</font></td></tr>',$templates);
			else $templates = str_replace("[_exp]",'',$templates);//����		
			if($myrow_index[honor] != "") $templates = str_replace("[_honor]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_honor" value="'.$myrow_index[honor].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>�����</font></td></tr>',$templates);
			else $templates = str_replace("[_honor]",'',$templates);//�����			
			if($myrow_index[uri] != "") $templates = str_replace("[_uri]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_uri" value="'.$myrow_index[uri].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>�������</font></td></tr>',$templates);
			else $templates = str_replace("[_uri]",'',$templates);//�������			
			if($myrow_index[cr] != "") $templates = str_replace("[_cr]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_cr" value="'.$myrow_index[cr].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>�������</font></td></tr>',$templates);
			else $templates = str_replace("[_cr]",'',$templates);//�������			
			if($myrow_index[prog] != "") $templates = str_replace("[_prog]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_prog" value="'.$myrow_index[prog].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>���� ���������</font></td></tr>',$templates);
			else $templates = str_replace("[_prog]",'',$templates);//���� ���������		
			if($myrow_index[jackpot] != "") $templates = str_replace("[_jackpot]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_jackpot" value="'.$myrow_index[jackpot].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>�������</font></td></tr>',$templates);
			else $templates = str_replace("[_jackpot]",'',$templates);//�������			
			if($myrow_index[hangar] != "") $templates = str_replace("[_hangar]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_hangar" value="'.$myrow_index[hangar].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>C����� ������</font></td></tr>',$templates);
			else $templates = str_replace("[_hangar]",'',$templates);//C����� ������			
			if($myrow_index[tech] != "") $templates = str_replace("[_tech]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_tech" value="'.$myrow_index[tech].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>C����� ���-���</font></td></tr>',$templates);
			else $templates = str_replace("[_tech]",'',$templates);//C����� ���-���
		//--------��������--------	
					
		//--------������/����������--------		
			if($myrow_index[lf3] != "") $templates = str_replace("[_lf3]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_lf3" value="'.$myrow_index[lf3].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>������ ���� LF-3</font></td></tr>',$templates);
			else $templates = str_replace("[_lf3]",'',$templates);//������ ���� LF-3			
			if($myrow_index[lf4] != "") $templates = str_replace("[_lf4]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_lf4" value="'.$myrow_index[lf4].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>������ ���� LF-4</font></td></tr>',$templates);
			else $templates = str_replace("[_lf4]",'',$templates);//������ ���� LF-4		
			if($myrow_index[g3n7900] != "") $templates = str_replace("[_g3n7900]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_g3n7900" value="'.$myrow_index[g3n7900].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>��������� G3N-7900</font></td></tr>',$templates);
			else $templates = str_replace("[_g3n7900]",'',$templates);//��������� G3N-7900		
			if($myrow_index[sg3nb02] != "") $templates = str_replace("[_sg3nb02]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_sg3nb02" value="'.$myrow_index[sg3nb02].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>���� SG3N-B02</font></td></tr>',$templates);
			else $templates = str_replace("[_sg3nb02]",'',$templates);//���� SG3N-B02		
			
			$all_armor = $myrow_index[lf3].$myrow_index[lf4].$myrow_index[g3n7900].$myrow_index[sg3nb02];
			if($all_armor == "")$templates = preg_replace("/\[_armor\].*?\[_armor\]/s",'',$templates);//������ ��������������� �� ��������� ���������
			else $templates = str_replace("[_armor]",'',$templates);
	//--------������/����������--------			
					
	//--------����������--------	
			if($myrow_index[mcb25] != "") $templates = str_replace("[_mcb25]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_mcb25" value="'.$myrow_index[mcb25].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>������� ���� MCB-25</font></td></tr>',$templates);
			else $templates = str_replace("[_mcb25]",'',$templates);//������� ���� MCB-25		
			if($myrow_index[mcb50] != "") $templates = str_replace("[_mcb50]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_mcb50" value="'.$myrow_index[mcb50].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>������� ���� MCB-50</font></td></tr>',$templates);
			else $templates = str_replace("[_mcb50]",'',$templates);//������� ���� MCB-50	
			if($myrow_index[sab50] != "") $templates = str_replace("[_sab50]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_sab50" value="'.$myrow_index[sab50].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>������� ���� SAB-50</font></td></tr>',$templates);
			else $templates = str_replace("[_sab50]",'',$templates);//������� ���� SAB-50	
			if($myrow_index[ucb100] != "") $templates = str_replace("[_ucb100]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_ucb100" value="'.$myrow_index[ucb100].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>������� ���� UCB-100</font></td></tr>',$templates);
			else $templates = str_replace("[_ucb100]",'',$templates);//������� ���� UCB-100
			if($myrow_index[rsb75] != "") $templates = str_replace("[_rsb75]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_rsb75" value="'.$myrow_index[rsb75].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>������� ���� RSB-75</font></td></tr>',$templates);
			else $templates = str_replace("[_rsb75]",'',$templates);//������� ���� RSB-75
			if($myrow_index[cbo100] != "") $templates = str_replace("[_cbo100]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_cbo100" value="'.$myrow_index[cbo100].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>������� ���� CBO-100</font></td></tr>',$templates);
			else $templates = str_replace("[_cbo100]",'',$templates);//������� ���� CBO-100
			if($myrow_index[job100] != "") $templates = str_replace("[_job100]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_job100" value="'.$myrow_index[job100].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>������� ���� JOB-100</font></td></tr>',$templates);
			else $templates = str_replace("[_job100]",'',$templates);//������� ���� JOB-100
			if($myrow_index[plt2021] != "") $templates = str_replace("[_plt2021]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_plt2021" value="'.$myrow_index[plt2021].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>������ ���� PLT-2021</font></td></tr>',$templates);
			else $templates = str_replace("[_plt2021]",'',$templates);//������ ���� PLT-2021
			if($myrow_index[plt3030] != "") $templates = str_replace("[_plt3030]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_plt3030" value="'.$myrow_index[plt3030].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>������ ���� PLT-3030</font></td></tr>',$templates);
			else $templates = str_replace("[_plt3030]",'',$templates);//������ ���� PLT-3030
			if($myrow_index[dcr250] != "") $templates = str_replace("[_dcr250]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_dcr250" value="'.$myrow_index[dcr250].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>������ ���� DCR-250</font></td></tr>',$templates);
			else $templates = str_replace("[_dcr250]",'',$templates);//������ ���� DCR-250
			if($myrow_index[hstrm01] != "") $templates = str_replace("[_hstrm01]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_hstrm01" value="'.$myrow_index[hstrm01].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>��������� ���� HSTRM-01</font></td></tr>',$templates);
			else $templates = str_replace("[_hstrm01]",'',$templates);//��������� ���� HSTRM-01
			if($myrow_index[ubr100] != "") $templates = str_replace("[_ubr100]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_ubr100" value="'.$myrow_index[ubr100].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>��������� ���� UBR-100</font></td></tr>',$templates);
			else $templates = str_replace("[_ubr100]",'',$templates);//��������� ���� UBR-100
			if($myrow_index[sar02] != "") $templates = str_replace("[_sar02]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_sar02" value="'.$myrow_index[sar02].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>��������� ���� SAR-02</font></td></tr>',$templates);
			else $templates = str_replace("[_sar02]",'',$templates);//��������� ���� SAR-02
			if($myrow_index[cbr] != "") $templates = str_replace("[_cbr]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_cbr" value="'.$myrow_index[cbr].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>��������� ���� CBR</font></td></tr>',$templates);
			else $templates = str_replace("[_cbr]",'',$templates);//��������� ���� CBR
			if($myrow_index[acm1] != "") $templates = str_replace("[_acm1]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_acm1" value="'.$myrow_index[acm1].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>���� ���� ACM-1</font></td></tr>',$templates);
			else $templates = str_replace("[_acm1]",'',$templates);//���� ���� ACM-1
			if($myrow_index[empm01] != "") $templates = str_replace("[_empm01]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_empm01" value="'.$myrow_index[empm01].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>���� ���� EMP-M01</font></td></tr>',$templates);
			else $templates = str_replace("[_empm01]",'',$templates);//���� ���� EMP-M01
			if($myrow_index[subm01] != "") $templates = str_replace("[_subm01]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_subm01" value="'.$myrow_index[subm01].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>���� ���� SUB-M01</font></td></tr>',$templates);
			else $templates = str_replace("[_subm01]",'',$templates);//���� ���� SUB-M01
			if($myrow_index[ddm01] != "") $templates = str_replace("[_ddm01]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_ddm01" value="'.$myrow_index[ddm01].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>���� ���� DD-M01</font></td></tr>',$templates);
			else $templates = str_replace("[_ddm01]",'',$templates);//���� ���� DD-M01
			if($myrow_index[slm01] != "") $templates = str_replace("[_slm01]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_slm01" value="'.$myrow_index[slm01].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>���� ���� SL-M01</font></td></tr>',$templates);
			else $templates = str_replace("[_slm01]",'',$templates);//���� ���� SL-M01
			if($myrow_index[emp01] != "") $templates = str_replace("[_emp01]",'<tr><td class="bottom_cfg"><input tabindex="1" type="text" name="update_post_emp01" value="'.$myrow_index[emp01].'" style="width:200px;"/></td>
				<td class="bottom_cfg" width="100%" align="left"><font>������� EMP-01</font></td></tr>',$templates);
			else $templates = str_replace("[_emp01]",'',$templates);//������� EMP-01
			
			$all_ammo = $myrow_index[mcb25].$myrow_index[mcb50].$myrow_index[sab50].$myrow_index[ucb100].$myrow_index[rsb75].$myrow_index[cbo100].$myrow_index[job100].$myrow_index[plt2021].$myrow_index[plt3030].$myrow_index[dcr250].$myrow_index[hstrm01].$myrow_index[ubr100].$myrow_index[sar02].$myrow_index[cbr].$myrow_index[acm1].$myrow_index[empm01].$myrow_index[subm01].$myrow_index[ddm01].$myrow_index[slm01].$myrow_index[emp01];
			if($all_ammo == "")$templates = preg_replace("/\[_ammo\].*?\[_ammo\]/s",'',$templates);//������ ��������������� �� ��������� ���������
			else $templates = str_replace("[_ammo]",'',$templates);
	//--------����������--------			
				
	//--------���--------	
			if($myrow_index[admin_text] != "") $templates = str_replace("[_admin_text]",$myrow_index[admin_text],$templates);
			else $templates = str_replace("[_admin_text]",'',$templates);//���������� �������������
			if($myrow_index[more] != "") $templates = str_replace("[_more]",'<tr><td class="bottom_cfg" colspan="2"><legend>�������������� ��������:</legend>
				<div align="center"><textarea tabindex="1" name="update_post_more" rows="5" dir="ltr" style="width:95%">'.$myrow_index[more].'</textarea></div></td></tr>',$templates);
			else $templates = str_replace("[_more]",'',$templates);//�������������� ��������
			$templates = str_replace("[_price]",$myrow_index[price],$templates);//����
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
	return $templates;//����� ���������������� html ����
}
?>