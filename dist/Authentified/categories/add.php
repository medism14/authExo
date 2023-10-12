<?php include('../sub_header.php'); ?>

<?php 
  if(isset($_POST['submitted'])){
    $designation = $_POST['designation'];

    // Prepare the SQL statement with placeholders to avoid SQL injection
    $sql = "INSERT INTO categorie (designation) VALUES (:designation)";
    $stmt = $pdo->prepare($sql); // Corrected this line

    // Bind the parameter
    $stmt->bindParam(':designation', $designation, PDO::PARAM_STR);

    // Execute the SQL statement
    $stmt->execute();

    $_SESSION['display_message'] = '<span class="text-green-600 underline">La categorie a bien été ajoutée</span>';
    header('location: index.php');
    exit();
  }
?>

<div class="flex justify-center mt-2">
  <a href="index.php" class="py-2 px-4 bg-gray-400 text-gray-800 rounded-lg shadow font-bold hover:text-gray-100 transition duration-100 ease-in-out">Retour</a>
</div>
  <section class="justify-center w-full min-h-[74vh]">
    <!-- Pour englober le div -->
    <div class="flex justify-center min-w-full mt-10">
      <div class="md:w-1/2 bg-blue-300 border-2 rounded-md py-5 px-3">
      <form method="POST" action="" id="form">
      <h2 class="text-center text-xl font-bold">Ajout Catégorie</h2>
      <!-- Row -->
      <div class="lg:flex mt-4">
        <!-- Column -->
        <div class="lg:flex-1 lg:flex justify-center">
          <div class="mb-4">
            <label for="designation" class="block text-gray-800 text-md font-bold mb-2">Designation:</label>
            <input type="text" id="designation" name="designation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline" required>
          </div>
        </div>
      </div>
      <div class="flex justify-center gap-2 mt-5">
        <button type="submit" name="submitted" class="bg-green-600 hover:bg-green-700 text-white transition duration-200 ease-in-out font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline-green active:bg-gray-700">
          Ajouter
        </button>

        <button type="button" onclick="ClearForm()" class="bg-red-500 hover:bg-red-600 text-white transition duration-200 ease-in-out font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue active:bg-gray-600">Annuler</button>
      </div>
    </form>
    </div>
    </div>
  </section>



<?php include('../footer.php'); ?>


<script>
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