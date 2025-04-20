<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/errors.php";

if (isset($_GET['v'])) {
    if (strpos($_GET['v'], "/") !== false || strpos($_GET['v'], "?") !== false || strpos($_GET['v'], "%") !== false || strpos($_GET['v'], "&") !== false) {
        die("error");
    }
    if ($_GET['v'] == "last") {
        $branch = "master";
    } else {
        $branch = "Plasma/" . $_GET['v'];
    }
} else {
    die("error");
}

global $_KEY;
$_KEY = trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/KEY.txt"));

$inf = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/cache/branch-" . str_replace("/", "_-_", $branch) . ".json"));

$names = [];

foreach ($inf as $file) {
    if (substr($file->name, 0, 10) != "base_size." && substr($file->name, 0, 19) != "vertical_base_size.") {
        array_push($names, $file->name);
    }
}

$ext = explode(".", $names[0])[count(explode(".", $names[0]))-1];
$file = file_get_contents("https://invent.kde.org/plasma/breeze/-/raw/{$branch}/wallpapers/Next/contents/images/1280x800." . $ext);
header("Content-Type: image/" . $ext);
die($file);
