<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="shortcut icon" href="../auth.png">
  <title>Authentifié</title>
</head>
<body id="body"> 
    <nav class="bg-slate-800 h-16 flex">
      <div class="flex-2 flex items-center px-10 font-bold text-2xl text-gray-100"><?php 
      session_start();
      $first_name = $_SESSION['first_name'];
      $last_name = $_SESSION['last_name'];

      if ($_SESSION['type'] == '1')
      {
        echo "Utilisateur : ";
      }else
      {
        echo "Administrateur : ";
      }
      echo "$first_name $last_name";

      include('../bdd.php');
    ?></div>
    <div class="flex-1 flex justify-end items-center px-10">
      <ul class="flex items-center space-x-6">
        <li><a href="index.php" class="text-gray-100 font-bold text-md hover:bg-yellow-600 px-5 py-3 rounded transition duration-300 ease-in-out" id="index">Accueil<a></li>
        <li><a href="categories/index.php" class="text-gray-100 font-bold text-md hover:bg-yellow-600 px-5 py-3 rounded transition duration-300 ease-in-out" id="categorie">Categories<a></li>
        <li><a href="products/index.php" class="text-gray-100 font-bold text-md hover:bg-yellow-600 px-5 py-3 rounded transition duration-300 ease-in-out" id="produits">Produits</a></li>
        <li class="relative group">
          <span class="text-white font-bold px-5 py-6 rounded transition duration-300 ease-in-out cursor-pointer">Panier <i class="fa fa-shopping-cart"></i></span>
          <ul class="absolute hidden bg-gray-300 p-2 rounded-md text-black w-[400%] group-hover:block mt-5 left-1/2 -translate-x-1/2 z-50">
            <span class="w-full flex justify-center underline mb-5 mt-3 font-bold">Panier</span>
            <?php 
            $i = 1;
              include('../bdd.php');
              $user = $_SESSION['id_user'];

              $sql = "SELECT panier.id, panier.quantite as quantity, produits.* FROM panier JOIN produits on panier.id_produit = produits.id_produit WHERE id_user = :user";
              $stmt = $pdo->prepare($sql);
              $stmt->bindParam('user', $user);
              $stmt->execute();
              $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

              if ($result == null)
              {
                echo '<span class="text-center block font-bold text-xl text-gray-600">(Vide)</span>';
              }

              foreach ($result as $r)
              {
                ?>
             <li class="mb-1">
              <div class="relative">
                <span class="block px-4 py-3 hover:bg-gray-300 mb-5"><?php echo($i . ' | ' . $r['designation'] . ' x ' . $r['quantity']) ?> </span>
                <button id="removePanier<?php echo($r['id']) ?>" class="absolute right-0 top-0 p-3 hover:bg-red-500 rounded-md transition duration-200 ease-in-out cursor-pointer"><i class="fa fa-trash"></i></button>
              </div>
            </li>
          <?php $i++;} ?>
          </ul>
          </table>
        </li>
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

  <script>
    const result = <?php echo(json_encode($result)) ?>;

    for (r of result)
    {
      const btnRemove = document.getElementById('removePanier' + r.id);

      btnRemove.addEventListener('click', () => 
      {
        if (confirm("Vous êtes sûr de vouloir supprimer ce produit du panier ?")){
          window.location.href = 'removePanier.php?id=' + r.id;
        }
      });
    }
  </script>