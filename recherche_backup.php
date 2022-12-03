<!DOCTYPE html>
<html lang="en">
<?php require "config/init.conf.php"; ?>
<?php require "config/check-connexion.conf.php"; ?>

<?php include "includes/header.php"; ?>

<body>
    <!-- Responsible navbar-->
    <?php include "includes/menu.php"; ?>
    <!-- Page content-->
    <div class="container">
        <div class="text-center mt-5 mb-5">
            <h1>Moteur de recherche</h1>
        </div>

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

        <form id="" method="GET" action="recherche.php">
            <div class="row mb-5">
                <div class="col">
                    <input type="text" class="form-control" name="search" value="" placeholder="Mot clé...">
                </div>
                <div class="col">
                    <button type="submit" id="submit" value="recherche" class="btn btn-primary">Rechercher</button>
                </div>
        </form>
    </div>

    <div class="row">
        <?php
        foreach ($listeArticles as $articles) {
        ?>
            <div class="col-6 mb-4">
                <div class="card">
                    <img src="img/<?= $articles->getId(); ?>.jpg" style="max-width: 200px;" class="card-img-top" alt="<?= $articles->getTitre() ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $articles->getTitre() ?></h5>
                        <p class="card-text"><?= $articles->getTexte() ?></p>
                        <a href="#" class="btn btn-primary"><?= $articles->getDate() ?></a>
                        <a href="articles.php?id=<?php echo $articles->getId(); ?>" class="btn btn-primary">Modifier</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    </div>
    <?php include "includes/footer.php"; ?>
</body>

</html>