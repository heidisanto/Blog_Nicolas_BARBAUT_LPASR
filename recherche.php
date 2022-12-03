<!DOCTYPE html>
<html lang="en">
<?php require "config/init.conf.php"; ?>
<?php require "config/check-connexion.conf.php"; ?>

<?php include "includes/header.php";

$loader = new \Twig\Loader\FilesystemLoader('templates/');
$twig = new \Twig\Environment($loader, ['debug' => true]);

?>

<body>
    <!-- Responsible navbar-->
    <?php include "includes/menu.php"; ?>
    <!-- Page content-->

    <?php

    if (!empty($_GET['search'])) {

        $articlesManager = new articlesManager($bdd);
        $listeArticles = $articlesManager->getListArticlesFromRecherche($_GET['search']);

        //print_r2($listeArticles);
        //var_dump($bdd);
    } else {

        $listeArticles = [];
    }
    ?>

    <?php echo $twig->render(
        'recherche.html.twig',
        [
            'listeArticles' => $listeArticles,
        ]
    );
    ?>

    </div>
    <?php include "includes/footer.php"; ?>
</body>

</html>