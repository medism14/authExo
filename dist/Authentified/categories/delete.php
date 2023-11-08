<?php 
	if(isset($_GET['id']))
	{
		session_start();
		include('../../bdd.php');
		$id = $_GET['id'];
		$sql = "DELETE FROM categorie WHERE id_categorie = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam('id', $id);
		$stmt->execute();

		$_SESSION['display_message'] = '<span class="text-red-600 underline">La categorie a bien été supprimée</span>';

	}
	header('Location: index.php');
	exit(); 
?>