<?php
	//Pour la connection de la bdd
	require_once '..\..\database\config\connection.php';
	require_once '..\..\database\config\database.php';
	session_start();
?>
<!DOCTYPE html>
<html> 
	<head>
		<meta charset="utf-8">
		<meta name="viewport">
		<title>Accueil</title>
		<link rel="stylesheet" href="../../css/index.css">
		<link rel="stylesheet" href="../../css/style.css">
		<link rel="icon" type="image/png" href="../../img/logo2.png">
	</head>
<body>
	<div>
		<?php include '../../templates/header.php'; ?>
        <hr> <!-- Repère visuel temporaire -->
		<?php
			if(isset($_SESSION["UTILISATEUR"])){
				echo " <h2 style=display:inline;> Bienvenue " . $_SESSION["UTILISATEUR"]["nom"] . " " . $_SESSION["UTILISATEUR"]["prenom"] . "</h4>";
			} 
			if(isset($_SESSION["merci"]))echo "<center><b>".$_SESSION["merci"]."</b></center>"; unset($_SESSION["merci"]);
		?>
		<div class = "global">
			<div class = "gauche">
				<h1>Filtres</h1>
				<form action="" method="post">
                <label><input type="checkbox" name="categories[]" value="informatique"
                    <?php if (isset($_POST['categories']) && in_array('informatique', $_POST['categories'])) echo 'checked'; ?>>
                    Informatique
                </label> <br>
                <label><input type="checkbox" name="categories[]" value="Jeux pour enfant"
                    <?php if (isset($_POST['categories']) && in_array('Jeux pour enfant', $_POST['categories'])) echo 'checked'; ?>>
                    Jeux pour enfant
                </label> <br>
                <label><input type="checkbox" name="categories[]" value="vetement" 
                    <?php if (isset($_POST['categories']) && in_array('vetement', $_POST['categories'])) echo 'checked'; ?>>
                    Vêtement
                </label> <br>
                <label><input type="checkbox" name="categories[]" value="lego" 
                    <?php if (isset($_POST['categories']) && in_array('lego', $_POST['categories'])) echo 'checked'; ?>>
                    Lego 
                </label> <br> <br> <br>

                <label><input type="checkbox" name="prix" value="1" onclick="UnChoixPossible(this)"
                    <?php if(isset($_POST['prix']) && $_POST['prix'] == 1) echo "checked"; ?> >
                    Entre 0 et 49 €
                </label> <br>
                <label><input type="checkbox" name="prix" value="2" onclick="UnChoixPossible(this)"                    
                    <?php if(isset($_POST['prix']) && $_POST['prix'] == 2) echo "checked"; ?> >
                    Entre 50 et 150 €
                </label> <br>
                <label><input type="checkbox" name="prix" value="3" onclick="UnChoixPossible(this)"
                    <?php if(isset($_POST['prix']) && $_POST['prix'] == 3) echo "checked"; ?> >
                    151 € ou plus
                </label> <br> <br> <br>


                <br> 
                <script>
                function UnChoixPossible(checkbox) {
                    var choix = document.getElementsByName("prix");
                    for (var i = 0; i < choix.length; i++) {
                        if (choix[i] !== checkbox) {
                            choix[i].checked = false;
                        }
                    }
                }
                </script>

                <label><input type="checkbox" name="vendeur[]" value="magasin1@gmail.com"
                    <?php if (isset($_POST['vendeur']) && in_array('magasin1@gmail.com', $_POST['vendeur'])) echo 'checked'; ?>>
                    magasin1
                </label> <br>
                <label><input type="checkbox" name="vendeur[]" value="magasin2@gmail.com"
                    <?php if (isset($_POST['vendeur']) && in_array('magasin2@gmail.com', $_POST['vendeur'])) echo 'checked'; ?>>
                    magasin2
                </label> <br>

                <br> <br> <br>
                <input type="submit" name="Filtre" class="bouton-golden" value="Filtrer">
				</form>
			</div>
			<div class="box">
			<?php
            //------------------------------------//
        //SI PERSONNE NEST CONNECTE
        if (empty($_SESSION["UTILISATEUR"]["email"])) {

                //Si $query contient une valeur de recherche
                if (isset($_GET['query']) && !empty($_GET['query'])) {
                    $query = $_GET['query'];
                    $motsCles = explode(" ", $query);
                    // Utiliser la variable $query ici
                    $motCle = $query;
                }
                                // Requête pour récupérer les informations de chaque produit
                                //Si rien dans la barre de recherche
                                if (empty($_GET['query'])) {
                                    
                                    $resultat = mysqli_query($conn, "SELECT * FROM produitsvendeur");
                                    if(isset($_POST['Filtre'])) {
                                        include('../Contrôleur/process_filtre.php');
                                        $resultat = $_SESSION['objet'];
                                    }
                                    
                                    //Parcours des résultats avec une boucle while
                                    while ($produit = mysqli_fetch_assoc($resultat)) {
                                        ?>
                                        <form action="pageProduit.php" method="post">
                                            <div class="article">
                                                <button type="submit" style="background-color: transparent; border: none; padding: 0; margin: 0; cursor: pointer;">
                                                    <img src="../../img/<?php echo $produit['NomImage']; ?>" style="width: 100px; height: 100px; margin-right: 10px;">
                                                    <div>
                                                        <h5><?php echo $produit['nom']; ?></h5>
                                                        <p><?php echo $produit['minidescription']; ?></p>
                                                        <p>Prix : <?php echo $produit['prix']; ?> €</p>
                                                    </div>
                                                </button>
                                                <input type="hidden" name="produit_id" value="<?php echo $produit['id']; ?>">
                                            </div>
                                        </form>
                                        <?php
                                    }
                                } else {
                                    // Sélectionner toutes les lignes de la table
                                    $sql = "SELECT * FROM ProduitsVendeur
                                            WHERE nom REGEXP '$query' OR description REGEXP '$query' OR minidescription REGEXP '$query'";
                                    $result = mysqli_query($conn, $sql);
                
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <form action="pageProduit.php" method="post">
                                            <div class="article">
                                                <button type="submit" style="background-color: transparent; border: none; padding: 0; margin: 0; cursor: pointer;">
                                                    <img src="../../img/<?php echo $row['NomImage']; ?>" style="width: 100px; height: 100px; margin-right: 10px;">
                                                    <div>
                                                        <h5><?php echo $row['nom']; ?></h5>
                                                        <p><?php echo $row['minidescription']; ?></p>
                                                        <p>Prix : <?php echo $row['prix']; ?> €</p>
                                                    </div>
                                                </button>
                                                <input type="hidden" name="produit_id" value="<?php echo $row['id']; ?>">
                                            </div>
                                        </form>
                                    <?php }
                                }
                                // Fermeture de la connexion à la base de données
                                mysqli_close($conn);

                            }

        //------------------------------------------------//
