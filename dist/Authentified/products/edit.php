<?php include('../sub_header.php'); ?>

<?php 
  if (isset($_POST['submitted'])){
    $id = $_GET['id'];
    $designation = $_POST['designation'];
    $prix = $_POST['prix'];
    $date_in = $_POST['date_in'];
    $date_up = $_POST['date_up'];
    $categorie = $_POST['categorie'];

    $sql_designation = "UPDATE produits SET designation = :designation WHERE id_produit = :id";
    $stmt_designation = $pdo->prepare($sql_designation);
    $stmt_designation->bindParam('designation', $designation);
    $stmt_designation->bindParam('id', $id);
    $stmt_designation->execute();

    $sql_prix = "UPDATE produits SET prix = :prix WHERE id_produit = :id";
    $stmt_prix = $pdo->prepare($sql_prix);
    $stmt_prix->bindParam('prix', $prix);
    $stmt_prix->bindParam('id', $id);
    $stmt_prix->execute();

    $sql_date_in = "UPDATE produits SET date_in = :date_in WHERE id_produit = :id";
    $stmt_date_in = $pdo->prepare($sql_date_in);
    $stmt_date_in->bindParam('date_in', $date_in);
    $stmt_date_in->bindParam('id', $id);
    $stmt_date_in->execute();

    $sql_date_up = "UPDATE produits SET date_up = :date_up WHERE id_produit = :id";
    $stmt_date_up = $pdo->prepare($sql_date_up);
    $stmt_date_up->bindParam('date_up', $date_up);
    $stmt_date_up->bindParam('id', $id);
    $stmt_date_up->execute();

    $sql_categorie = "UPDATE produits SET categorie = :categorie WHERE id_produit = :id";
    $stmt_categorie = $pdo->prepare($sql_categorie);
    $stmt_categorie->bindParam('categorie', $categorie);
    $stmt_categorie->bindParam('id', $id);
    $stmt_categorie->execute();

/*    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':designation', $designation);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':prix', $prix);
    $stmt->bindParam(':date_in', $date_in);
    $stmt->bindParam(':date_out', $date_out);
    $stmt->bindParam(':categorie', $categorie);
    $stmt->execute();*/
    
    $_SESSION['display_message'] = '<span class="text-green-600 underline">La categorie a bien été modifiée</span>';
    header('location: index.php');
  }
?>

<div class="flex justify-center mt-2">
  <a href="index.php" class="py-2 px-4 bg-gray-400 text-gray-800 rounded-lg shadow font-bold hover:text-gray-100 transition duration-100 ease-in-out">Retour</a>
</div>
<?php 
  $id = $_GET['id'];
  $sql = "SELECT produits.designation as prod_designation, categorie.designation as cat_designation, prix, date_in, date_up, categorie, id_categorie, id_produit FROM produits, categorie WHERE id_produit = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam('id', $id);
  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_ASSOC);

?>

  <section class="justify-center w-full min-h-screen">
    <!-- Pour englober le div -->
    <div class="flex justify-center min-w-full mt-10">
      <div class="md:w-1/2 bg-blue-300 border-2 rounded-md py-5 px-3">
      <form method="POST" action="" id="form">
      <h2 class="text-center text-xl font-bold">Modification Produit</h2>

      <!-- Row -->
      <div class="lg:flex mt-4">
        <!-- Column -->
        <div class="lg:flex-1 lg:flex justify-center">
          <div class="mb-4">
            <label for="designation" class="block text-gray-800 text-md font-bold mb-2">Designation:</label>
            <input type="text" id="designation" name="designation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $result['prod_designation'] ?>">
          </div>
        </div>
        <div class="lg:flex-1 lg:flex justify-center">
          <div class="mb-4">
            <label for="prix" class="block text-gray-800 text-md font-bold mb-2">Prix</label>
            <input type="number" name="prix" id="prix" class="shadow appearance-none border rounded w-ful py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $result['prix'] ?>"> 
          </div>
        </div>
      </div>

      <!-- Row -->
      <div class="lg:flex mt-4">
        <!-- Column -->
        <div class="lg:flex-1 lg:flex justify-center">
          <div class="mb-4">
            <label for="date_in" class="block text-gray-800 text-md font-bold mb-2">Date d'arrivage:</label>
            <input type="datetime-local" id="date_in" name="date_in" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $result['date_in'] ?>">
          </div>
        </div>
        <div class="lg:flex-1 lg:flex justify-center">
          <div class="mb-4">
            <label for="date_up" class="block text-gray-800 text-md font-bold mb-2">Date de depart:</label>
            <input type="datetime-local" id="date_up" name="date_up" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $result['date_up'] ?>"> 
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
                    if ($res['id_categorie'] == $result['categorie'])
                    {
                      echo '<option value="'. $res['id_categorie'] .'" selected>'. $res['designation'] .'</option>';
                    }
                    else
                    {
                      echo '<option value="'. $res['id_categorie'] .'">'. $res['designation'] .'</option>';
                    }
                  }
                 ?>
            </select>
          </div>
        </div>
      </div>

      <div class="flex justify-center gap-2 mt-5">
        <button type="submit" name="submitted" class="bg-green-600 hover:bg-green-700 text-white transition duration-200 ease-in-out font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline-green active:bg-gray-700">
          Modifier
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