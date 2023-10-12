<?php 

	function fetchData($id) 
	{
		session_start();
		$pdo = new PDO('mysql:host=127.0.0.1;dbname=test', 'root', '123');
		$sql = "SELECT produits.* 
            FROM produits,categorie 
            WHERE produits.categorie = categorie.id_categorie
            AND categorie.id_categorie = $id";

	    $stmt = $pdo->query($sql);

	    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	    echo json_encode($results);
	}

if(isset($_GET['fetch_id']))
{
	$id = $_GET['fetch_id'];
	fetchData($id);
}
    
?>
