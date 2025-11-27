<?php

if (isset($pageData)){
    $actualPage = $pageData->actualPage;
    $hasNext = $pageData->hasNext;
    $hasPrev = $pageData->hasPrev;
    $totalPages = $pageData->totalPages;
    $totalItems = $pageData->totalItems;

    if ($totalItems <= 0) $buttonList = createButtonList(1, $hasNext, false, $totalPages, $totalItems);
    else $buttonList = createButtonList($actualPage, $hasNext, $hasPrev, $totalPages, $totalItems);

    $html =
    "
    <div class='section_pagination_buttons'>";
    if ($totalItems <= 0) $html = $html . "<h3>No se han encontrado resultados</h3>";
    $html = $html . "<div class='buttons'>"
        . implode("\n", $buttonList) .
        "</div>
        <p>Total items: <strong id='items_page' class'btn_filter'>$totalItems</strong></p>
    </div>
    ";

    echo $html;
}

function createButton($content, $value, $id, array $class){
    $btn = "<button ";
    if (!empty($id)) $btn = $btn . "id='$id' ";
    $btn = $btn . "class='btn_filter";
    if (!empty($class)) $btn = $btn . " " . implode(" ", $class);
    $btn = $btn . "' ";
    if (!empty($value)) $btn = $btn . "value='$value' ";
    $btn = $btn . ">$content</button>";
    return $btn;
}

function createButtonList($actualPage, $hasNext, $hasPrev, $totalPages, $totalItems){
    $buttonList[] = createButton("<", $actualPage - 1, "page", !$hasPrev ? ["no_clickable"] : []);

    if ($actualPage > 2) $buttonList[] = createButton(1, 1, "page", []);
    if ($actualPage >= 4) $buttonList[] = createButton("...", "", "", ["points", "no_clickable"]);

    if ($hasPrev) $buttonList[] = createButton($actualPage -1, $actualPage - 1, "page", []);
    $buttonList[] = createButton($actualPage, $actualPage, "page", ["actual_page no_clickable"]);
    if ($hasNext) $buttonList[] = createButton($actualPage + 1, $actualPage + 1, "page", []);

    if ($totalPages > $actualPage + 2) $buttonList[] = createButton("...", "", "", ["no_clickable"]);
    if ($totalPages > $actualPage + 1) $buttonList[] = createButton($totalPages, $totalPages, "page", []);

    $buttonList[] = createButton(">", $actualPage + 1, "page", !$hasNext ? ["no_clickable"] : []);

    return $buttonList;
}

?>