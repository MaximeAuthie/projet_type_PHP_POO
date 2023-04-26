<?php
//Démarrage de la variable super globale $_SESSION
session_start();

//Importer les espaces de nom
use App\controller\ControllerPlayer;
use App\controller\ControllerCharacter;
use App\controller\ControllerLogout;
use App\controller\Controller404;
use App\controller\ControllerHome;

//Importer les ressources pour tout le projet
include './App/utils/connectBdd.php';
include './App/utils/toolbox.php';
include './App/model/joueur.php';
include './App/model/personnages.php';
include './App/model/classes.php';
include './App/controller/controllerPlayer.php';
include './App/controller/controllerCharacter.php';
include './App/controller/controllerLogout.php';
include './App/controller/controller404.php';
include './App/controller/controllerHome.php';

//Analyse de l'URL avec parse_url
$url = parse_url($_SERVER['REQUEST_URI']);

//Condition ternaire : soit l'URL  a une route, soit on renvoie à la racine
$path = isset($url['path']) ? $url['path'] : '/';

//On instancie un objet pour chaque contrôleur
$playerController = new ControllerPlayer();
$characterController = new ControllerCharacter();
$logoutController = new ControllerLogout();
$Controller404 = new Controller404();
$ControllerHome = new ControllerHome;

//Routeur si utilisateur connecté
if(isset($_SESSION['connected'])) {
    switch($path) {
        case '/adrar-exo-php/exo-revision/home':
            $ControllerHome->showHome();
            break;
        case '/adrar-exo-php/exo-revision/account':
            $playerController->showAccount();
            break;
        case '/adrar-exo-php/exo-revision/characters':
            $playerController->showAllCharacters();
            break;
        case '/adrar-exo-php/exo-revision/addCharacter':
            $characterController->newCharacter();
            break;
        case mb_strpos($path,'/adrar-exo-php/exo-revision/updateCharacter') !== false:
            $id = substr($path,44);
            $characterController->updateCharacter($id);
            break;
        case '/adrar-exo-php/exo-revision/logout':
            $logoutController->logout();
            break;

        default:
            $Controller404->badRoute();
    }

//Routeur pas d'utilisateur connecté
} else {
    switch($path) {
        case '/adrar-exo-php/exo-revision/home':
            $ControllerHome->showHome();
            break;
        case '/adrar-exo-php/exo-revision/signOn':
            $playerController->signOn();
            break;
        case '/adrar-exo-php/exo-revision/signIn':
            $playerController->signIn();
            break;
        default:
            $Controller404->badRoute();
    }
}

?>