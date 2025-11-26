<?php

if (isset($pageData)){
    $actualPage = $pageData->actualPage;
    $hasNext = $pageData->hasNext;
    $hasPrev = $pageData->hasPrev;
    $totalPages = $pageData->totalPages;
    $totalItems = $pageData->totalItems;

    echo date("H:i:s");

    echo "<div>";

    createButton("<", $actualPage - 1, "page", []);

    createButton($actualPage, $actualPage, "page", []);

    if ($hasNext) { createButton($actualPage + 1, $actualPage + 1, "page", []); }

    if ($totalPages > $actualPage + 3) {
        createButton("...", "", "", []);
        createButton($totalPages, $totalPages, "page", []);
    }
    else if ($totalPages > $actualPage + 2){
        createButton($totalPages, $totalPages, "page", []);
    }

    createButton(">", $actualPage + 1, "page", []);

    echo "<br>";

    echo "<p>Total items: <strong id='items_page' class'btn_filter'>$totalItems</strong></p>";

    echo "</div>";
}

function createButton($content, $value, $id, array $class){
    $btn = "<button ";
    if (!empty($id)) $btn = $btn . "id='$id' ";
    $btn = $btn . "class='btn_filter";
    if (!empty($class)) $btn = $btn . " " . implode(" ", $class);
    $btn = $btn . "' ";
    if (!empty($value)) $btn = $btn . "value='$value' ";
    $btn = $btn . ">$content</button>";
    echo $btn;
}

?>