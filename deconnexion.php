<?php
require_once 'config/init.conf.php';

setcookie('sid', '', time() - 1);

$_SESSION['notification']['result'] = 'danger';
$_SESSION['notification']['message'] = 'Vous êtes deconnecté !';

header("Location: index.php");
exit();
