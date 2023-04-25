<?php

    //On spécifie l'espace de nom auquel appartient la classe
    namespace App\manager;

    //Importer les espaces de nom nécessaires à l'exécution des méthodes appelées et aux instances crées
    use App\model\Personnages;
    use App\utils\BddConnect;

    class ManagerPersonnages extends Personnages {

        public function getAllCharacters() {

            try {

                //On se connecte à la BDD via la méthode statique de la classe BddConnect
                $bdd = BddConnect::connexion();

                //On récupère l'ID du joueur
                $id =  $_SESSION['id'];

                //Préparation de la requête
                $req = $bdd->prepare('SELECT id_personnage, nom_personnage, id_joueur, personnages.id_classe, nom_classe FROM personnages INNER JOIN classes ON personnages.id_classe = classes.id_classe WHERE id_joueur = ?');
                
                //Affectation des variables
                $req->bindParam(1, $id, \PDO::PARAM_STR);

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

        public function getCharacterByName() {

            try {

                //On se connecte à la BDD via la méthode statitque de la classe BddConnect
                $bdd = BddConnect::connexion();

                //On récupère l'ID du joueur et le nom du personnage 
                $playerId = $this->getIdJoueur();
                $characterName = $this->getNom();
                
                //Préparation de la requête
                $req = $bdd->prepare('SELECT id_personnage, nom_personnage, id_joueur, personnages.id_classe FROM personnages WHERE id_joueur = ? AND nom_personnage = ?');
                    
                //Affectation des variables
                $req->bindParam(1, $playerId, \PDO::PARAM_INT);
                $req->bindParam(2, $characterName, \PDO::PARAM_STR);
                
                //Execution de la requête
                $req->execute();
                
                //Récupération des résultat de la requête dans une variable.
                $data = $req->fetchAll(\PDO::FETCH_ASSOC);
                
                //On retourne au contrôleur la variable contenant les résultat de la requête 
                return $data;

            } catch (\Exception $error) {

                //En cas d'erreur, on retourne au contrôleur le message d'erreur capté 
                die ('Error :'.$error->getMessage());

            }
        }

        public function addCharacter() {

            try {

                //On se connecte à la BDD via la méthode statique de la classe BddConnect
                $bdd = BddConnect::connexion();

                //On récupère les variables de la requête
                $playerId =  $this->getIdJoueur();
                $characterName = $this->getNom();
                $class = $this->getClasse();
                $classId = $class->getId();

                //Préparation de la requête
                $req = $bdd->prepare('INSERT INTO personnages(nom_personnage, id_joueur, id_classe) VALUES (?,?,?)');

                //Affectation des variables
                $req->bindParam(1, $characterName, \PDO::PARAM_STR);
                $req->bindParam(2, $playerId, \PDO::PARAM_STR);
                $req->bindParam(3, $classId, \PDO::PARAM_STR);

                //Execution de la requête
                $req->execute();

                //Récupération des résultat de la requête dans une variable.
                $data = $req->fetchAll(\PDO::FETCH_ASSOC);

                //On retourne au contrôleur la variable contenant les résultat de la requête 
                return $data;

            } catch (\Exception $error) {

                //En cas d'erreur, on retourne au contrôleur le message d'erreur capté 
                die('Error : '.$error->getMessage());

            }
        }
    }
?>