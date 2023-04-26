<?php

    //On spécifie l'espace de nom auquel appartient la classe
    namespace App\utils;

    class ToolBox {
        static function definirMessage($evenement, $name) {
            switch ($evenement) {
                case 0:
                    return '<br><div class="alert alert-success w-50 mx-auto mt-3 text-center" role="alert">Votre compte a bien été créé</div>';
                    break;
                
                case 1:
                    return '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">L\'adresse mail saisie est déjà utilisée par un autre compte</div>';
                    break;
    
                case 2:
                    return '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">La taille de l\'image ne doit pas dépassée 100ko.</div>';
                    break;
    
                case 3:
                    return '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">Le format de l\'image n\'est pas correct. Les formats acceptées sont .jpg, .jpeg et .png.</div>';
                    break;
            
                case 4:
                    return '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">Veuillez compléter tous les champs du formulaire.</div>';
                    break;
    
                case 5:
                    return '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">Format de l\'adresse mail incorrect.</div>';
                    break;
                
                case 6:
                    return '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">Format du lien de l\'image incorrect.</div>';
                    break;
    
                case 7:
                    return '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">Adresse mail ou mot de passe incorrect.</div>';
                    break;
            
                case 8:
                    return '<br><div class="alert alert-success w-50 mx-auto mt-3 text-center" role="alert">Bienvenue '.$name.'! Vous êtes connecté.</div>';
                    break;
                
                case 9:
                    return '<br><div class="alert alert-danger w-50 mx-auto mt-3 text-center" role="alert">Erreur lors de l\'insertion en BDD</div>';
                    break;

                case 10:
                    return '<br><div class="alert alert-danger w-50 mx-auto mt-3 text-center" role="alert">Vous possédez déjà un personnage appelé '.$name.'</div>';
                    break;

                case 11:
                    return '<br><div class="alert alert-success w-50 mx-auto mt-3 text-center" role="alert">Le personnage '.$name.' a bien été créé.</div>';
                    break;
                
                case 12:
                    return '<br><div class="alert alert-success w-50 mx-auto mt-3 text-center" role="alert">Le personnage '.$name.' a bien été mis à jour.</div>';
                    break;

                case 13:
                    return '<br><div class="alert alert-danger w-50 mx-auto mt-3 text-center" role="alert">Le personnage '.$name.' n\'existe pas dans la base de donnée.</div>';
                    break;
                default:
                    return '<br><div class="alert alert-danger w-50 mx-auto text-center" role="alert">Erreur inconnue. Veuillez réessayer plus tard;</div>';
                    break;
            }
        }

        static function nettoyerDonnees($var) {
            $var = htmlentities($var);
            $var = strip_tags($var);
            $var = trim($var);
            $var = stripslashes($var);
            return $var;
        }

        static function get_file_extension($file) {
            return substr(strrchr($file,'.'),1);
        }
    }
?>