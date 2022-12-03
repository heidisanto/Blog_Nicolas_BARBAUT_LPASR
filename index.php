<!DOCTYPE html>
<html lang="en">
<?php require "config/init.conf.php"; ?>
<?php require "config/check-connexion.conf.php";

$loader = new \Twig\Loader\FilesystemLoader('templates/');
$twig = new \Twig\Environment($loader, ['debug' => true]);
?>

<?php include "includes/header.php"; ?>

<body>
    <!-- Responsible navbar-->
    <?php include "includes/menu.php"; ?>
    <!-- Page content-->

    <?php
    //Script de pagination
    $page = !empty($_GET['page']) ? $_GET['page'] : 1;

    $articlesManager = new articlesManager($bdd);
    $nbArticlesTotalAPublie = $articlesManager->countArticles();

    $nbPages = ceil($nbArticlesTotalAPublie / nb_articles_par_page);

    $indexDepart = ($page - 1) * nb_articles_par_page;

    $listeArticles = $articlesManager->getListArticlesAAfficher($indexDepart, nb_articles_par_page);


    //Script d'ajout de commentaire en BDD
    if (!empty($_POST['submit'])) {
        //print_r2($_POST);
        $commentaires = new commentaires();
        $commentaires->hydrate($_POST);
        //print_r2($articles);
        //print_r2($_FILES);

        //Insérer le commentaire
        $commentairesManager = new commentairesManager($bdd);
        $commentairesManager->add($commentaires);
        //print_r2($articlesManager);

        $messageNotification = $commentairesManager->get_result() == true ? "Votre commentaire a été ajouté !" : "Une erreur est survenue lors de l'ajout de votre commentaire...";
        $resultNotification = $commentairesManager->get_result() == true ? "success" : "danger";

        $_SESSION['notification']['result'] = $resultNotification;
        $_SESSION['notification']['message'] = $messageNotification;

        //Renvoie l'utilisateur vers la page d'accueil lorsque le commentaire est créé
        header("Location: index.php");
        exit();
    }

    echo $twig->render(
        'index.html.twig',
        [
            'session' => $_SESSION,
            'listeArticles' => $listeArticles,
            'nbPages' => $nbPages,
            'page' => $page
        ]
    );

    unset($_SESSION['notification']);
    ?>

    </div>
    <?php include "includes/footer.php"; ?>
</body>

</html>