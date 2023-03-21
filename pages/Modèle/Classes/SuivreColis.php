<?php
class SuivreColis {
    private int $numero;
    private $dateLivraison;
    private Colis $colis;
    private ProduitsVendeur $prod;

    function __construct(int $numero,$dateLivraison, Colis $colis, ProduitsVendeur $prod) { 
        $this -> numero = $numero;
        $this -> dateLivraison = date('Y-m-d H:i:s'); 
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