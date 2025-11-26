<?php
if (!isset($pageData)) {
    exit;
} else {
	$recomendations = $pageData->items;
}

if (is_array($recomendations)) {
    echo "<div>";
    foreach ($recomendations as $recomendation) {
        echo "<div>";
        echo "<h3>" . $recomendation->getTitle() . "</h3>";
        echo "<p>" . $recomendation->getDescription() . "</p>";
        echo "<small>Creado el: " . $recomendation->getCreatedAt() . "</small>";
        echo "</div>";
    }
    echo "</div>";
}

?>