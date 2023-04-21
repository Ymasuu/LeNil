<?

//La recherche existe quand elle est faite par un client.
//Puis chaque fois q'un client fait le meme type de recherche
//on l'ajoute dans la listeClients ici.
//De meme les Clients ont une liste de recherche qu'ils ont fait
//enregistrée dans la bdd
class Recherche {
    private String $motCle;
    private $listeProduits; //0..* liste de type Produit
    private $listeClients; // 1..* liste de type Clients

    function __construct(String $motCle) { 
        $this ->motCle = $motCle;
        $this->rechercherListeProduits($motCle);
      }



      //à faire plus tard
      function rechercherListeProduits() {
        return null;
    }

    function trierListeProduitsASC() {
       $this->insertionSortProduit($this->getListeProduits(),var_dump(count($this->getListeProduits())));
    }

    function getListeProduits() {
        return $this->listeProduits;
    }

    function getmotCle() {
        return $this->motCle;
    }
 //-----------------------------------------------------------------------------------
//arr contient des produits de type Produit
//et le tri est fair selon le prix
function insertionSortProduit(&$arr, $n)
{
    for ($i = 1; $i < $n; $i++)
    {
        $key = $arr[$i]->getCaracteristique()->getValeur();
        $j = $i-1;
     
        // Move elements of arr[0..i-1],
        // that are    greater than key, to
        // one position ahead of their
        // current position
        while ($j >= 0 && $arr[$j]->getCaracteristique()->getValeur() > $key)
        {
            $arr[$j + 1] = $arr[$j];
            $j = $j - 1;
        }
         
        $arr[$j + 1] = $key;
    }
}
 
// A utility function to
// print an array of size n
function printArray(&$arr, $n)
{
    for ($i = 0; $i < $n; $i++)
        echo $arr[$i]." ";
    echo "\n";
}


}
?>