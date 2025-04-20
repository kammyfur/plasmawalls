<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/errors.php";

global $_KEY;
$_KEY = trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/KEY.txt"));

if (isset($_GET['v'])) {
    if (strpos($_GET['v'], "/") !== false || strpos($_GET['v'], "?") !== false || strpos($_GET['v'], "%") !== false || strpos($_GET['v'], "&") !== false) {
        header("Location: /");
        die();
    }
    if ($_GET['v'] == "last") {
        $branch = "master";
    } else {
        $branch = "Plasma/" . $_GET['v'];
    }
} else {
    header("Location: /");
    die();
}

if (isset($_GET['res'])) {
    if (strpos($_GET['res'], "/") !== false || strpos($_GET['res'], "?") !== false || strpos($_GET['res'], "%") !== false || strpos($_GET['res'], "&") || strpos($_GET['res'], ".") !== false) {
        header("Location: /");
        die();
    } else {
        $res = $_GET['res'];
    }
} else {
    header("Location: /");
    die();
}

$branches_raw = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/cache/branches.json"));

$branches_names = [];
foreach ($branches_raw as $sbranch) {
    if (substr($sbranch->name, 0, 7) == "Plasma/") {
        array_push($branches_names, $sbranch->name);
    }
}

sort($branches_names, SORT_NATURAL);
$branches_names = array_reverse($branches_names);

if ($branch != "master" && !in_array($branch, $branches_names)) {
    header("Location: /");
    die();
}

$inf = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/cache/branch-" . str_replace("/", "_-_", $branch) . ".json"));

$names = [];

foreach ($inf as $file) {
    if (substr($file->name, 0, 10) != "base_size." && substr($file->name, 0, 19) != "vertical_base_size.") {
        array_push($names, $file->name);
    }
}

$ext = explode(".", $names[0])[count(explode(".", $names[0]))-1];

if (!in_array($res . "." . $ext, $names)) {
    header("Location: /");
    die();
}

$file = file_get_contents("https://invent.kde.org/plasma/breeze/-/raw/{$branch}/wallpapers/Next/contents/images/{$res}." . $ext);
header("Content-Type: image/" . $ext);
header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename=plasmawalls-' . $_GET['v'] . "-" . $res . "." . $ext);
header('Content-Transfer-Encoding: binary');
header('Connection: Keep-Alive');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . strlen($file));
die($file);
