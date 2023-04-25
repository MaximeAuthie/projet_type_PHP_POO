<?php

    //On spécifie l'espace de nom auquel appartient la classe
    namespace App\controller;

    //Importer les espaces de nom nécessaires à l'exécution des méthodes appelées et aux instances crées
    use App\manager\ManagerPersonnages;
    use App\manager\ManagerClasses;
    use App\utils\ToolBox;

    class ControllerCharacter extends ManagerPersonnages {
        
        public function newCharacter() {

            //On définie la variable message pour communiquer avec la vue 
            $message = '';

            //On vérifie si le formulaire a été submit
            if (isset($_POST['submit_add_character'])) {

                //On vérifie si tous les champs on été complétés
                if (!empty($_POST['name'] AND !empty($_POST['class']))) {
                    
                    //On nettoie les données saisies par le joueur
                    $name = ToolBox::nettoyerDonnees($_POST['name']);
                    $classId = ToolBox::nettoyerDonnees($_POST['class']);
                    $class = new ManagerClasses();

                    //On set l'attribut ID à la classe pour pouvoir utiliser la méthode getClassById() de l'instance $class
                    $class->setId($classId);

                    //On récupère toutes les informations de la classe via l'ID renvoyé par la liste déroulante du formulaire
                    $data = $class->getClassById();
                    
                    //On set tous les attribut de l'instance $class pour la setter dans l'instace $this (personnage actuel)
                    
                    $class->setNom($data[0]['nom_classe']);
                    $class->setPointsDeVie($data[0]['points_de_vie_classe']);
                    $class->setAttaque($data[0]['attaque_classe']);
                    $class->setDefense($data[0]['defense_classe']);

                    //On set les paramètre pour l'instance en cours
                    $this->setNom($name);
                    $this->setIdJoueur($_SESSION['id']);
                    $this->setClasse($class);

                    //On vérifie si le personnage n'existe pas déjà pour ce joueur
                    if (!$this->getCharacterByName()) {

                        //On va insérer le personnage dans la BDD
                        $this->addCharacter();

                        //On renvoie un message à la vue : le compte a bien été créé
                        $message = ToolBox::definirMessage(11,$this->getNom());

                    } else {

                        //On renvoie un message à la vue : le personnage existe déjà pour ce joueur
                        $message = ToolBox::definirMessage(10,$this->getNom());
                        
                    }

                } else {

                    //On renvoie un message à la vue : tous les champs ne sont pas remplis
                    $message = ToolBox::definirMessage(4,'');

                }
            }

            //On include le header
            include './App/vue/header.php';

            //On include la vue Sign up
            include './App/vue/view_add_character.php';
           
        }
    }
?>