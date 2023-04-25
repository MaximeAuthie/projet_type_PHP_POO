<?php

    //On spécifie l'espace de nom auquel appartient la classe
    namespace App\model;

    class Personnages {
        private ?int $id_personnage;
        private ?string $nom_personnage;
        private ?Classes $classe_personnage;
        private ?int $id_joueur;

        //En full POO on préfère ne pas mettre de constructeur et setter les attributs des instances au besoin 
        
        public function getId():int {
            return $this->id_personnage;
        }

        public function getNom():string {
            return $this->nom_personnage;
        }

        public function getClasse() {
            return $this->classe_personnage;
        }

        public function getIdJoueur() {
            return $this->id_joueur;
        }

        public function setId(?int $id):void {
            $this->id_personnage = $id;
        }

        public function setNom(?string $nom_personnage):void {
            $this->nom_personnage = $nom_personnage;
        }

        public function setClasse(?Classes $classe):void {
            $this->classe_personnage = $classe;
        }

        public function setIdJoueur(?int $id):void {
            $this->id_joueur = $id;
        }
    }

?>