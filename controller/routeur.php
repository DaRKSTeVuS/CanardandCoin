<?php
require_once File::build_path(array('controller', 'ControllerCommandes.php'));
require_once File::build_path(array('controller', 'ControllerUtilisateurs.php'));
require_once File::build_path(array('controller', 'ControllerProduits.php'));
require_once File::build_path(array('controller', 'ControllerCategories.php'));
require_once File::build_path(array('controller', 'ControllerImages.php'));

//test controller vide
if (isset($_GET['controller'])) { //si le controller n'est pas vide
    //on construit le controller
    $controller = $_GET['controller'];
} else { //si le controller est vide
    //on affiche une page par défaut
    $controller = 'produits';
}

//On créer le nom du controller
$controller_class = 'Controller' . ucFirst($controller);

if (class_exists($controller_class)) { //si le controller existe
    //on récupère les méthodes du controller
    $controllerMethods = get_class_methods($controller_class);
} else { //si le controller n'existe pas
    $controller_class = 'ControllerProduits';
    ControllerProduits::error('E_CONTROLLER_NOTFOUND');
    die();
}

if (in_array($_GET['action'], $controllerMethods)) { //si la fonction appelée existe
    //on récupère l'action
    $action = $_GET['action'];

    //on execute l'action
    $controller_class::$action();

} else { //si la fonction appelée n'existe pas
    //on renvoit la view erreurF
    $controller_class = 'ControllerProduits';
    ControllerProduits::error('E_CONTROLLER_NOTFOUND');
    die();
}
