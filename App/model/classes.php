<?php

    //On spécifie l'espace de nom auquel appartient la classe
    namespace App\model;

    class Classes {
        private ?int $id_classe;
        private ?string $nom_classe;
        private ?int $pointsDeVie_classe;
        private ?int $attaque_classe;
        private ?int $defense_classe;
       

        //En full POO on préfère ne pas mettre de constructeur et setter les attributs des instances au besoin 

        public function getId():int {
            return $this->id_classe;
        }

        public function getNom():string {
            return $this->nom_classe;
        }

        public function getPointsDeVie():string {
            return $this->pointsDeVie_classe;
        }

        public function getAttaque():int {
            return $this->attaque_classe;
        }

        public function getDefense():int {
            return $this->defense_classe;
        }

        public function setId(?int $id):void {
            $this->id_classe = $id;
        }

        public function setNom(?string $nom):void {
            $this->nom_classe = $nom;
        }

        public function setPointsDeVie(?int $pointsDeVie):void {
            $this->pointsDeVie_classe = $pointsDeVie;
        }

        public function setAttaque(?int $attaque):void {
            $this->attaque_classe = $attaque;
        }

        public function setDefense(?int $defense):void {
            $this->defense_classe = $defense;
        }
    }
?>