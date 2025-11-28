<?php

if (isset($pageData)){
    $actualPage = $pageData->actualPage;
    $hasNext = $pageData->hasNext;
    $hasPrev = $pageData->hasPrev;
    $totalPages = $pageData->totalPages;
    $totalItems = $pageData->totalItems;
}

?>

<?php if (isset($pageData)): ?>
<section class='section_pagination_buttons'>
    <?php if ($totalItems <= 0): ?>
        <h3>No se han encontrado resultados</h3>
    <?php endif; ?>
    <div class='buttons'>
        <button id="page" value="<?= $actualPage - 1 ?>" class="btn_filter <?= !$hasPrev || $totalItems <= 0 ?  "no_clickable" : ""?>"><</button>

        <?php if ($actualPage > 2): ?>
            <button id="page" value="<?= 1 ?>" class="btn_filter">1</button>
        <?php endif; ?>
        <?php if ($actualPage >= 4): ?>
            <button class="btn_filter no_clickable">...</button>
        <?php endif; ?>

        <?php if ($hasPrev && $totalItems > 0): ?>
            <button id="page" value="<?= $actualPage - 1 ?>" class="btn_filter"><?= $actualPage - 1 ?></button>
        <?php endif; ?>

        <?php if ($totalItems > 0): ?>
            <button id="page" value="<?= $actualPage ?>" class="btn_filter actual_page no_clickable"><?= $actualPage ?></button>
        <?php elseif ($totalItems <= 0): ?>
            <button id="page" value="<?= 1 ?>" class="btn_filter actual_page no_clickable">1</button>
        <?php endif; ?>

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
</section>
<?php endif; ?>