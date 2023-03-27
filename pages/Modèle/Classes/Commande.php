<?

class Commande {
    private int $totalPayer;
    private String $modePayment; //indique si le payment va etre fait en CB ou Paypal
            //exemple $modePayment = 'CB'
    private $datePayment;
    private QuantiteCommande $quantiteCommande; //1..1 chaque Commande a une QuantiteCommande


    function __construct(int $totalPayer, String $modePayment,QuantiteCommande $quantiteCommande) { 
        $this ->totalPayer = $totalPayer;
        $this ->modePayment = $modePayment;
        $this->datePayment = date('Y-m-d H:i:s');
        $this->quantiteCommande = $quantiteCommande;
        
      }

function getTotalPayer() {
    return $this->totalPayer;
}

function getModePayment() {
    return $this->modePayment;
}

function getDatePayment() {
    return $this->datePayment;
}


function getQuantiteCommande() {
    return $this->quantiteCommande;
}




}
?>