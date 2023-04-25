<?php

    //On spécifie l'espace de nom auquel appartient la classe
    namespace App\model;

    class Joueur {
        private ?int $id_utilisateur;
        private ?string $pseudo_utilisateur;
        private ?string $mail_utilisateur;
        private ?string $password_utilisateur;
        private ?array $listPerso_utilisateur;

        //En full POO on préfère ne pas mettre de constructeur et setter les attributs des instances au besoin 

        public function getId():int {
            return $this->id_utilisateur;
        }

        public function getPseudo():string {
            return $this->pseudo_utilisateur;
        }

        public function getMail():string {
            return $this->mail_utilisateur;
        }

        public function getPassword():string {
            return $this->password_utilisateur;
        }

        public function getListPerso():array {
            return $this->listPerso_utilisateur;
        }

        public function setPseudo(?string $pseudo):void {
            $this->pseudo_utilisateur = $pseudo;
        }

        public function setMail(?string $mail):void {
            $this->mail_utilisateur = $mail;
        }

        public function setPassword(?string $password) {
            $this->password_utilisateur = $password;
        }

        public function setListPerso(?array $listPersonnage) {
            $this->listPerso_utilisateur = $listPersonnage;
        }
    }
?>