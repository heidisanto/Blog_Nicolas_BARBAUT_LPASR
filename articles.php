<!DOCTYPE html>
<html lang="en">
<?php require "config/init.conf.php"; ?>
<?php require "config/check-connexion.conf.php"; ?>

<?php include "includes/header.php"; ?>

<?php
$loader = new \Twig\Loader\FilesystemLoader('templates/');
$twig = new \Twig\Environment($loader, ['debug' => true]);
?>

<?php if (!empty($_GET['id'])) {
    $articlesId = new articles($bdd);
    $articlesManagerId = new articlesManager($bdd);
    $getArticlesId = $articlesManagerId->get($_GET['id']);
    //print_r2($getArticlesId);
} else {
}

if (!empty($_POST['Modifier'])) {
    $articles = new articles($bdd);
    $articles->hydrate($_POST);
    $articles->setId($_POST['getArticlesId']);
    $articles->setDate(date('Y-m-d'));
    $articlesManager = new articlesManager($bdd);
    $articlesManager->update($articles);
}
?>


<body>
    <!-- Responsible navbar-->
    <?php include "includes/menu.php"; ?>

    <?php
    if (!empty($_POST['submit'])) {
        //print_r2($_POST);
        $articles = new articles();
        $articles->hydrate($_POST);
        $articles->setDate(date('Y-m-d'));
        //print_r2($articles);
        //print_r2($_FILES);

        //Insérer l'article en base de données
        $articlesManager = new articlesManager($bdd);
        $articlesManager->add($articles);
        //print_r2($articlesManager);

        //Si l'article est inséré on traite l'image
        if ($articlesManager->get_result() == true) {
            if ($_FILES['image']['error'] == 0) {
                $nomImage = $articlesManager->get_getLastInsertId();
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . "/img/" . $nomImage . ".jpg");
            }
        }
        
        //Notifications de succès ou d'échec d'ajout d'article à la BDD
        $messageNotification = $articlesManager->get_result() == true ? "Vorte article a été ajouté / modifié !" : "Une erreur est survenue lors de l'ajout / la modification de votre article...";
        $resultNotification = $articlesManager->get_result() == true ? "success" : "danger";

        $_SESSION['notification']['result'] = $resultNotification;
        $_SESSION['notification']['message'] = $messageNotification;

        //Renvoie l'utilisateur vers la page d'accueil lorsque l'article est créé
        header("Location: index.php");
        exit();
    } ?>

    <?php echo $twig->render(
        'articles.html.twig',
        [
            'articlesId' => $articlesId,
            'articlesManagerId' => $articlesManagerId,
            'getArticlesId' => $getArticlesId,
        ]
    );

    ?>

    <?php include "includes/footer.php"; ?>
</body>

</html>