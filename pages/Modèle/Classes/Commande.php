<?

class Commande {
    private int $totalPayer;
    private String $modePayment; //indique si le payment va etre fait en CB ou Paypal
            //exemple $modePayment = 'CB'
    private $datePayment;


    function __construct(int $totalPayer, String $modePayment) { 
        $this ->totalPayer = $totalPayer;
        $this ->modePayment = $modePayment;
        $this->datePayment = date('Y-m-d H:i:s');
        
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




}
?>