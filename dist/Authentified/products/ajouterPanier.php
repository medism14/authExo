<?php 
	if (isset($_GET['id']) && isset($_GET['quantite']))
	{
		//Recupération des données
		session_start();
		include('../../bdd.php');
		$data = "SELECT * FROM produits WHERE id_produit = :id";
		$stmt = $pdo->prepare($data);
		$stmt->bindParam('id', $_GET['id']);
		$stmt->execute();


		$produit = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$produit = $produit[0];
		$user = $_SESSION['id_user'];
		$quantite = $_GET['quantite'];

		//Verification si le produit est null ou bien a une quantité inferieur à 0 (faille avec le get)
		if ($produit == null)
		{
			$_SESSION['display_message'] = '<span class="text-red-600 underline">Vous devez ajouter un produit existant</span>';
			header('location: index.php'); 
		}else if ($produit['quantite'] <= 0 || $produit['quantite'] < $quantite )
		{
			$_SESSION['display_message'] = '<span class="text-red-600 underline">Erreur sur la quantité</span>';
			header('location: index.php');
		}

		//Verifier si le même produit existe donc ajouter ou non
		$sql = "SELECT id from panier where id_produit = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam('id', $_GET['id']);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$panier = $result[0];
		$id_panier = $panier['id'];

		if ($result == null)
		{
			//Insertion des données dans la table panier
			$sql = "INSERT INTO panier(quantite, id_user, id_produit) values(:quantite, :user, :produit)";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':quantite', $quantite);
			$stmt->bindParam(':user', $user);
			$stmt->bindParam(':produit', $produit['id_produit']);
			$stmt->execute();
		}else
		{
			$sql = "UPDATE panier set quantite = quantite + :quantite where id = :id_panier";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':quantite', $quantite);
			$stmt->bindParam(':id_panier', $id_panier);
			$stmt->execute();
		}

		//Retrait quantité du produit
		$sql = "UPDATE produits SET quantite = quantite - :quantite where id_produit = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam('quantite', $quantite);
		$stmt->bindParam('id', $_GET['id']);
		$stmt->execute();

		//Retrait de la quantité dans la table produit
		$_SESSION['display_message'] = '<span class="text-green-600 underline">Le produit a bien été ajouté dans le panier</span>';
	}
		header('location: index.php');

?>