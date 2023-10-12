<?php
session_start();

if(isset($_POST['clear_success']) && $_POST['clear_success'] === true) {
    unset($_SESSION['success']);
    // Vous pouvez envoyer une réponse JSON au client si nécessaire
    echo json_encode(['message' => 'Session success cleared']);
}
?>
