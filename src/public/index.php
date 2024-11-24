<?php require_once '../php/init.php';
  include '../views/header.php';
  //$init = new Core;
  
?>


  
  <div class="content">
      <div class="search-box">
          <input type="search" placeholder="¿Qué buscas?"/>
          <a href="search-item.php"><button type="submit">Buscar</button></a>
      </div>

      <?php
      if (isset($_GET['error'])) {
          echo "<p style='color: red;'>Error: " . htmlspecialchars($_GET['error']) . "</p>";
      }
      if (isset($_GET['success'])) {
          echo "<p style='color: green;'>Success: " . htmlspecialchars($_GET['success']) . "</p>";
      }
      ?>
  </div>

  <script type="module" src="/JS/login.js"></script>


<?php include '../views/footer.php'; ?>