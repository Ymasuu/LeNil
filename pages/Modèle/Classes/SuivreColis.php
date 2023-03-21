<?php
class SuivreColis {
    private int $numero;
    private $dateLivraison = date('Y-m-d H:i:s');
    private Colis $colis;
    private ProduitsVendeur $prod;

    function __construct(int $numero, int $dateLivraison, Colis $colis, ProduitsVendeur $prod) { 
        $this -> numero = $numero;
        $this -> dateLivraison = $dateLivraison; 
        $this -> colis = $colis;
        $this -> prod = $prod;
    }
    function getNumero() {
        return $this->numero;
    }
    function getDateLivraison() {
        return $this->dateLivraison;
    }

    function getColis(){
        return $this->colis;
    }

    function getProd(){
        return $this->prod;
    }

}