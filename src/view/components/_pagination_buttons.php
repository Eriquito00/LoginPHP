<?php

if (isset($pageData)){
    $actualPage = $pageData->actualPage;
    $hasNext = $pageData->hasNext;
    $hasPrev = $pageData->hasPrev;
    $totalPages = $pageData->totalPages;
    $totalItems = $pageData->totalItems;
}

?>

<div class='section_pagination_buttons'>
    <div class='buttons'>
        <button id="page" value="<?= $actualPage - 1 ?>" class="btn_filter <?= !$hasPrev ?  "no_clickable" : ""?>"><</button>

        <?php if ($actualPage > 2): ?>
            <button id="page" value="<?= 1 ?>" class="btn_filter">1</button>
        <?php endif; ?>
        <?php if ($actualPage >= 4): ?>
            <button class="btn_filter no_clickable">...</button>
        <?php endif; ?>

        <?php if ($hasPrev): ?>
            <button id="page" value="<?= $actualPage - 1 ?>" class="btn_filter"><?= $actualPage - 1 ?></button>
        <?php endif; ?>
        <button id="page" value="<?= $actualPage ?>" class="btn_filter actual_page no_clickable"><?= $actualPage ?></button>
        <?php if ($hasNext): ?>
            <button id="page" value="<?= $actualPage + 1 ?>" class="btn_filter"><?= $actualPage + 1 ?></button>
        <?php endif; ?>

        <?php if ($totalPages > $actualPage + 2): ?>
            <button class="btn_filter no_clickable">...</button>
        <?php endif; ?>
        <?php if ($totalPages > $actualPage + 1): ?>
            <button id="page" value="<?= $totalPages ?>" class="btn_filter"><?= $totalPages ?></button>
        <?php endif; ?>

        <button id="page" value="<?= $actualPage + 1 ?>" class="btn_filter <?= !$hasNext ?  "no_clickable" : ""?>">></button>
    </div>
    <p>Total items: <strong id='items_page' class='btn_filter'><?= $totalItems ?></strong></p>
</div>