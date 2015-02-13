<?php
@$result_meta = mysql_query("SELECT * FROM page WHERE id='1'");//Запрос на вывод системных данных (заголовок сайта)
@$myrow_meta = mysql_fetch_array($result_meta);

if($myrow_meta != "")
{
    $result_meta_acc = mysql_query("SELECT title FROM accounts WHERE id='$id'");//Запрос на вывод заголовка выбранного аккаунта
    $meta_acc = mysql_fetch_array($result_meta_acc);
    if($meta_acc[title] != "") $header_title = $meta_acc[title]." - ".$myrow_meta[title];//Заголовок страницы (Имя аккаунта - имя сайта)
    else $header_title = $myrow_meta[title];//Заголовок страницы (Имя аккаунта - имя сайта)
    $header_metaD = $myrow_meta[meta_d]; //метатеги
    $header_metaK = $myrow_meta[meta_k]; //ключивые слова
}

function acc_items($id) //функция вывода детального описания выбранного аккаунта
{
    $result_index = mysql_query("SELECT * FROM accounts WHERE id='$id'");//Вывожу из БД выбранный пользователем аккаунт
    $myrow_index = mysql_fetch_array($result_index);
    if($myrow_index != "")//Если результат запроса имеет данные...
    {
        $templates = file("templates/acc_items.html");//Подключаю шаблон
        $templates = implode("",$templates);//Склеивание массива, возвращенного функцией file()

        //Замена идентификаторов в шаблоне на переменные из БД
        $templates = str_replace("[_id]",$myrow_index[id],$templates);//ид
        $templates = str_replace("[_title]",$myrow_index[title],$templates);//Заголовок
        $templates = str_replace("[_preview_ship]",$myrow_index[preview_ship],$templates);//Предпросмотр корабля
        $templates = str_replace("[_server]",$myrow_index[server],$templates);//Сервер
        $templates = str_replace("[_corp]",$myrow_index[corp],$templates);//Компания
        $templates = str_replace("[_level]",$myrow_index[level],$templates);//Игровой уровень

//--------Основное--------
        if($myrow_index[drones] != "") $templates = str_replace("[_drones]",'<tr><td width="25%"><font>Дроиды ('.strlen($myrow_index[drones]).'):</font></td><td width="75%"><font>'.$myrow_index[drones].'</font></td></tr>',$templates);
        else $templates = str_replace("[_drones]",'',$templates);
        if($myrow_index[rank] != "") $templates = str_replace("[_rank]",'<tr><td width="25%"><font>Очки ранга:</font></td><td width="75%"><font>'.number_format($myrow_index[rank],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_rank]",'',$templates);
        if($myrow_index[exp] != "") $templates = str_replace("[_exp]",'<tr><td width="25%"><font>Опыт:</font></td><td width="75%"><font>'.number_format($myrow_index[exp],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_exp]",'',$templates);
        if($myrow_index[honor] != "") $templates = str_replace("[_honor]",'<tr><td width="25%"><font>Честь:</font></td><td width="75%"><font>'.number_format($myrow_index[honor],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_honor]",'',$templates);
        if($myrow_index[uri] != "") $templates = str_replace("[_uri]",'<tr><td width="25%"><font>Уридиум:</font></td><td width="75%"><font>'.number_format($myrow_index[uri],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_uri]",'',$templates);
        if($myrow_index[cr] != "") $templates = str_replace("[_cr]",'<tr><td width="25%"><font>Кредиты:</font></td><td width="75%"><font>'.number_format($myrow_index[cr],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_cr]",'',$templates);

        if($myrow_index[prog] != "") $templates = str_replace("[_prog]",'<tr><td width="25%"><font>Очки прогресса:</font></td><td width="75%"><font>'.$myrow_index[prog].'</font></td></tr>',$templates);
        else $templates = str_replace("[_prog]",'',$templates);
        if($myrow_index[jackpot] != "") $templates = str_replace("[_jackpot]",'<tr><td width="25%"><font>Джекпот:</font></td><td width="75%"><font>'.number_format($myrow_index[jackpot],0,'','.').' EUR</font></td></tr>',$templates);
        else $templates = str_replace("[_jackpot]",'',$templates);
        if($myrow_index[hangar] != "") $templates = str_replace("[_hangar]",'<tr><td width="25%"><font>Cлотов ангара:</font></td><td width="75%"><font>'.$myrow_index[hangar].'</font></td></tr>',$templates);
        else $templates = str_replace("[_hangar]",'',$templates);
        if($myrow_index[tech] != "") $templates = str_replace("[_tech]",'<tr><td width="25%"><font>Cлотов хай-тек:</font></td><td width="75%"><font>'.$myrow_index[tech].'</font></td></tr>',$templates);
        else $templates = str_replace("[_tech]",'',$templates);
//--------Основное--------

//--------Оружие/Генераторы--------
        if($myrow_index[lf3] != "") $templates = str_replace("[_lf3]",'<tr><td width="25%"><font>Лазеры типа LF-3:</font></td><td width="75%"><font>'.$myrow_index[lf3].'</font></td></tr>',$templates);
        else $templates = str_replace("[_lf3]",'',$templates);
        if($myrow_index[lf4] != "") $templates = str_replace("[_lf4]",'<tr><td width="25%"><font>Лазеры типа LF-4:</font></td><td width="75%"><font>'.$myrow_index[lf4].'</font></td></tr>',$templates);
        else $templates = str_replace("[_lf4]",'',$templates);
        if($myrow_index[g3n7900] != "") $templates = str_replace("[_g3n7900]",'<tr><td width="25%"><font>Двигатели G3N-7900:</font></td><td width="75%"><font>'.$myrow_index[g3n7900].'</font></td></tr>',$templates);
        else $templates = str_replace("[_g3n7900]",'',$templates);
        if($myrow_index[sg3nb02] != "") $templates = str_replace("[_sg3nb02]",'<tr><td width="25%"><font>Щиты SG3N-B02:</font></td><td width="75%"><font>'.$myrow_index[sg3nb02].'</font></td></tr>',$templates);
        else $templates = str_replace("[_sg3nb02]",'',$templates);

        $all_armor = $myrow_index[mcb25].$myrow_index[lf3].$myrow_index[lf4].$myrow_index[g3n7900].$myrow_index[sg3nb02];
        if($all_armor == "")$templates = preg_replace("/\[_armor\].*?\[_armor\]/s",'',$templates);//Замена идентификаторов на выводимое сообщение
        else $templates = str_replace("[_armor]",'',$templates);
//--------Оружие/Генераторы--------

//--------Боеприпасы--------
        if($myrow_index[mcb25] != "") $templates = str_replace("[_mcb25]",'<tr><td width="25%"><font>Батареи типа MCB-25:</font></td><td width="75%"><font>'.number_format($myrow_index[mcb25],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_mcb25]",'',$templates);
        if($myrow_index[mcb50] != "") $templates = str_replace("[_mcb50]",'<tr><td width="25%"><font>Батареи типа MCB-50:</font></td><td width="75%"><font>'.number_format($myrow_index[mcb50],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_mcb50]",'',$templates);
        if($myrow_index[sab50] != "") $templates = str_replace("[_sab50]",'<tr><td width="25%"><font>Батареи типа SAB-50:</font></td><td width="75%"><font>'.number_format($myrow_index[sab50],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_sab50]",'',$templates);
        if($myrow_index[ucb100] != "") $templates = str_replace("[_ucb100]",'<tr><td width="25%"><font>Батареи типа UCB-100:</font></td><td width="75%"><font>'.number_format($myrow_index[ucb100],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_ucb100]",'',$templates);
        if($myrow_index[rsb75] != "") $templates = str_replace("[_rsb75]",'<tr><td width="25%"><font>Батареи типа RSB-75:</font></td><td width="75%"><font>'.number_format($myrow_index[rsb75],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_rsb75]",'',$templates);
        if($myrow_index[cbo100] != "") $templates = str_replace("[_cbo100]",'<tr><td width="25%"><font>Батареи типа CBO-100:</font></td><td width="75%"><font>'.number_format($myrow_index[cbo100],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_cbo100]",'',$templates);
        if($myrow_index[job100] != "") $templates = str_replace("[_job100]",'<tr><td width="25%"><font>Батареи типа JOB-100:</font></td><td width="75%"><font>'.number_format($myrow_index[job100],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_job100]",'',$templates);
        if($myrow_index[plt2021] != "") $templates = str_replace("[_plt2021]",'<tr><td width="25%"><font>Ракеты типа PLT-2021:</font></td><td width="75%"><font>'.number_format($myrow_index[plt2021],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_plt2021]",'',$templates);
        if($myrow_index[plt3030] != "") $templates = str_replace("[_plt3030]",'<tr><td width="25%"><font>Ракеты типа PLT-3030:</font></td><td width="75%"><font>'.number_format($myrow_index[plt3030],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_plt3030]",'',$templates);
        if($myrow_index[dcr250] != "") $templates = str_replace("[_dcr250]",'<tr><td width="25%"><font>Ракеты типа DCR-250:</font></td><td width="75%"><font>'.number_format($myrow_index[dcr250],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_dcr250]",'',$templates);
        if($myrow_index[hstrm01] != "") $templates = str_replace("[_hstrm01]",'<tr><td width="25%"><font>Ракетомёты типа HSTRM-01:</font></td><td width="75%"><font>'.number_format($myrow_index[hstrm01],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_hstrm01]",'',$templates);
        if($myrow_index[ubr100] != "") $templates = str_replace("[_ubr100]",'<tr><td width="25%"><font>Ракетомёты типа UBR-100:</font></td><td width="75%"><font>'.number_format($myrow_index[ubr100],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_ubr100]",'',$templates);
        if($myrow_index[sar02] != "") $templates = str_replace("[_sar02]",'<tr><td width="25%"><font>Ракетомёты типа SAR-02:</font></td><td width="75%"><font>'.number_format($myrow_index[sar02],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_sar02]",'',$templates);
        if($myrow_index[cbr] != "") $templates = str_replace("[_cbr]",'<tr><td width="25%"><font>Ракетомёты типа CBR:</font></td><td width="75%"><font>'.number_format($myrow_index[cbr],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_cbr]",'',$templates);
        if($myrow_index[acm1] != "") $templates = str_replace("[_acm1]",'<tr><td width="25%"><font>Мины типа ACM-1:</font></td><td width="75%"><font>'.number_format($myrow_index[acm1],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_acm1]",'',$templates);
        if($myrow_index[empm01] != "") $templates = str_replace("[_empm01]",'<tr><td width="25%"><font>Мины типа EMP-M01:</font></td><td width="75%"><font>'.number_format($myrow_index[empm01],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_empm01]",'',$templates);
        if($myrow_index[subm01] != "") $templates = str_replace("[_subm01]",'<tr><td width="25%"><font>Мины типа SUB-M01:</font></td><td width="75%"><font>'.number_format($myrow_index[subm01],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_subm01]",'',$templates);
        if($myrow_index[ddm01] != "") $templates = str_replace("[_ddm01]",'<tr><td width="25%"><font>Мины типа DD-M01:</font></td><td width="75%"><font>'.number_format($myrow_index[ddm01],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_ddm01]",'',$templates);
        if($myrow_index[slm01] != "") $templates = str_replace("[_slm01]",'<tr><td width="25%"><font>Мины типа SL-M01:</font></td><td width="75%"><font>'.number_format($myrow_index[slm01],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_slm01]",'',$templates);
        if($myrow_index[emp01] != "") $templates = str_replace("[_emp01]",'<tr><td width="25%"><font>Импульс EMP-01:</font></td><td width="75%"><font>'.number_format($myrow_index[emp01],0,'','.').'</font></td></tr>',$templates);
        else $templates = str_replace("[_emp01]",'',$templates);

        $all_ammo = $myrow_index[mcb25].$myrow_index[mcb50].$myrow_index[sab50].$myrow_index[ucb100].$myrow_index[rsb75].$myrow_index[cbo100].$myrow_index[job100].$myrow_index[plt2021].$myrow_index[plt3030].$myrow_index[dcr250].$myrow_index[hstrm01].$myrow_index[ubr100].$myrow_index[sar02].$myrow_index[cbr].$myrow_index[acm1].$myrow_index[empm01].$myrow_index[subm01].$myrow_index[ddm01].$myrow_index[slm01].$myrow_index[emp01];
        if($all_ammo == "")$templates = preg_replace("/\[_ammo\].*?\[_ammo\]/s",'',$templates);//Замена идентификаторов на выводимое сообщение
        else $templates = str_replace("[_ammo]",'',$templates);
//--------Боеприпасы--------

//--------Доп--------
        if($myrow_index[more] != "") $templates = str_replace("[_more]",'<font color="Orange" size="2pt"><strong>Дополнительное описание:</strong></font><br><font>'.$myrow_index[more].'</font><br><br>',$templates);
        else $templates = str_replace("[_more]",'',$templates);
        if($myrow_index[admin_text] != "") $templates = str_replace("[_admin_text]",'<font class="star" size="2pt"><strong>Примечание администрации:</font><br><font>'.$myrow_index[admin_text].'</font></strong>',$templates);
        else $templates = str_replace("[_admin_text]",'',$templates);
//--------Доп--------

//--------Замена кнопки с ценой, если аккаунт продан--------
        if($myrow_index[status] == "2")$templates = preg_replace("/\[_button\].*?\[_button\]/s",'<font class="title">'.number_format($myrow_index[price],0,'','.').' руб.</font><br><br><font>Продан: '.$myrow_index[sold_date].'</font>',$templates);//Замена идентификаторов на выводимое сообщение
        else $templates = str_replace("[_button]",'',$templates);
//--------Замена кнопки с ценой, если аккаунт продан--------

        $templates = str_replace("[_price]",number_format($myrow_index[price],0,'','.'),$templates);//Цена
    }
    else //Если результат запроса данных не имеет (пустой)...
    {
        $templates = file("templates/error.html");//Подключение шаблона ошибки
        $templates = implode("",$templates); //Склеивание массива, возвращенного функцией file()
        $title = 'Ошибка'; //Заголовок ошибки
        $message = 'Аккаунт с указанным идентификатором(номером) не существует. Если вы уверены, что использовали правильную ссылку, свяжитесь с администрацией'; //Выводимое сообщение
        $templates = preg_replace("[err_title]",$title,$templates);//Замена идентификаторов в шаблоне на заголовок ошибки
        $templates = preg_replace("[err_message]",$message,$templates);//Замена идентификаторов в шаблоне на выводимое сообщение
    }
    return $templates;//Вывод сгенерированного html кода
}