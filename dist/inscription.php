<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="auth.png">
  <title>Inscription</title>
</head>
<body class="flex flex-col min-h-screen">
  <nav class="bg-slate-800 h-16 md:flex">
    <div class="flex-2 flex items-center justify-center md:px-10 font-bold text-2xl text-gray-100">Authentification</div>
    <div class="flex-1 flex justify-end items-center justify-center md:justify-end mt-1 md:mt-0 px-10">
      <ul class="flex space-x-6">
        <li><a href="index.php" class="text-gray-300 font-bold">Connexion</a></li>
        <li><a href="inscription.php" class="text-gray-300 font-bold">Inscription</a></li>
      </ul>
    </div>
  </nav>

  <div class="mt-[2rem] h-16 mx-10 flex items-center justify-center">
    <?php
      session_start();
     ?>
  </div>

  <section class="my-[1rem] w-full w-full flex justify-center">
    <div class="md:w-1/2 bg-orange-300 border-2 rounded-md py-5 px-3 mb-5">
      <form method="POST" action="" id="form" onsubmit="return VerifMdp()">
      <h2 class="text-center text-xl font-bold">Inscription</h2>
      <!-- Row -->
      <div class="lg:flex mt-2">
      	<!-- Column -->
        <div class="lg:flex-1 lg:flex justify-center">
          <div class="mb-4">
            <label for="first_name" class="block text-gray-800 text-md font-bold mb-2">Prenom:</label>
            <input type="text" id="first_name" name="first_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline">
          </div>
        </div>
        <!-- Column -->
        <div class="lg:flex-1 lg:flex justify-center">
          <div class="mb-4">
            <label for="last_name" class="block text-gray-800 text-md font-bold mb-2">Nom:</label>
            <input type="text" id="last_name" name="last_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline">
          </div>
        </div>
      </div>
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
      <!-- Row -->
      <div class="lg:flex justify-center mt-2">
      	<div>
      		<label for="password_confirmation" class="block font-bold mb-2 text-md text-gray-800">Confirmer le mot de passe: </label>
      		<input name="password_confirmation" id="password_confirmation" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline">
      	</div>
      </div>
      <!-- Row -->
      <div class="flex justify-center gap-2 mt-5">
        <button type="submit" name="submitted" id="sub" class="bg-blue-500 hover:bg-blue-600 text-white transition duration-200 ease-in-out font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue active:bg-gray-600">
          S'inscrire
        </button>

        <button type="button" onclick="ClearForm()" class="bg-red-500 hover:bg-red-600 text-white transition duration-200 ease-in-out font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue active:bg-gray-600">Annuler</button>
      </div>
    </form>
    </div>
  </section>

  <footer class="bottom-0 w-full py-5 text-center">
    <div class="container mx-auto">
        <p class="text-gray-600">
            Copyright &copy; <script>document.write(new Date().getFullYear())</script> MedIsm
        </p>
    </div>
  </footer>


<?php 
include('bdd.php');

if (isset($_SESSION['success']))
{
  unset($_SESSION['success']);
}
  	if(isset($_POST['submitted'])){
  		try
  		{
  			$first_name = $_POST['first_name'];
  			$last_name = $_POST['last_name'];
  			$email = $_POST['email'];
  			$password = $_POST['password'];
        $type = 1;

        $sql = "SELECT * FROM users";
        $stmt = $pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $existant = false;
        foreach($result as $res)
        {
          if ($email == $res['email']){
            $existant = true;
          }
        }

        //If else pour verifier si l'utilisateur y est
        if ($existant == true)
        {
          echo "<script>alert('Cet email existe déjà');</script>";
        }
        else 
        {
          $sql = "INSERT INTO users (first_name, last_name, type, email, password) VALUES (:first_name, :last_name, :type, :email, :password)";
          $stmt = $pdo->prepare($sql);

          $stmt->bindParam(':first_name', $first_name);
          $stmt->bindParam(':last_name', $last_name);
          $stmt->bindParam(':type', $type);
          $stmt->bindParam(':email', $email);
          $stmt->bindParam(':password', $password);


          $stmt->execute();
          
          
          $_SESSION['success'] = true;

          echo '<script>window.location.href = "index.php"</script>;';
          exit();

        }
  		}
  		catch (PDOException $e)
  		{
  			echo "Connection failed" . $e->getMessage();
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
  

 //Mot de passe verification
 	function VerifMdp(){
	 	const password = document.getElementById('password')
	 	const password_confirmation = document.getElementById('password_confirmation')
		if (password.value != password_confirmation.value){
			alert('Les mots de passe ne correspondent pas')
			return false
		}
		if (password.value == ''){
			alert('Veuillez saisir le mot de passe')
			return false
		}
		if (password_confirmation.value == ''){
			alert('Veuillez saisir le mot de passe de confirmation')
			return false
		}
 	}
	

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