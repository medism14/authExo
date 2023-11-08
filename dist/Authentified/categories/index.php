<!-- Code php pour le bouton add -->
<?php 
  if(isset($_POST['add'])){
    header('location: add.php');
    die();
  }
?>
  <!--  -->
<?php include('../sub_header.php'); ?>
<!-- Section -->
  <section class="flex flex-col min-h-screen">
    <h1 class="text-3xl font-bold underline mt-10 text-center">
      Categorie CRUD
    </h1>

<!-- Code pour le tableau -->
    <div class="flex flex-col mt-5">
  <div class="overflow-x-auto flex justify-center">
    <div class="inline-block w-5/6 py-2 sm:px-6 lg:px-8">
      <div class="flex justify-end">
          <?php 
            if ($_SESSION['type'] == 0)
            { 
                  ?>
          <!-- button add -->
        <form method="POST" action="">
          <button type="submit" name="add" class="op bg-green-500 py-1 px-4 rounded-lg text-gray-100 hover:bg-green-600 transition duration-200 ease-in"><i class="fa-solid fa-plus fa-lg"></i></button>
        </form>
        <?php } ?>
      </div>
      <div class="overflow-hidden flex justify-center">
        <table class="w-full text-center text-sm font-light">
          <thead class="border-b font-medium border-neutral-500 op">
            <tr class="bg-slate-700">
              <th scope="col" class="px-6 py-4 text-gray-100">Designation</th>
              <th scope="col" class="px-6 py-4 text-gray-100 w-10">Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- ligne qui s'incremente -->
            <?php 
              $sql = "SELECT * from categorie";

              $stmt = $pdo->query($sql);

              $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

              foreach ($results as $res)
              {
                ?>
                  <tr class="border-b border-gray-100 text-neutral-800 odd:border-green-200 odd:bg-green-200 even:border-blue-200 even:bg-blue-200">
                <!-- Designation -->
                <td class="op whitespace-nowrap border-r border-gray-800 px-6 py-4"><?php echo($res['designation']) ?></td>
                <!-- Actions -->
                <td class="op whitespace-nowrap px-6 py-4 flex justify-center space-x-10 w-full">
                  <?php 
                  if ($_SESSION['type'] == 0)
                  {
                  ?>
                  <!-- Button edit -->
                  <form method="POST" action="">
                    <button type="submit" name="edit<?php echo($res['id_categorie']) ?>" id="edit<?php echo($res['id_categorie']) ?>" class="op bg-orange-400 py-1 px-4 rounded-lg text-gray-100 hover:bg-orange-500 transition duration-200 ease-in"><i class="fas fa-edit"></i></button>
                  </form>
                <?php } ?>
                    <!-- Button view -->
                  <form method="POST" action="">
                    <button type="button" id="view<?php echo($res['id_categorie']) ?>" data-modal-target="defaultModal<?php echo($res['id_categorie']) ?>" data-modal-toggle="defaultModal<?php echo($res['id_categorie']) ?>" class="op bg-blue-500 py-1 px-4 rounded-lg text-gray-800 hover:bg-blue-600 transition duration-200 ease-in"><i class="fas fa-eye"></i></button>
                  </form>
                  <?php 
                  if ($_SESSION['type'] == 0)
                  {
                  ?>
                    <!-- Button delete -->
                  <form method="POST" action="">
                    <button type="button" name="delete<?php echo($res['id_categorie']) ?>" id="delete<?php echo($res['id_categorie']) ?>" class="op cursor-pointer min-h-full bg-red-500 py-1 px-4 rounded-lg text-gray-100 hover:bg-red-600 transition duration-200 ease-in min-h-full"><i class="fas fa-trash-alt"></i></button>
                  </form>
                  <?php } ?>
                </td>
                  <!-- Main modal -->

                  <div id="defaultModal<?php echo($res['id_categorie']) ?>" tabindex="-1" aria-hidden="true" class="flex justify-center items-center fixed z-50 top-0 p-4 md:inset-0 h-[calc(100%-1rem)] hidden">
                      <div class="relative w-full max-w-2xl">
                          <!-- Modal content -->
                          <div class="relative text-gray-100 rounded-lg shadow bg-gray-900">
                              <!-- Modal header -->
                              <div class="flex items-start justify-between p-4 border-b rounded-t border-gray-600">
                                  <h3 class="text-xl font-semibold text-gray-900 text-white" id="header<?php echo($res['id_categorie']) ?>">
                                      
                                  </h3>
                                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white" id="closeModal<?php echo($res['id_categorie']) ?>">
                                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                      </svg>
                                      <span class="sr-only">Close modal</span>
                                  </button>
                              </div>
                              <!-- Modal body -->
                                  <!-- Row -->
                                  <div class="flex">
                                    <!-- Column -->
                                    <div class="w-full md:w-1/2 min-h-full flex justify-start items-center p-4 text-gray-100">
                                      Designation : <span class="ml-1" id="designation<?php echo($res['id_categorie']) ?>"></span>
                                    </div>
                                    <!-- Column -->
                                    <div class="w-full md:w-1/2 p-4 text-gray-100 produits flex items-center">
                                          <div class="flex-2 mr-5">Produits :</div>
                                          <div class="flex-1 ml-1" id="produits<?php echo($res['id_categorie']) ?>"></div>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </tr>
              <?php } ?>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<style>
  #defaultModal div
  {
    color : blue;
  }
