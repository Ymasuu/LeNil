<?php

class Colis {
    private int $longueur;
    private int $largeur;
    private int $hauteur;
    private int $poids;

    function __construct(int $longueur, int $largeur, int $hauteur,int $poids) { 
        $this ->longueur = $longueur;
        $this ->largeur = $largeur;
        $this->poids = $poids;
        $this->hauteur = date('Y-m-d H:i:s');
        
      }

      function getLongueur() {
        return $this->longueur;
    }

    function getHauteur() {
        return $this->hauteur;
    }

    function getPoids() {
        return $this->poids;
    }
}