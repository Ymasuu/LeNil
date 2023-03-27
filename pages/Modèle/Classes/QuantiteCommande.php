<?

class QuantiteCommande {
    private Adresse $adresse;// 1..1 adresse
    private Commande $commande;//1..1 Commande


    function __construct(Adresse $adresse,Commande $commande) {
        $this->adresse = $adresse;
        $this->commande = $commande;
    }

    function getAdresse() {
        return $this->adresse;
    }

    function getCommande() {
        return $this->commande;
    }

}

?>