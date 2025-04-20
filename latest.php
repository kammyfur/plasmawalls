<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/errors.php";
global $_KEY;
$_KEY = trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/KEY.txt"));

$inf = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/cache/branch-master.json"));

$names = [];

foreach ($inf as $file) {
    if (substr($file->name, 0, 10) != "base_size." && substr($file->name, 0, 19) != "vertical_base_size.") {
        array_push($names, $file->name);
    }
}

$ext = explode(".", $names[0])[count(explode(".", $names[0]))-1];
$file = file_get_contents("https://invent.kde.org/plasma/breeze/-/raw/master/wallpapers/Next/contents/images/1920x1080." . $ext);
header("Content-Type: image/" . $ext);
die($file);
