
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
    
    //echo '<pre>';
    //print_r($data);
    //echo '</pre>';
    
} catch (Exception $e) {
    echo 'Erreur API: ' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Fetch | API</title>
</head>
<body>
    <header>
        <h1>Interface API | Initiation Back-End</h1>
    </header>

    <main>
    <?php 
        if (isset($data['docs']) && count($data['docs']) > 0): ?>
            <table>
                <thead>
                    <tr> <!-- Categories du tableau (entête) -->
                        <th>Name</th> 
                        <th>Race</th>
                        <th>Gender</th>
                        <th>Birth</th>
                        <th>Death</th>
                        <th>Realm</th>
                        <th>Spouse</th>
                        <th>Wiki_URL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['docs'] as $character): ?> <!-- pour tout - mes datas existant dans la doc - qui sont quoi? des character. -->
                        <tr>
                            <td><?= htmlspecialchars($character['name'] ?? 'N/A') ?></td> <!-- tu me display les données de cat name DANS le th Name -->
                            <td><?= htmlspecialchars($character['race'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($character['gender'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($character['birth'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($character['death'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($character['realm'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($character['spouse'] ?? 'N/A') ?></td>
                            <td>
                                <?php if (isset($character['wikiUrl'])): ?>
                                    <a href="<?= htmlspecialchars($character['wikiUrl']) ?>" target="_blank">Link</a>
                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No character data found.</p>
        <?php endif; ?>
    </main>

    <footer>
        <h3>Vous avez atteint les abysses..</h3>
    </footer>
    
</body>
</html>
