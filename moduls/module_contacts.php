<?php
function contacts()//Функция вывода контактных данных администрации
{
    $result_index = mysql_query("SELECT * FROM user");//Вывод из таблицы(контакты) всех записей
    $myrow_index = mysql_fetch_array($result_index);
    if($myrow_index[skype].$myrow_index[icq].$myrow_index[mail].$myrow_index[note] != "")//Если результат запроса имеет данные...
    {
        $templates = file("templates/module_contacts.html");//Подключаю шаблон
        $templates = implode("",$templates);//Склеивание массива, возвращенного функцией file()
        do
        {
            if($myrow_index[name] != "") $templates = str_replace("[_name]",'<tr><td align="center" colspan="2"><font><b>'.$myrow_index[name].'</b></font></td></tr>',$templates);
            else $templates = str_replace("[_name]",'',$templates);
            if($myrow_index[skype] != "") $templates = str_replace("[_skype]",'<tr><td width="25%">Skype:</td><td align="center"><a href="skype:'.$myrow_index[skype].'?chat" title="Отправить сообщение">
					<img src="http://mystatus.skype.com/smallclassic/'.$myrow_index[skype].'"></a></td></tr>',$templates);
            else $templates = str_replace("[_skype]",'',$templates);
            if($myrow_index[icq] != "") $templates = str_replace("[_icq]",'<tr><td width="25%">ICQ:</td><td align="center"><a href="http://www.icq.com/people/webmsg.php?to='.$myrow_index[icq].'" title="Отправить сообщение">
					<img src="http://www.icq.com/scripts/online.dll?icq='.$myrow_index[icq].'&img=27"></a></td></tr>',$templates);
            else $templates = str_replace("[_icq]",'',$templates);
            if($myrow_index[mail] != "") $templates = str_replace("[_mail]",'<tr><td width="25%">eMail:</td><td align="center"><a href="mailto:'.$myrow_index[mail].'?subject=Письмо от интернет-магазина" title="Написать письмо">'.$myrow_index[mail].'</a></td></tr>',$templates);
            else $templates = str_replace("[_mail]",'',$templates);
            if($myrow_index[note] != "") $templates = str_replace("[_note]",'<tr><td align="center" colspan="2"><font>'.$myrow_index[note].'</font></td></tr>',$templates);
            else $templates = str_replace("[_note]",'',$templates);
        }
        while($myrow_index = mysql_fetch_array($result_index));
        return $templates;//Вывод сгенерированного html кода
    }
    else return "";//Если результат запроса данных не имеет (пустой)...
}