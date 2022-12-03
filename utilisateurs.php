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

    <?php
    if (!empty($_POST['submit'])) {
        //print_r2($_POST);
        $utilisateurs = new utilisateurs();
        $utilisateurs->hydrate($_POST);
        //print_r2($utilisateurs);

        $utilisateurs->setMdp(password_hash($utilisateurs->getMdp(), PASSWORD_DEFAULT));

        //Insérer l'utilisateur en base de données
        $utilisateursManager = new utilisateursManager($bdd);
        $utilisateursManager->add($utilisateurs);
        //print_r2($utilisateursManager);

        $messageNotification = $utilisateursManager->get_result() == true ? "Vorte compte utilisateur a été créé !" : "Une erreur est survenue lors de la création de votre compte...";
        $resultNotification = $utilisateursManager->get_result() == true ? "success" : "danger";

        $_SESSION['notification']['result'] = $resultNotification;
        $_SESSION['notification']['message'] = $messageNotification;

        //Renvoie l'utilisateur vers la page d'accueil lorsque l'article est créé
        header("Location: index.php");
        exit();
    }

    echo $twig->render(
        'utilisateurs.html.twig',
        []
    );

    ?>


    </div>
    <?php include "includes/footer.php"; ?>
</body>

</html>