</style>

  </section>

  <!-- Code php puor le bouton edit -->
<?php 
foreach($results as $e)
{
    $id = $e['id_categorie'];
    if(isset($_POST["edit$id"])){
        echo "<script>window.location.href = 'edit.php?id=$id';</script>";
        exit();
    }
}
?>

<?php include('../sub_footer.php'); ?>

<script>

  let results = <?php echo json_encode($results); ?>

//View
  for (let r of results)
  {
  //Pour manipuler le modal
    let defaultModal = document.getElementById('defaultModal'+r.id_categorie);
    let btnView = document.getElementById('view'+r.id_categorie);
    let closeModal = document.getElementById('closeModal'+r.id_categorie);
    let header = document.getElementById('header'+r.id_categorie)

    //Ouverture du modal
    btnView.addEventListener('click', function () {
      defaultModal.classList.toggle('hidden');
      header.innerText = r.designation;
      ElementsOpa = document.querySelectorAll('.op');
      let designation = document.getElementById('designation' + r.id_categorie);
      let produits = document.getElementById('produits' + r.id_categorie);
      let elemProduits = produits.querySelectorAll('span');

      elemProduits.forEach(function(element) {
          element.remove();
      });

      designation.innerHTML =  '<span class="underline font-bold">'+ r.designation +'</span>';;

      for (e of ElementsOpa)
      {
        e.classList.add('opacity-50');
      }

    fetch('view.php?fetch_id=' + r.id_categorie)
        .then(response => response.json())
        .then(data => {
          if (data.length === 0)
          {
            let span = document.createElement('span')
            span.classList.add('underline', 'font-bold');
            span.innerHTML = 'Aucun produit';
            produits.appendChild(span);
          }
          for (let product of data)
          {
            //New span
            let span = document.createElement('span')
            span.classList.add('underline', 'font-bold');
            span.innerHTML = product.designation + '</br>';
            produits.appendChild(span);
          }
        })
        .catch(error => console.error('Error:', error));

    })

    //Fermeture du modal
    closeModal.addEventListener('click', function () {
      defaultModal.classList.toggle('hidden');
      ElementsOpa = document.querySelectorAll('.op');

      for (e of ElementsOpa)
      {
        e.classList.remove('opacity-50');
      }
    });
  }

//Delete
for (let e of results)
  {
  //Pour manipuler le modal
    let btnEdit = document.getElementById('delete'+e.id_categorie);
    
    btnEdit.addEventListener('click', function () {
      if (confirm('Etes-vous sûr de vouloir supprimer la categorie ?')) 
      {
        window.location.href = 'delete.php?id=' + e.id_categorie;
      }
    })
  }


</script>

</body>
</html>