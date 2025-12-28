<?php

if (isset($pageData)) {
    $recomendations = $pageData->items;
}

?>

<?php if (isset($pageData)): ?>
<link rel="stylesheet" href="./styles/_feed.css">
<section class="section_feed">
    <?php foreach($recomendations as $reco): ?>
        <article class="user_reco">
            <div class="user">
                <img class="user_img" src="https://ih1.redbubble.net/image.5195043568.7951/st,small,507x507-pad,600x600,f8f8f8.jpg" alt="">
                <h3 class="user_name"><?= $reco->getUsername(); ?></h3>
            </div>
            <div class="reco">
                <div class="reco_post">
                    <h3 class="reco_title"><?= $reco->getTitle(); ?></h3>
                    <?php if(!empty($reco->getImageUrl())): ?>
                        <img class="reco_img" src="<?= $reco->getImageUrl(); ?>" alt="<?= $reco->getTitle(); ?>">
                    <?php endif; ?>
                    <p class="reco_desc"><?= $reco->getDescription(); ?></p>
                    <small class="reco_date"><?= $reco->getCreatedAt(); ?></small>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
</section>
<?php endif; ?>