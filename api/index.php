<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rest | API</title>
</head>
<body>
    <header>
      <div>
        <h1>Tableau API | Initiation Back-end</h1>
      </div>
    </header>

    <main>
      
    </main>

    <footer>
    </footer>
    
</body>
</html>

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
    
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';

    if (isset($data['docs']) && !empty($data['docs'])) {
      echo '<table>';
      echo '<thead><tr>';
      echo '<th>ID</th>';
      echo '<th>Nom</th>';
      echo '<th>Race</th>';
      echo '<th>Genre</th>';
      echo '<th>Royaume</th>';
      echo '</tr></thead>';
      echo '<tbody>';
      
      foreach ($data['docs'] as $character) {
          echo '<tr>';
          echo '<td>' . htmlspecialchars($character['_id'] ?? '') . '</td>';
          echo '<td>' . htmlspecialchars($character['name'] ?? '') . '</td>';
          echo '<td>' . htmlspecialchars($character['race'] ?? '') . '</td>';
          echo '<td>' . htmlspecialchars($character['gender'] ?? '') . '</td>';
          echo '</tr>';
      }
      
      echo '</tbody>';
      echo '</table>';
  } else {
      echo '<p>Aucune donnée disponible</p>';
  }
    
} catch (Exception $e) {
    echo 'Erreur API: ' . $e->getMessage();
}

try {
  $response = $client->get('https://the-one-api.dev/v2/movie');
  $data = json_decode($response->getBody(), true);
  
  echo '<pre>';
  print_r($data);
  echo '</pre>';
  
} catch (Exception $e) {
  echo 'Erreur API: ' . $e->getMessage();
}

?>