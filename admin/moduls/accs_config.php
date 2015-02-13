<?php
//Определяю переменные
if(isset($_POST['cfgstatus']))$cfgstatus = $_POST['cfgstatus'];
if(isset($_POST['cfgpayout']))$cfgpayout = $_POST['cfgpayout'];

//ОБРАБОТЧИК
if(isset($cfgstatus) & isset($cfgpayout))//если переменные имеют данные
{
    $newCONFIG = mysql_query ("UPDATE accounts SET sold_date=NOW(),status='$cfgstatus',payout='$cfgpayout' WHERE id='$id'");//обновляем настройки
    header("location: ".getenv('HTTP_REFERER'));//Перенаправление на эту же страницу
    exit;
}
//ОБРАБОТЧИК

function accs_config($id)//Функция изменеия настроек для выбранного аккаунта
{
    $result_index = mysql_query("SELECT * FROM accounts WHERE id='$id'");//Вывожу из таблицы "accounts(аккаунты)" выбранный админом аккаунт
    $myrow_index = mysql_fetch_array($result_index);
    if($myrow_index != "")//Если результат запроса имеет данные...
    {
        $templates = file("templates/accs_config.html");//Подключаю шаблон
        $templates = implode("",$templates);//Склеивание массива, возвращенного функцией file()

        //----- Статус аккаунта ----
        $cfgSTATtext = array("Заявка","Продается","Продан");//Вариант для человека
        $cfgSTATint = array(0,1,2);//Вариант для скрипта
        $cfgSTAT = cfgstatus($myrow_index[status],$cfgSTATtext,$cfgSTATint);//Формируется option для пункта "Статус аккаунта"
        //----- Статус аккаунта ----

        //----- Статус выплаты ----
        $cfgPAYtext = array("Ожидает","Оплачен");//Вариант для человека
        $cfgPAYint = array(0,1);//Вариант для скрипта
        $cfgPAY = cfgpayout($myrow_index[payout],$cfgPAYtext,$cfgPAYint);//Формируется option для пункта "Статус выплаты"
        //----- Статус выплаты ----

        //Замена идентификаторов на информацию из запроса
        $templates = str_replace("[_id]",$myrow_index[id],$templates);//ID
        $templates = str_replace("[_server]",$myrow_index[server],$templates);//Сервер
        $templates = str_replace("[_login_acc]",$myrow_index[login_acc],$templates);//Логин аккаунта
        $templates = str_replace("[_pass_acc]",$myrow_index[pass_acc],$templates);//Пароль аккаунта
        $templates = str_replace("[_mail]",$myrow_index[mail],$templates);//майл
        $templates = str_replace("[_mail_pass]",$myrow_index[mail_pass],$templates);//Пароль майла
        $templates = str_replace("[_price]",$myrow_index[price],$templates);//цена
        $templates = str_replace("[_cfgstatus]",$cfgSTAT,$templates);//статус
        $templates = str_replace("[_wallet_type]",$myrow_index[wallet_type],$templates);//тип кошелька
        $templates = str_replace("[_wallet]",$myrow_index[wallet],$templates);//номер счета
        $templates = str_replace("[_payout_price]",round($myrow_index[price] / 1.2),$templates);//сумма выплаты
        $templates = str_replace("[_cfgpayment]",$cfgPAY,$templates);//статус выплаты
    }
    else
    {//Если результат запроса данных не имеет (пустой)...
        $templates = file("templates/error.html"); //Подключение шаблона
        $templates = implode("",$templates); //Склеивание массива, возвращенного функцией file()
        $title = 'Ошибка'; //Заголовок ошибки
        $message = 'Указан несуществующий идентификатор аккаунта'; //Выводимое сообщение
        $templates = preg_replace("[err_title]",$title,$templates);//Замена идентификаторов в шаблоне на заголовок ошибки
        $templates = preg_replace("[err_message]",$message,$templates);//Замена идентификаторов в шаблоне на выводимое сообщение
    }
    return $templates;//Вывод сгенерированного html кода
}

function cfgstatus($sel)//Функция генерации вариантов статуса аккаунта
{
    for($i=0;$i<3;$i++)
    {
        //в зависимости от переменной i формируется текстовый вариант
        if($i == 0)$txtsel = "Заявка";
        if($i == 1)$txtsel = "Продается";
        if($i == 2)$txtsel = "Продан";
        //определяю какой вариант сейчас выбран
        if($sel == $i)$result .= "<option value='$i' selected>$txtsel</option>";//В option выбранного варианта прописывается selected
        else $result .= "<option value='$i'>$txtsel</option>";//остальные варианты будут без атрибута selected
    }
    return $result;//Вывод сгенерированного html кода
}

function cfgpayout($sel)//Функция генерации вариантов статуса выплат
{
    for($i=0;$i<2;$i++)
    {
        if($i == 0)$txtsel = "Ожидает";
        else $txtsel = "Оплачен";
        if($sel == $i)$result .= "<option value='$i' selected>$txtsel</option>";//Добавляю selected
        else $result .= "<option value='$i'>$txtsel</option>";
    }
    return $result;//Вывод сгенерированного html кода
}