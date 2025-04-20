<?php

if (!file_exists("../cache/date.txt") || file_get_contents("../cache/date.txt") != date("Ym")) {
    global $_KEY;
    $_KEY = trim(file_get_contents("../KEY.txt"));

    $branches_text = file_get_contents("https://invent.kde.org/api/v4/projects/2045/repository/branches/?private_token={$_KEY}");
    file_put_contents("../cache/branches.json", $branches_text);
    $branches_raw = json_decode($branches_text);

    $branches_names = [];
    foreach ($branches_raw as $sbranch) {
        if (substr($sbranch->name, 0, 7) == "Plasma/") {
            array_push($branches_names, $sbranch->name);
        }
    }

    sort($branches_names, SORT_NATURAL);
    $branches_names = array_reverse($branches_names);

    foreach ($branches_names as $branch) {
        $branch_raw = file_get_contents("https://invent.kde.org/api/v4/projects/2045/repository/tree/?private_token={$_KEY}&ref={$branch}&path=wallpapers/Next/contents/images");
        file_put_contents("../cache/branch-" . str_replace("/", "_-_", $branch) . ".json", $branch_raw);
    }

    $branch_raw = file_get_contents("https://invent.kde.org/api/v4/projects/2045/repository/tree/?private_token={$_KEY}&ref=master&path=wallpapers/Next/contents/images");
    file_put_contents("../cache/branch-master.json", $branch_raw);

    file_put_contents("../cache/date.txt", date("Ym"));
}