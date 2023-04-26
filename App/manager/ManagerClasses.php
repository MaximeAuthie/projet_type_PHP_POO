<?php

    //On spécifie l'espace de nom auquel appartient la classe
    namespace App\manager;

    //Importer les espaces de nom nécessaires à l'exécution des méthodes appelées et aux instances crées
    use App\model\Classes;
    use App\utils\BddConnect;

    class ManagerClasses extends Classes {

        public function getClassById() {

            try {

                //On se connecte à la BDD via la méthode statique de la classe BddConnect
                $bdd = BddConnect::connexion();

                //On récupère l'adresse mail du joueur
                $idClass =  $this->getId();

                //Prépa
                $req = $bdd->prepare('SELECT id_classe, nom_classe, points_de_vie_classe, attaque_classe, defense_classe FROM classes WHERE id_classe = ?');
            
                //Affectation des variables
                $req->bindParam(1, $idClass, \PDO::PARAM_STR);

                //Execution de la requête
                $req->execute();

                //Récupération des résultat de la requête dans une variable.
                $data = $req->fetchAll(\PDO::FETCH_ASSOC);

                //On retourne au contrôleur la variable contenant les résultat de la requête 
                return $data;

            } catch (\Exception $error) {

                //En cas d'erreur, on retourne au contrôleur le message d'erreur capté 
                die ('Error : '.$error->getMessage());

            } 
        }

        public function getAllClass() {

            try {

                //On se connecte à la BDD via la méthode statique de la classe BddConnect
                $bdd = BddConnect::connexion();

                //Prépa
                $req = $bdd->prepare('SELECT id_classe, nom_classe, points_de_vie_classe, attaque_classe, defense_classe FROM classes');

                //Execution de la requête
                $req->execute();

                //Récupération des résultat de la requête dans une variable.
                $data = $req->fetchAll(\PDO::FETCH_ASSOC);

                //On retourne au contrôleur la variable contenant les résultat de la requête 
                return $data;

            } catch (\Exception $error) {

                //En cas d'erreur, on retourne au contrôleur le message d'erreur capté 
                die ('Error : '.$error->getMessage());

            } 
        }
    }

?>