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
        //echo 'le formulaire est posté';
        //print_r2($_POST);
        //print_r2($_FILES);
        //Création de l'utilisateur
        $utilisateursFormulaire = new utilisateurs();
        $utilisateursFormulaire->hydrate($_POST);
        //print_r2($utilisateursFormulaire);

        $utilisateursManager = new utilisateursManager($bdd);
        $utilisateursEnBdd = $utilisateursManager->getByEmail($utilisateursFormulaire->getEmail());

        //print_r2($utilisateursEnBdd);

        $isConnect = password_verify($utilisateursFormulaire->getMdp(), $utilisateursEnBdd->getMdp());

        //dump($isConnect);


        if ($isConnect == true) {
            $sid = md5($utilisateursEnBdd->getEmail() . time());
            //echo $sid;
            //Création du cookie
            setcookie('sid', $sid, time() + 86400);
            //Mise en bdd du sid
            $utilisateursEnBdd->setSid($sid);
            //dump($utilisateursEnBdd);
            $utilisateursManager->updateByEmail($utilisateursEnBdd);
            //dump($utilisateurManager->get_result());
        }

        if ($isConnect == true) {
            $_SESSION['notification']['result'] = 'success';
            $_SESSION['notification']['message'] = 'Vous êtes connecté !';
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['notification']['result'] = 'danger';
            $_SESSION['notification']['message'] = 'Vérifiez votre login / mot de passe !';
            header("Location: connexion.php");
            exit();
        }


        exit();

        //$utilisateurs->setMdp(password_hash($utilisateurs->getMdp(), PASSWORD_DEFAULT));

        //Insérer l'utilisateur en base de données
        //$utilisateursManager = new utilisateursManager($bdd);
        //$utilisateursManager->add($utilisateurs);
        //print_r2($utilisateursManager);

        //$messageNotification = $utilisateursManager->get_result() == true ? "Connexion effectuée" : "L'email ou le mot de passe est incorrect...";
        //$resultNotification = $utilisateursManager->get_result() == true ? "success" : "danger";

        //$_SESSION['notification']['result'] = $resultNotification;
        //$_SESSION['notification']['message'] = $messageNotification;

        //Renvoie l'utilisateur vers la page d'accueil lorsque l'article est créé
        //header("Location: index.php");
        //exit();
    }



    echo $twig->render(
        'connexion.html.twig',
        []
    );

    ?>

    <?php include "includes/footer.php"; ?>
</body>

</html>