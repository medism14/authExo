<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="shortcut icon" href="../auth.png">
  <title>Authentifié</title>
</head>
<body>
<?php  include('header.php'); ?>
  <section class="flex flex-col min-h-screen">
    <h1 class="text-3xl font-bold underline mt-10 text-center">
      Bienvenue
    </h1>
  </section>

<?php include('footer.php'); ?>

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

</body>
</html>