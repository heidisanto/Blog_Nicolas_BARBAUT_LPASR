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
        <div class="text-center mt-5">
            <h1>El Bootstrap</h1>
            <p class="lead">A complete project boilerplate built with Bootstrap</p>
            <p>Bootstrap v5.1.3</p>
        </div>

        <?php
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;

        $articlesManager = new articlesManager($bdd);
        $nbArticlesTotalAPublie = $articlesManager->countArticles();

        $nbPages = ceil($nbArticlesTotalAPublie / nb_articles_par_page);

        $indexDepart = ($page - 1) * nb_articles_par_page;

        $listeArticles = $articlesManager->getListArticlesAAfficher($indexDepart, nb_articles_par_page);

        //print_r2($listeArticles);
        //var_dump($bdd);
        ?>

        <?php
        if (isset($_SESSION['notification'])) {
        ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-<?= $_SESSION['notification']['result']; ?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['notification']['message'] ?>
                        <?php unset($_SESSION['notification']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
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

        <div class="col-6 mb-4">
            <nav aria-label="Page de navigation mt-5">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $nbPages; $i++) : ?>
                        <li class="page-item <?php if ($page == $i) {
                                                    echo 'active';
                                                } ?>">
                            <a Class="page-link" href="?page=<?= $i; ?>"> <?= $i; ?> </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>

    </div>
    <?php include "includes/footer.php"; ?>
</body>

</html>