<?php

require __DIR__ . '/../vendor/autoload.php';

$client = new GuzzleHttp\Client([
    'headers' => [
        'Authorization' => 'Bearer KtFGls3XWxo_air2CXKc'
    ],
    'verify' => false
]);

try {
    $response = $client->get('https://the-one-api.dev/v2/character');
    $data = json_decode($response->getBody(), true);
    
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    
} catch (Exception $e) {
    echo 'Erreur API: ' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rest | API</title>
</head>
<body>
    <header>
    </header>

    <main>
    </main>

    <footer>
    </footer>
    
</body>
</html>
