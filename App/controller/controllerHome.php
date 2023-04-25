<?php
    //On spécifie l'espace de nom auquel appartient la class
    namespace App\controller;

    class ControllerHome {

        public function showHome() {
            //On include le header
            include './App/vue/header.php';

            //On include la vue Sign up
            include './App/vue/view_home.php';
        }

    }
?>