<?php

echo "Hello World";

$teams = ["Vitality", "Luminosity", "Mouz"];
foreach ($teams as $index => $team) {
    echo "Index $index: $team";
}

function won() {
    $woni = ["Major", "Open", "Katowice"];
}

var_dump(won());

function square($number1, $number2) {
    return ($num * $num);
}

function calculerMoyenne($nombre1, $nombre2, $nombre3) { //Fonction USER avec 3 parametres (Nombre qui equivalent une note.)
    return ($nombre1 + $nombre2 + $nombre3) / 3; // on return la fonction (<3 de la fonction) addition des 3 nombres divisé par 3 pour return la moyenne
}

function afficherResultat($nom, $moyenne) {
    if ($moyenne >= 10) {
        echo "$nom tu as une moyenne de: $moyenne | Suffisant!";
    } else {
        echo "$nom tu as une moyenne de: $moyenne | Insuffisant! Ressaisie toi! Idiot!";
    }
}

// CONSUME API

require 'vendor/autoload.php'; //dependance

$client = new GuzzleHttp\Client([ // désactive la verification SSL /!\ ATTENTION NE JAMAIS UTILISER CA /!\ (a part pour tester)
    'verify' => false
]);

$client = new GuzzleHttp\Client([
    'headers' => [
        'Authorization' => 'Bearer KtFGls3XWxo_air2CXKc'
    ]
]);


$respone = $client->request('GET', 'https://fakestoreapi.com/products'); // pas de clé car free 2 use

$statusCode = $respone->getStatusCode();

$body = $respone->getBody();

$data = json_decode($body, true); // convert en json


echo '<pre>'; // format plus lisible
var_dump($data);
echo '</pre>';
?>