else if (!empty($_SESSION["UTILISATEUR"]["email"])) {

                //SI CLIENT CONNECTE ET
                //Si $query contient une valeur de recherche
if (isset($_GET['query']) && !empty($_GET['query'])) {
    $query = $_GET['query'];
    $motsCles = explode(" ", $query);
    // Utiliser la variable $query ici

    $emailCompte = $_SESSION["UTILISATEUR"]["email"];
    $motCle = $query;

    // Préparer la requête de vérification
    $stmt_check = $conn->prepare("SELECT COUNT(*) as count FROM Recherche WHERE emailCompte = ? AND motCle = ?");
    $stmt_check->bind_param("ss", $emailCompte, $motCle);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    $row = $result->fetch_assoc();
    
    if($row['count'] == 0) {
        //On ajoute dans la table Recherche la $query
        // Préparer la requête d'insertion avec des paramètres
        $stmt = $conn->prepare("INSERT INTO Recherche (emailCompte, motCle) VALUES (?, ?)");

        // Lier les paramètres avec les valeurs à insérer
        $stmt->bind_param("ss", $emailCompte, $motCle);

        // Exécuter la requête
        if ($stmt->execute()) {
            //echo "Insertion réussie";
        } else {
            echo "Erreur d'insertion: " . $conn->error;
        }

        // Fermer la connexion
        $stmt->close();
    }

    // Fermer la connexion
    $stmt_check->close();
}
                // Requête pour récupérer les informations de chaque produit
                //Si rien dans la barre de recherche
                if (empty($_GET['query'])) {
                    
                    $resultat = mysqli_query($conn, "SELECT * FROM produitsvendeur");
                    if(isset($_POST['Filtre'])) {
                        include('../Contrôleur/process_filtre.php');
                        $resultat = $_SESSION['objet'];
                    }
                    
                    //Parcours des résultats avec une boucle while
                    while ($produit = mysqli_fetch_assoc($resultat)) {
                        ?>
                        <form action="pageProduit.php" method="post">
                            <div class="article">
                                <button type="submit" style="background-color: transparent; border: none; padding: 0; margin: 0; cursor: pointer;">
                                    <img src="../../img/<?php echo $produit['NomImage']; ?>" style="width: 100px; height: 100px; margin-right: 10px;">
                                    <div>
                                        <h5><?php echo $produit['nom']; ?></h5>
                                        <p><?php echo $produit['minidescription']; ?></p>
                                        <p>Prix : <?php echo $produit['prix']; ?> €</p>
                                    </div>
                                </button>
                                <input type="hidden" name="produit_id" value="<?php echo $produit['id']; ?>">
                            </div>
                        </form>
                        <?php
                    }
                } else {
                    // Sélectionner toutes les lignes de la table
                    $sql = "SELECT * FROM ProduitsVendeur
                            WHERE nom REGEXP '$query' OR description REGEXP '$query' OR minidescription REGEXP '$query'";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <form action="pageProduit.php" method="post">
                            <div class="article">
                                <button type="submit" style="background-color: transparent; border: none; padding: 0; margin: 0; cursor: pointer;">
                                    <img src="../../img/<?php echo $row['NomImage']; ?>" style="width: 100px; height: 100px; margin-right: 10px;">
                                    <div>
                                        <h5><?php echo $row['nom']; ?></h5>
                                        <p><?php echo $row['minidescription']; ?></p>
                                        <p>Prix : <?php echo $row['prix']; ?> €</p>
                                    </div>
                                </button>
                                <input type="hidden" name="produit_id" value="<?php echo $row['id']; ?>">
                            </div>
                        </form>
                    <?php }
                }
                // Fermeture de la connexion à la base de données
                mysqli_close($conn); }
                ?>
			</div>
		</div>
        <hr> <!-- Repère visuel temporaire -->
		<?php include '../../templates/footer.php'; ?>
	</div>
</body>
</html>