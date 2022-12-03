<?php

$isConnectSid = false;

// isset vérifie l'existence du cookie 'sid'
if (isset($_COOKIE['sid'])) {

    // Déclare un utilisateur et vérifie que son sid correspond à celui du cookie
    $utilisateursManager = new utilisateursManager($bdd);
    $utilisateursEnBdd = $utilisateursManager->getBySid($_COOKIE['sid']);

    $isConnectSid = true;

    var_dump($isConnectSid);
    var_dump($utilisateursEnBdd);
}
