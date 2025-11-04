<?php
function getWikipediaArticle($article) {
    $article = str_replace(' ', '_', $article);
    $url = "https://es.wikipedia.org/api/rest_v1/page/summary/$article";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code !== 200) throw new Exception("Error al acceder a Wikipedia: HTTP $http_code");

    $data = json_decode($response, true);
    
    if (!$data) throw new Exception("Error al decodificar JSON");

    // Verificar si es una página de desambiguación
    if (isset($data['type']) && $data['type'] === 'disambiguation') {
        throw new Exception("disambiguation");
    }

    return $data;
}
?>