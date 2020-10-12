<div class="contentarea">
  <nav  id="nav">
    <ul>
      <li><a class="active" href="index.php">Accueil</a></li>
      <li><a href="<?php echo (isset($_SESSION['username'])) ? 'profile' : 'connexion';?>"><?php echo (isset($_SESSION['username'])) ? 'Profile' : 'Connexion';?></a></li>
      <li><a href="<?php echo (isset($_SESSION['username'])) ? 'controller/deco.php' : 'register';?>"><?php echo (isset($_SESSION['username'])) ? 'Deconnexion' : 'S\'inscrire';?></a></li>
      <li><a href="montage">montage</a></li>
      
    </ul>

    </nav>
</div>

