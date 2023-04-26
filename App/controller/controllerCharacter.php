<?php

    //On spécifie l'espace de nom auquel appartient la classe
    namespace App\controller;

    //Importer les espaces de nom nécessaires à l'exécution des méthodes appelées et aux instances crées
    use App\manager\ManagerPersonnages;
    use App\manager\ManagerClasses;
    use App\model\Classes;
    use App\utils\ToolBox;

    class ControllerCharacter extends ManagerPersonnages {

        public function newCharacter() {

            //On va créer une instance de la classe Classes pour appeller la méthode getClassList() pour charger la liste des classe dans le select du formulaire affiché dans la vue
            $newClass = new ManagerClasses();
            $classList = $newClass->getAllClass();

            //On créé une variable pour stocker la chaine de caractère qui stocke les <options> pour faire un echo dans la vue
            $options = '';

            //On fait une boucle pour remplir notre variable $options avec tous les noms de catégories
            foreach ($classList as $class) {
                $options = $options.'<option value="'.$class['id_classe'].'">'.$class['nom_classe'].'</option>';
            }
           
            //On définie la variable message pour communiquer avec la vue 
            $message = '';

            //On vérifie si le formulaire a été submit
            if (isset($_POST['submit_add_character'])) {

                //On vérifie si tous les champs on été complétés
                if (!empty($_POST['name'] AND !empty($_POST['class']))) {
                    
                    //On nettoie les données saisies par le joueur
                    $name = ToolBox::nettoyerDonnees($_POST['name']);
                    $classId = ToolBox::nettoyerDonnees($_POST['class']);

                    //On créé une instance de classe pour pouvoir setter l'id afin d'utiliser la méthode getClassByID
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

        public function updateCharacter(?int $id) {
            //On va setter la variable $id et la variable de session 'id' dans  dans l'instance en cours pour utiliser la méthode getUserByid()
            $this->setId($id);
            $this->setIdJoueur($_SESSION['id']);

            $characterUser = $this->getCharacterById();
            $nom= $characterUser[0]['nom_personnage'];
            $idClass = $characterUser[0]['id_classe'];
             //On va créer une instance de la classe Classes pour appeller la méthode getClassById() pour récupérer le nom de la classe et l'afficher comme 'option selected'
            $newClass = new ManagerClasses();
            $newClass->setId($idClass);
            $nomClass = $newClass->getClassById();
            $nomClass = $nomClass[0]['nom_classe'];
            
           
            //On utilise la méthode getAllClass() de l'intance $newClass et on la stocke dans un tableau $classList pour pouvoir utiliser un foreach
            $classList = $newClass->getAllClass();
            
            //On créé une variable pour stocker la chaine de caractère qui stocke les <options> pour faire un echo dans la vue
            $options = '<option value="'.$idClass.'" selected>'.$nomClass.'</option>';
 
            //On fait une boucle pour remplir notre variable $options avec tous les noms de catégories
            foreach ($classList as $class) {
                $options = $options.'<option value="'.$class['id_classe'].'">'.$class['nom_classe'].'</option>';
            }

            //On définie la variable message pour communiquer avec la vue 
            $message = '';

            //On vérifie si le formulaire a été submit
            if (isset($_POST['submit_update_character'])) {

                //On vérifie si tous les champs on été complétés
                if (!empty($_POST['name'] AND !empty($_POST['class']))) {
                    
                    //On nettoie les données saisies par le joueur
                    $name = ToolBox::nettoyerDonnees($_POST['name']);
                    $classId = ToolBox::nettoyerDonnees($_POST['class']);

                    //On créé une instance de classe pour pouvoir setter l'id afin d'utiliser la méthode getClassByID
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

                    //On set les paramètre pour modidier les attributs de l'instance en cours
                    $this->setId($id);
                    $this->setNom($name);
                    $this->setIdJoueur($_SESSION['id']);
                    $this->setClasse($class);

                    //On vérifie si le personnage n'existe pas déjà pour ce joueur
                    if ($this->getCharacterById()) {

                        //On va  le personnage dans la BDD
                        $this->updateCharacterById();

                        //On renvoie un message à la vue : le personnage a bien été mis à jour
                        $message = ToolBox::definirMessage(12,$this->getNom());

                    } else {

                        //On renvoie un message à la vue : le personnage n'existe pas dans la BDD
                        $message = ToolBox::definirMessage(13,$this->getNom());
                        
                    }

                } else {

                    //On renvoie un message à la vue : tous les champs ne sont pas remplis
                    $message = ToolBox::definirMessage(4,'');

                }
            }

             //On include le header
             include './App/vue/header.php';

             //On include la vue Sign up
             include './App/vue/view_update_character.php';
        }
    }
?>