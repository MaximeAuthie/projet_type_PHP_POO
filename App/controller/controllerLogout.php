<?php

    //On spécifie l'espace de nom auquel appartient la classe
    namespace App\controller;

    class ControllerLogout {

        public function logout() {
            //On détruit la superglobale $_SESSIONs
            session_destroy();

            //On include le header
            include './App/vue/header.php';

            //On include la vue Sign up
            include './App/vue/view_logout.php'; 
        }
    }
    

?>