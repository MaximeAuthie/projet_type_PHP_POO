<?php

    //On spécifie l'espace de nom auquel appartient la classe
    namespace App\manager;

    //Importer les espaces de nom nécessaires à l'exécution des méthodes appelées et aux instances crées
    use App\model\Joueur;
    use App\utils\BddConnect;

    class ManagerJoueur extends Joueur {

        public function getPlayerByMail() {

            try {

                //On se connecte à la BDD via la méthode statique de la classe BddConnect
                $bdd = BddConnect::connexion();

                //On récupère l'adresse mail de du joueur
                $mail = $this->getMail();

                //Préparation de a requête
                $req = $bdd->prepare('SELECT id_joueur, pseudo_joueur, mail_joueur, password_joueur FROM joueurs WHERE mail_joueur = ?');

                //Affection des variables
                $req->bindParam(1, $mail, \PDO::PARAM_STR);

                //Execution de la requête
                $req->execute();

                //Récupération des résultats de la requête dans une variable
                $data = $req->fetchAll(\PDO::FETCH_ASSOC);

                //On retourne au contrôleur la variable contenant les résultat de la requête 
                return $data;

            } catch (\Exception $error) {

                //En cas d'erreur, on retourne au contrôleur le message d'erreur capté 
                die ('Error : '.$error->getMessage());

            }
        }

        public function insertPlayer() {

            try {

                //On se connecte à la BDD via la méthode statique de la classe BddConnect
                $bdd = BddConnect::connexion();

                //On récupère les informations saisies dans le formulaire et stockées dans l'instance $user
                $pseudo = $this->getPseudo();
                $mail = $this->getMail();
                $password = $this->getPassword();

                //Préparation de la requête
                $req = $bdd->prepare('INSERT INTO joueurs(pseudo_joueur, mail_joueur, password_joueur) VALUES (?,?,?)');

                //Affectation des variables
                $req->bindParam(1, $pseudo, \PDO::PARAM_STR);
                $req->bindParam(2, $mail, \PDO::PARAM_STR);
                $req->bindParam(3, $password, \PDO::PARAM_STR);

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