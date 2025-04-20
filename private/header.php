<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/private/cache.php";

?>

<!-- Header -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $_TITLE ?> | PlasmaWalls</title>
    <link rel="icon" href="/logo.svg" type="image/svg">
    <link rel="icon" href="/logo.png" type="image/png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<!-- Navbar -->
<?php

$branches_raw = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/cache/branches.json"));

$branches_names = [];
foreach ($branches_raw as $branch) {
    if (substr($branch->name, 0, 7) == "Plasma/") {
        array_push($branches_names, $branch->name);
    }
}

sort($branches_names, SORT_NATURAL);
$branches_names = array_reverse($branches_names);

?>
<nav class="navbar bg-dark navbar-dark">
    <a class="navbar-brand" href="/">
        <img src="/logo.png" alt="Logo" style="width:40px;">
    </a>
    </a>
    <span class="navbar-text">v2.1</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar" style="min-height:calc(100vh - 66px);max-height:calc(100vh - 66px);overflow:auto;">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/wall/?v=last">Latest Dev Branch</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/wall/?v=<?= substr($branches_names[0], 7) ?>">Plasma <?= substr($branches_names[0], 7) ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/wall/?v=<?= substr($branches_names[1], 7) ?>">Plasma <?= substr($branches_names[1], 7) ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/wall/?v=<?= substr($branches_names[2], 7) ?>">Plasma <?= substr($branches_names[2], 7) ?></a>
            </li>
            <?php

            $bnp = $branches_names;
            array_shift($bnp);
            array_shift($bnp);
            array_shift($bnp);

            foreach ($bnp as $branch) {
                echo("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/wall/?v=" . substr($branch, 7) . "\">Plasma " . substr($branch, 7) . "</a></li>");
            }

            ?>
        </ul>
    </div>
</nav>
