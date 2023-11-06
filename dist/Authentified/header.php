<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="shortcut icon" href="../../auth.png">
  <title>Authentifié</title>
</head>
<body id="body"> 
    <nav class="bg-slate-800 h-16 flex">
      <div class="flex-2 flex items-center px-10 font-bold text-2xl text-gray-100"><?php 
      session_start();
      $first_name = $_SESSION['first_name'];
      $last_name = $_SESSION['last_name'];

      echo "$first_name $last_name";

      $pdo = new PDO('mysql:host=127.0.0.1;dbname=test', 'root', '123');
    ?></div>
    <div class="flex-1 flex justify-end items-center px-10">
      <ul class="flex items-center space-x-6">
        <li><a href="index.php" class="text-gray-100 font-bold text-md hover:bg-yellow-600 px-5 py-3 rounded transition duration-300 ease-in-out" id="index">Accueil<a></li>
        <li><a href="categories/index.php" class="text-gray-100 font-bold text-md hover:bg-yellow-600 px-5 py-3 rounded transition duration-300 ease-in-out" id="categorie">Categories<a></li>
        <li><a href="products/index.php" class="text-gray-100 font-bold text-md hover:bg-yellow-600 px-5 py-3 rounded transition duration-300 ease-in-out" id="produits">Produits</a></li>
        <li>
            <form method="POST" action="">
              <button name="logout" class="rounded bg-red-500 px-5 py-2 font-semibold text-gray-100 transition duration-200 ease-in-out hover:bg-red-600">Deconnexion</button>
            </form>
        </li>
      </ul>
    </div>
  </nav>

    <?php 

    if (!$_SESSION['connection']){
      header('location: ../index.php');
      exit;
    }


    if (isset($_POST['logout'])){
      unset($_SESSION['connection']);

      session_destroy();

      header('location:../index.php');
    }
  ?>

  <?php 
    if (isset($_SESSION['display_message']))
        {
          echo '<div class="text-center mt-3" id="display_message">';
          echo $_SESSION['display_message'];
          echo '</div>';
        }
  ?>