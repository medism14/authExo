<?php 
	if(isset($_GET['id']))
	{
		session_start();
		$pdo = new PDO('mysql:hostname=127.0.0.1;dbname=test', 'root', '123');
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