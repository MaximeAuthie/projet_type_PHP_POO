<?php

    //On spécifie l'espace de nom auquel appartient la classe
    namespace App\controller;

    //Importer les espaces de nom nécessaires à l'exécution des méthodes appelées et aux instances crées
    use App\manager\ManagerJoueur;
    use App\manager\ManagerPersonnages;
    use App\manager\ManagerClasses;
    use App\utils\ToolBox;

    include './App/manager/ManagerJoueur.php';
    include './App/manager/ManagerClasses.php';
    include './App/manager/ManagerPersonnage.php';

    class ControllerPlayer extends ManagerJoueur {

        public function signIn() {
            //On définie la variable message pour communiquer avec la vue 
            $message = null;

            //On vérifie si le formulaire a été soumis
            if (isset($_POST['submit_sign_in'])) {

                //On vérifie si tous les champs on été complétés
                if (!empty($_POST['mail']) AND !empty($_POST['password'])) {

                    //On nettoie les champs saisis par l'utilisateur
                    $mail = ToolBox::nettoyerDonnees($_POST['mail']);
                    $password = ToolBox::nettoyerDonnees($_POST['password']);

                    //On instancie un joueur via la classe ManagerJoueur
                    $this->setMail($mail);
                    $this->setPassword($password);
                    $data = $this->getPlayerByMail();

                    if ($data) {

                        //On vérifie si le mot de passe est correct
                        if (password_verify($password, $data[0]['password_joueur'])) {
                            $_SESSION['connected'] = true;
                            $_SESSION['id'] = $data[0]['id_joueur'];
                            $_SESSION['pseudo'] = $data[0]['pseudo_joueur'];
                            $_SESSION['email'] = $data[0]['mail_joueur'];
                            
                            
                            //On revoie un message d'erreur à la vue : connexion réussie
                            $message = ToolBox::definirMessage(8, $data[0]['pseudo_joueur']);
                        } else {

                            //On revoie un message d'erreur à la vue : mail ou password incorrect
                            $message = ToolBox::definirMessage(7,'');
                        }
                    } else {
                        //On revoie un message d'erreur à la vue : mail ou password incorrect
                        $message = ToolBox::definirMessage(7,'');
                    }

                } else {

                    //On renvoie un message d'erreur à la vue : tous les champs du formulaire ne sont pas complétés
                    $message = ToolBox::definirMessage(4,'');
                }
            }

                //On include le header
                include './App/vue/header.php';

                //On include la vue Sign up
                include './App/vue/view_sign_in.php';
        }

        public function signOn() {
            //On définie la variable message pour communiquer avec la vue 
            $message = '';

            //On vérifie si le formulaire a été soumis
            if (isset($_POST['submit_sign_on'])) {

                //On vérifie que tous les champs du formulaire ont bien été complétés

                if (!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['password'])) {

                    //On nettoie les données saisies et on les stocke dans des variables    
                    $pseudo = ToolBox::nettoyerDonnees($_POST['pseudo']);
                    $mail = ToolBox::nettoyerDonnees($_POST['mail']);
                    $password = ToolBox::nettoyerDonnees($_POST['password']);

                    //On va hasher le MDP
                    $password = password_hash($password, PASSWORD_DEFAULT);

                    //On instancie un nouveau joueur (via ManagerJoueur)
                    $this->setPseudo($pseudo);
                    $this->setMail($mail);
                    $this->setPassword($password);

                    //On va vérifier si le joueur existe déjà via son mail
                    if(!$this->getPlayerByMail()) {
                        
                        //On va créer le joueur dans la BDD
                        if($this->insertPlayer()) {

                            //On renvoie un message à la vue : le compte a bien été créé
                            $message = ToolBox::definirMessage(0,'');
                        }  else {

                            //On renvoie un message à la vue : erreur lors de l'insertion dans la BDD
                            $message = ToolBox::definirMessage(0,'');
                        }

                    } else {
                        //On renvoie un message à la vue : l'adresse mail est déjà utilisée
                        $message = ToolBox::definirMessage(1,'');
                    }

                } else {
                    //On renvoie un message à la vue : tous les champs ne sont pas remplis
                    $message = ToolBox::definirMessage(4,'');
                }
            }   

            //On include le header
            include './App/vue/header.php';

            //On include la vue Sign On
            include './App/vue/view_sign_on.php';
        }

        public function showAccount(){
            //Déclaration des variables à afficher dans la vue
            $pseudo = $_SESSION['pseudo'];
            $mail = $_SESSION['email'];
            $charactersList = [];

            $character = new ManagerPersonnages();
            $character->setIdJoueur($_SESSION['id']);
            $dataCharacters = $character->getAllCharacters();

            foreach ($dataCharacters as $item) {
                $newCharacter = new ManagerPersonnages();
                $newClass = new ManagerClasses();
                
                //Set de l'ID de l'instance $newClass pour utiliser la méthode getClassById
                $newClass->setId($item['id_classe']);

                //Appel de la méthode getClassById pour récupérer les autres informations de la classe
                $dataClass = $newClass->getClassById();

                //Set des autres attributs de l'instance $newClass
                $newClass->setNom($dataClass[0]['nom_classe']);
                $newClass->setPointsDeVie($dataClass[0]['points_de_vie_classe']);
                $newClass->setAttaque($dataClass[0]['attaque_classe']);
                $newClass->setDefense($dataClass[0]['defense_classe']);

                //Set des attributs de l'instance $newCharacter
                $newCharacter->setId($item['id_personnage']); 
                $newCharacter->setNom($item['nom_personnage']);
                $newCharacter->setClasse($newClass);
                $newCharacter->setIdJoueur($item['id_joueur']);

                //Push de l'instance $newCharacter dans le tableau $charactersList
                $charactersList[] = $newCharacter;
            }
            
            //Enfin on set le tableau 
            $this->setListPerso($charactersList);

             //On include le header
             include './App/vue/header.php';

             //On include la vue Sign up
             include './App/vue/view_user_account.php';
        }

        public function showAllCharacters(){
            //Déclaration des variables à afficher dans la vue
            $charactersList = [];

            $character = new ManagerPersonnages();
            $character->setIdJoueur($_SESSION['id']);
            $dataCharacters = $character->getAllCharacters();

            //Pour chaque personnages contenu dans le taleau associatif (retour de la requête getAllCharacters())
            foreach ($dataCharacters as $item) {
                //On créé une nouvelle instance de personnage
                $newCharacter = new ManagerPersonnages();
                //On créé une nouvelle instance de classe
                $newClass = new ManagerClasses();
                
                //Set de l'ID de l'instance $newClass pour utiliser la méthode getClassById
                $newClass->setId($item['id_classe']);

                //Appel de la méthode getClassById pour récupérer les autres informations de la classe
                $dataClass = $newClass->getClassById();

                //Set des autres attributs de l'instance $newClass
                $newClass->setNom($dataClass[0]['nom_classe']);
                $newClass->setPointsDeVie($dataClass[0]['points_de_vie_classe']);
                $newClass->setAttaque($dataClass[0]['attaque_classe']);
                $newClass->setDefense($dataClass[0]['defense_classe']);

                //Set des attributs de l'instance $newCharacter
                $newCharacter->setId($item['id_personnage']); 
                $newCharacter->setNom($item['nom_personnage']);
                $newCharacter->setClasse($newClass); //On set l'instance $newClass dans l'instance personnage $newCharacter
                $newCharacter->setIdJoueur($item['id_joueur']);

                //Push de l'instance $newCharacter dans le tableau $charactersList
                $charactersList[] = $newCharacter;
            }
            
            //Enfin on set le tableau dans l'instance contrôleur en cours
            $this->setListPerso($charactersList);

             //On include le header
             include './App/vue/header.php';

             //On include la vue Sign up
             include './App/vue/view_characters_list.php';
            
        }
    }
?>