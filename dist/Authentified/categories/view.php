<?php 

	function fetchData($id) 
	{
		session_start();
		include('../../bdd.php');
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
