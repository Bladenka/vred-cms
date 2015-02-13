<?php
include("moduls/db.php");

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    if(!preg_match("/^[0-9]+$/",$id))
    {
        header("location: buy.php");
        exit;
    }
}

if(isset($_GET['page']))
{
    $pn = $_GET['page'];
    if(!preg_match("/^[0-9]+$/",$pn))
    {
        header("location: buy.php");
        exit;
    }
    if(preg_match("/^[0]+$/",$pn))
    {
        header("location: buy.php?page=1");
        exit;
    }
}
if(!isset($pn))$pn = 1;

if(!$id)
{
    include("moduls/acc_preview.php");
    $content1 = acc_preview();
    include("moduls/module_contacts.php");
    $moduls = contacts();
    include("moduls/module_statistics.php");
    $moduls .= statistics();
}
else
{
    include("moduls/acc_items.php");
    $content2 = acc_items($id);
}

include("moduls/menu.php");
$menu = menu();

include("templates/index.html");