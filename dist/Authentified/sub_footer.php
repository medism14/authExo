<?php 
    if (isset($_SESSION['display_message'])){
?>
  <script>
document.addEventListener('DOMContentLoaded', function () {
  $(document).ready(function() {
      setTimeout(function() {
          $('#display_message').fadeOut('slow');
          fetch('../unsetDisplayMessage.php')
          .then(response => response.json())
          .catch(error => console.error('Error: ', error));
      }, 3000);
  });
}); 
</script>
<?php } ?>
<script>
    const categories = /categories/;
    const produits = /products/;
    const index = /Authentified\/index.php/;
    const currentHref = window.location.href;

    const categorieLink = document.getElementById('categorie');
    const produitsLink = document.getElementById('produits');
    const indexLink = document.getElementById('index');

    if (categories.test(currentHref))
    {
        categorieLink.classList.add('bg-yellow-600')
    }
    else if (produits.test(currentHref))
    {
        produitsLink.classList.add('bg-yellow-600')
    }
    else if (index.test(currentHref))
    {
        indexLink.classList.add('bg-yellow-600')
    }
  </script>
  <footer class="bottom-0 w-full py-5 text-center">
    <div class="container mx-auto">
        <p class="text-gray-600">
            Copyright &copy; <script>document.write(new Date().getFullYear())</script> MedIsm
        </p>
    </div>
  </footer>