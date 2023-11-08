<?php 
	if (isset($_GET['id']))
	{
		//Recupération des données
		session_start();
		$test = include('../bdd.php');
		if ($test == true)
		{
			include('../bdd.php');
		}else
		{
			include('../../bdd.php');
		}

		//Recuperation du panier
		$sql = "SELECT * FROM panier where id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':id', $_GET['id']);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$res = $result[0];

		//Rajout de la quantité retiré dans le panier
		$sql = "UPDATE produits set quantite = quantite + :quantite where id_produit = :id_produit";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':quantite', $res['quantite']);
		$stmt->bindParam(':id_produit', $res['id_produit']);
		$stmt->execute();

		//Suppression du panier
		$sql = "DELETE FROM panier WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam('id', $_GET['id']);
		$stmt->execute();

		//message d'envoie
		$_SESSION['display_message'] = '<span class="text-red-600 underline">Le produit a bien été supprimé du panier</span>';
		
	}
	header('location: products/index.php');
?>