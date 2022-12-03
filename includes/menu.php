<?php
function active($current_page)
{
    $url_array =  explode('/', $_SERVER['REQUEST_URI']);
    $url = end($url_array);
    if ($current_page == $url) {
        echo 'active'; //class name in css 
    }
}
?>

<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Le blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link <?php active('index.php'); ?>" aria-current="page" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link <?php active('articles.php'); ?>" href="articles.php">Ajouter un article</a></li>
                <li class="nav-item"><a class="nav-link <?php active('utilisateurs.php'); ?>" href="utilisateurs.php">Créer un compte</a></li>
                <li class="nav-item"><a class="nav-link <?php active('recherche.php'); ?>" href="recherche.php">Rechercher</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle id=" navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Mon compte</a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="connexion.php">Connexion</a></li>
                        <li><a class="dropdown-item" href="deconnexion.php">Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>