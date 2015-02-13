<?php
include("moduls/db.php");

if (isset($_GET['topic'])) {
    $topic = $_GET['topic'];
    if (!preg_match("/^[0-9]+$/", $topic)) {
        header("location: index.php");
        exit;
    }
}

if (isset($_GET['page'])) {
    $pn = $_GET['page'];
    if (!preg_match("/^[0-9]+$/", $pn)) {
        header("location: index.php");
        exit;
    }
}
if (!isset($pn)) $pn = 1;

if (!$topic) {
    include("moduls/news.php");
    include("moduls/news_fixed.php");
    $content2 = news_fixed() . news();
}

if ($topic) {
    include("moduls/news_topic.php");
    $content2 = news_topic($topic);
}

include("moduls/menu.php");
$menu = menu();
include("templates/index.html");