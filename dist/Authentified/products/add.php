<?php include('../sub_header.php'); ?>

<?php 
if(isset($_POST['submitted'])){

    $date_in = $_POST['date_in'];
    $date_up = $_POST['date_up'];
    $designation = $_POST['designation'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];
    $categorie = $_POST['categorie'];

    $sql = "INSERT INTO produits (date_in, date_up, designation, prix, quantite, categorie) VALUES (:date_in, :date_up, :designation, :prix, :quantite, :categorie)";
    $stmt = $pdo->prepare($sql);

    // Bind the parameters without colon
    $stmt->bindParam('date_in', $date_in);
    $stmt->bindParam('date_up', $date_up);
    $stmt->bindParam('designation', $designation, PDO::PARAM_STR);
    $stmt->bindParam('prix', $prix, PDO::PARAM_STR);
    $stmt->bindParam('quantite', $quantite);
    $stmt->bindParam('categorie', $categorie, PDO::PARAM_STR);

    $stmt->execute();

    $_SESSION['display_message'] = '<span class="text-green-600 underline">La produit a bien été ajouté</span>';

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
      <h2 class="text-center text-xl font-bold">Ajout Produit</h2>

      <!-- Row -->
      <div class="lg:flex mt-4">
        <!-- Column -->
        <div class="lg:flex-1 lg:flex justify-center">
          <div class="mb-4">
            <label for="designation" class="block text-gray-800 text-md font-bold mb-2">Designation:</label>
            <input type="text" id="designation" name="designation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline">
          </div>
        </div>
        <div class="lg:flex-1 lg:flex justify-center">
          <div class="mb-4">
            <label for="prix" class="block text-gray-800 text-md font-bold mb-2">Prix</label>
            <input type="number" name="prix" id="prix" class="shadow appearance-none border rounded w-ful py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"> 
          </div>
        </div>
      </div>

      <!-- Row -->
      <div class="lg:flex mt-4">
        <!-- Column -->
        <div class="lg:flex-1 lg:flex justify-center">
          <div class="mb-4">
            <label for="date_in" class="block text-gray-800 text-md font-bold mb-2">Date d'arrivage:</label>
            <input type="datetime-local" id="date_in" name="date_in" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline">
          </div>
        </div>
        <div class="lg:flex-1 lg:flex justify-center">
          <div class="mb-4">
            <label for="date_up" class="block text-gray-800 text-md font-bold mb-2">Date de depart:</label>
            <input type="datetime-local" id="date_up" name="date_up" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"> 
          </div>
        </div>
      </div>

      <!-- Row -->
      <div class="lg:flex mt-4">
        <!-- Column -->
        <div class="lg:flex-1 lg:flex justify-center">
          <div class="mb-4">
            <label for="categorie" class="block text-gray-800 text-md font-bold mb-2">Categorie:</label>
            <select id="categorie" name="categorie" class="shadow border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline">
                <?php
                  //J'affiche les categories
                  $sql = "SELECT * from categorie";
                  $stmt = $pdo->query($sql);
                  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($results as $res)
                  {
                    echo '<option value="'. $res['id_categorie'] .'">'. $res['designation'] .'</option>';
                  }
                 ?>
            </select>
          </div>
        </div>
        <div class="lg:flex-1 lg:flex justify-center">
          <div class="group">
            <label for="quantite" class="block text-gray-800 text-md font-bold mb-2">Quantité</label>
            <input type="number" id="quantite" name="quantite" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline">
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




<?php include('../sub_footer.php'); ?>


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