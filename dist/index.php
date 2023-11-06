<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="auth.png">
  <title>Connexion</title>
</head>
<body class="flex flex-col min-h-screen">
  <nav class="bg-slate-800 h-16 md:flex">
    <div class="flex-2 flex items-center justify-center md:px-10 font-bold text-2xl text-gray-100">Authentification</div>
    <div class="flex-1 flex justify-end items-center justify-center md:justify-end mt-1 md:mt-0 px-10">
      <ul class="flex space-x-6">
        <li><a href="/PHP/authExo/dist/" class="text-gray-300 font-bold">Connexion</a></li>
        <li><a href="/PHP/authExo/dist/inscription.php" class="text-gray-300 font-bold">Inscription</a></li>
      </ul>
    </div>
  </nav>

      <?php 
      session_start();
      if (isset($_SESSION['success']))
      {
        echo '<p class="text-green-700 font-bold text-center text-shadow underline" id="success">L\'utilisateur a bien été enregistré !<p>';
      }

    ?>
<div class="min-h-screen">
  <section class="my-[5rem] w-full flex justify-center">
    <div class="md:w-1/2 bg-orange-300 border-2 rounded-md py-5 px-3">
      <form method="POST" action="" id="form" onsubmit="return VerifMdp()">
      <h2 class="text-center text-xl font-bold">Authentification</h2>
      <!-- Row -->
      <div class="lg:flex mt-2">
        <!-- Column -->
        <div class="lg:flex-1 lg:flex justify-center">
          <div class="mb-4">
            <label for="email" class="block text-gray-800 text-md font-bold mb-2">Adresse:</label>
            <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline">
          </div>
        </div>
        <!-- Column -->
        <div class="lg:flex-1 lg:flex justify-center">
          <div class="mb-4">
            <label for="password" class="block text-gray-800 text-md font-bold mb-2">Mot de passe:</label>
            <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline">
          </div>
        </div>
      </div>
      <div class="flex justify-center gap-2 mt-5">
        <button type="submit" name="submitted" class="bg-blue-500 hover:bg-blue-600 text-white transition duration-200 ease-in-out font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue active:bg-gray-600">
          Se connecter
        </button>

        <button type="button" onclick="ClearForm()" class="bg-red-500 hover:bg-red-600 text-white transition duration-200 ease-in-out font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue active:bg-gray-600">Annuler</button>
      </div>
    </form>
    </div>
  </section>
</div>

  <footer class="bottom-0 w-full py-2 text-center">
    <div class="container mx-auto">
        <p class="text-gray-600">
            Copyright &copy; <script>document.write(new Date().getFullYear())</script> MedIsm
        </p>
    </div>
  </footer>

<?php 
    session_start();
    
if (isset($_SESSION['success']))
{
  unset($_SESSION['success']);
}
    if ($_SESSION['connection'])
    {
      header('location: Authentified/index.php');
    }
  //ici s'il est co
  if(isset($_POST['submitted']))
  {
    try
    {
      $pdo = new PDO("mysql:host=127.0.0.1;dbname=test", 'root', '123');

      $email = $_POST['email'];
      $password = $_POST['password'];

      $sql = "SELECT * FROM users WHERE password = :password AND email = :email";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':password', $password);
      $stmt->bindParam(':email', $email);
      $stmt->execute();

      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      $first_name = $result['first_name'];
      $last_name = $result['last_name'];

      if ($result['first_name'] == null)
      {
        echo "<script>alert('Identifiants incorrect')</script>";
      }
      else
      {
        $_SESSION['connection'] = true;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        header('Location: Authentified/index.php');
        exit();
      }

    }
    catch (PDOException $e)
    {
      echo "Connection echoué: " . $e->getMessage();
    }
    
  }
?>



 <script>

//Retirer l'utilisateur a bien été enregistré
  $(document).ready(function() {
      // Cacher le message de succès après 3 secondes
      setTimeout(function() {
          $('#success').fadeOut('slow');
      }, 3000);
  });

//Réinitialiser le form
  function ClearForm(){
    const form = document.getElementById('form')

    inputs = form.querySelectorAll('input')

    for (let input of inputs){
      input.value = '';
    }
  }

 </script>
</body> 
</html>