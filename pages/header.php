<section class="app">
  <aside class="sidebar">
         <header>
           <a href="acceuil.php"><img src="../img/logo.png" alt="logo"></a>
      </header>
    <nav class="sidebar-nav">
 
      <ul>
        <li>
          <a href="#"><i class="fas fa-plus-circle"></i> <span>Ajouter</span></a>
          <ul class="nav-flyout">
            <li>
              <a href="ajoutEtudiant.php"><i class="fas fa-user-graduate"></i>Etudiant</a>
            </li>
            <li>
              <a href="ajoutApprenant.php"><i class="fas fa-bed"></i>Chambre</a>
            </li>
            <li>
              <a href="ajoutApprenant.php"><i class="far fa-building"></i>Batiment</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#"><i class="far fa-edit"></i> <span>Modifier</span></a>
          <ul class="nav-flyout">
          <li>
              <a href="ajoutPromo.php"><i class="fas fa-user-graduate"></i>Etudiant</a>
            </li>
            <li>
              <a href="ajoutApprenant.php"><i class="fas fa-bed"></i>Chambre</a>
            </li>
            <li>
              <a href="ajoutApprenant.php"><i class="far fa-building"></i>Batiment</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#"><i class="fas fa-list-ul"></i> <span>Lister</span></a>
          <ul class="nav-flyout">
          <li>
              <a href="ajoutPromo.php"><i class="fas fa-user-graduate"></i>Etudiant</a>
            </li>
            <li>
              <a href="ajoutApprenant.php"><i class="fas fa-bed"></i>Chambre</a>
            </li>
            <li>
              <a href="ajoutApprenant.php"><i class="far fa-building"></i>Batiment</a>
            </li>
          </ul>
        </li>
        
        <li>
          <a href="exclusion.php"><i class="fas fa-search"></i> <span class="">Rechercher Etudiant</span></a>
        </li>
        <?php 
        if($_SESSION['profil']=="Administrateur"){?>
          <li>
          <a href="#"><i class="fas fa-user"></i> <span>Users</span></a>
          <ul class="nav-flyout">
            <li>
              <a href="ajoutUser.php"><i class="fas fa-user-plus"></i>Ajouter</a>
            </li>
            <li>
              <a href="listeUser.php"><i class="fas fa-list-ul"></i>Lister</a>
            </li>
            <li>
              <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Deconnexion</a>
            </li>
          </ul>
        </li>
        <?php
        }
        else{ ?>
          <li>
              <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Deconnexion</a>
            </li><?php
        }
        ?>
        
      </ul>
    </nav>
  </aside>
</section>