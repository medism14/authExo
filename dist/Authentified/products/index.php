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
      Produit CRUD
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
              $sql = "SELECT id_produit, produits.designation as prod_designation,categorie.designation as cat_designation, prix , quantite, date_in, date_up from produits, categorie where produits.categorie = categorie.id_categorie";

              $stmt = $pdo->query($sql);

              $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

              foreach ($results as $res)
              {
              ?>
                <tr class="border-b border-gray-100 text-neutral-800 odd:border-green-200 odd:bg-green-200 even:border-blue-200 even:bg-blue-200">
                <!-- Designation -->
                <td class="op whitespace-nowrap border-r border-gray-800 px-6 py-4"><?php echo($res['prod_designation']) ?></td>
                <!-- Actions -->
                <td class="op whitespace-nowrap px-6 py-4 flex justify-center space-x-10 w-full">
                  <?php 
                  if ($_SESSION['type'] == 0)
                  {
                  ?> 
                  <!-- Button edit -->
                  <form method="POST" action="">
                    <button type="submit" name="edit<?php echo($res['id_produit']) ?>" id="edit<?php echo($res['id_produit']) ?>" class="op bg-orange-400 py-1 px-4 rounded-lg text-gray-100 hover:bg-orange-500 transition duration-200 ease-in"><i class="fas fa-edit"></i></button>
                  </form>
                  <?php } ?>
                    <!-- Button view -->
                  <form method="POST" action="">
                    <button type="button" id="view<?php echo($res['id_produit']) ?>" data-modal-target="defaultModal<?php echo($res['id_produit']) ?>" data-modal-toggle="defaultModal<?php echo($res['id_produit']) ?>" class="op bg-blue-500 py-1 px-4 rounded-lg text-gray-800 hover:bg-blue-600 transition duration-200 ease-in"><i class="fas fa-eye"></i></button>
                  </form>
                  <?php 
                  if ($_SESSION['type'] == 0)
                  {
                  ?> 
                    <!-- Button delete -->
                  <form method="POST" action="">
                    <button type="button" name="delete<?php echo($res['id_produit']) ?>" id="delete<?php echo($res['id_produit']) ?>" class="op cursor-pointer min-h-full bg-red-500 py-1 px-4 rounded-lg text-gray-100 hover:bg-red-600 transition duration-200 ease-in min-h-full"><i class="fas fa-trash-alt"></i></button>
                  </form>
                  <?php } ?>
                  <?php 
                    if ($res['quantite'] > 0){
                    ?>
                  <!-- Button panier -->
                  <form method="POST" action="">
                    <button type="button" name="panier<?php echo($res['id_produit']) ?>" id="panier<?php echo($res['id_produit']) ?>" class="op cursor-pointer min-h-full bg-violet-500 py-1 px-4 rounded-lg text-gray-100 hover:bg-violet-600 transition duration-200 ease-in-out min-h-full"><i class="fa fa-shopping-cart"></i></button>
                  </form>
                  <?php 
                    }else{
                  ?>
                  <form method="POST" action="">
                    <button type="button" class="op cursor-pointer min-h-full bg-violet-300 py-1 px-4 rounded-lg text-gray-100 hover:bg-violet-300 transition duration-200 ease-in-out min-h-full"><i class="fa fa-shopping-cart"></i></button>
                  </form>
                <?php } ?> 
                </td>
                  <!-- Main modal -->
                  <div id="defaultModal<?php echo($res['id_produit']); ?>" tabindex="-1" aria-hidden="true" class="flex justify-center items-center fixed z-50 top-0 p-4 md:inset-0 h-[calc(100%-1rem)] hidden">
                      <div class="relative w-full max-w-2xl">
                          <!-- Modal content -->
                          <div class="relative rounded-lg shadow bg-gray-900">
                              <!-- Modal header -->
                              <div class="flex items-start justify-between p-4 border-b rounded-t border-gray-600">
                                  <h3 class="text-xl font-semibold text-gray-100" id="header<?php echo($res['id_produit']); ?>">
                                      
                                  </h3>
                                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white" id="closeModal<?php echo($res['id_produit']); ?>">
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
                                      Designation : <span class="ml-1" id="designation<?php echo($res['id_produit']); ?>"></span>
                                    </div>
                                    <!-- Column -->
                                    <div class="w-full md:w-1/2 min-h-full flex justify-start items-center p-4 text-gray-100">
                                      Prix : <span class="ml-1" id="prix<?php echo ($res['id_produit']); ?>"></span>
                                    </div>
                                  </div>

                                  <!-- Row -->
                                  <div class="flex">
                                    <!-- Column -->
                                    <div class="w-full md:w-1/2 min-h-full flex justify-start items-center p-4 text-gray-100">
                                      Date arrivée : <span class="ml-1" id="date_in<?php echo($res['id_produit']); ?>"></span>
                                    </div>
                                    <!-- Column -->
                                    <div class="w-full md:w-1/2 min-h-full flex justify-start items-center p-4 text-gray-100">
                                      Date de depart : <span class="ml-1" id="date_up<?php echo($res['id_produit']); ?>"></span>
                                    </div>
                                  </div>

                                  <!-- Row -->
                                  <div class="flex">
                                    <!-- Column -->
                                    <div class="w-full min-h-full flex justify-start items-center p-4 text-gray-100">
                                      Categorie : <span class="ml-1" id="categorie<?php echo($res['id_produit']); ?>"></span>
                                    </div>
                                    <div class="w-full md:w-1/2 min-h-full flex justify-start items-center p-4 text-gray-100">
                                        Quantité : <span class="ml-1" id="quantite<?php echo($res['id_produit']); ?>"></span>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>

                    <!-- Panier modal -->
                  <div id="panierModal<?php echo($res['id_produit']); ?>" tabindex="-1" aria-hidden="true" class="flex justify-center items-center fixed z-50 top-0 p-4 md:inset-0 h-[calc(100%-1rem)] hidden">
                      <div class="relative w-full max-w-2xl">
                          <!-- Modal content -->
                          <div class="relative rounded-lg shadow bg-gray-900">
                              <!-- Modal header -->
                              <div class="flex items-start justify-between p-4 border-b rounded-t border-gray-600">
                                  <h3 class="text-xl font-semibold text-gray-100" id="headerPanier<?php echo($res['id_produit']) ?>">
                                      
                                  </h3>
                                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white" id="closeModalPanier<?php echo($res['id_produit']); ?>">
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
                                    <div class="w-full min-h-full flex justify-center items-center p-4 text-gray-100">
                                      Quantité :
                                        <select class="text-gray-900 text-center rounded-lg px-2 py-1 ml-2">
                                          <?php for ($i = 1; $i <= $res['quantite']; $i++){?>
                                            <option value="<?php echo $i ?>" <?php echo ($i == 0 ? 'selected' : ''); ?>><?php echo $i ?></option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="flex justify-center w-full">
                                    <div>
                                      <button id="confirmationPanier<?php echo $res['id_produit']; ?>" class="px-4 py-2 m-2 hover:bg-green-600 transition duration-300 bg-green-400 rounded-lg">Confirmer</button>
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

  </section>

  <!-- Code php pour le bouton edit -->
<?php 
foreach($results as $e)
{
    $id = $e['id_produit'];
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
    let defaultModal = document.getElementById('defaultModal'+r.id_produit);
    let btnView = document.getElementById('view'+r.id_produit);
    let closeModal = document.getElementById('closeModal'+r.id_produit);
    let header = document.getElementById('header'+r.id_produit)

    //Ouverture du modal view
    btnView.addEventListener('click', function () {
      defaultModal.classList.toggle('hidden');
      header.innerText = r.prod_designation;
      let ElementsOpa = document.querySelectorAll('.op');
      let designation = document.getElementById('designation' + r.id_produit);
      let prix = document.getElementById('prix' + r.id_produit);
      let quantite = document.getElementById('quantite' + r.id_produit);
      let date_in = document.getElementById('date_in' + r.id_produit);
      let date_up = document.getElementById('date_up' + r.id_produit);
      let categorie = document.getElementById('categorie' + r.id_produit);

      designation.innerHTML =  '<span class="underline font-bold">'+ r.prod_designation +'</span>';
      prix.innerHTML = '<span class="underline font-bold">'+ r.prix +'</span>';
      quantite.innerHTML = '<span class="underline font-bold">'+ r.quantite +'</span>';
      date_in.innerHTML = '<span class="underline font-bold">'+ r.date_in +'</span>';
      date_up.innerHTML = '<span class="underline font-bold">'+ r.date_up +'</span>';
      categorie.innerHTML = '<span class="underline font-bold">'+ r.cat_designation +'</span>';

      for (e of ElementsOpa)
      {
        e.classList.add('opacity-50');
      }
    });

    //Fermeture du modal
    closeModal.addEventListener('click', function () 
    {
      defaultModal.classList.toggle('hidden');
      ElementsOpa = document.querySelectorAll('.op');

      for (e of ElementsOpa)
      {
        e.classList.remove('opacity-50');
      }
    });
  }

//Ajouter panier
  for (let r of results)
  {
    //Recuperation des button
    let btnPanier = document.getElementById('panier' + r.id_produit); //Bouton ajout panier
    let panierModal = document.getElementById('panierModal' + r.id_produit); //Le modal
    let ElementsOpa = document.querySelectorAll('.op'); //Les éléments qui auront l'opacité
    let closeModalPanier = document.getElementById('closeModalPanier' + r.id_produit); //Fermeture modal
    let headerPanier = document.getElementById('headerPanier' + r.id_produit);
    let confirmationBtn = document.getElementById('confirmationPanier' + r.id_produit);

    headerPanier.innerHTML = r.prod_designation;

    //Verificatoin de l'etat du bouton car dès fois null
    if (btnPanier == null)
    {
      continue;
    }

    //Event du bouton panier
    btnPanier.addEventListener("click", () => 
    {
      panierModal.classList.toggle("hidden");
      for (e of ElementsOpa)
      {
        e.classList.add('opacity-50');
      }
      
    });

     //Fermeture du modal du panier
    closeModalPanier.addEventListener('click', function () {
      panierModal.classList.toggle('hidden');
      ElementsOpa = document.querySelectorAll('.op');

      for (e of ElementsOpa)
      {
        e.classList.remove('opacity-50');
      }
    });

    confirmationBtn.addEventListener('click', (event) => {
      let item = event.target.parentNode.parentNode.parentNode.querySelector('select').value;
      let quantite = parseInt(item);
      console.log(item, r.id_produit);
      window.location.href = `ajouterPanier.php?id=${r.id_produit}&quantite=${quantite}`;
    });

  }

//Delete
for (let r of results)
  {
  //Pour manipuler le modal
    let btnEdit = document.getElementById('delete'+r.id_produit);
    
    btnEdit.addEventListener('click', function () {
      if (confirm('Etes-vous sûr de vouloir supprimer la categorie ?')) 
      {
        window.location.href = 'delete.php?id=' + r.id_produit;
      }
    })
  }


</script>

</body>
</html>