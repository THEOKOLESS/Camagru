<nav  id="nav">
<ul>
  <li><a class="active" href="index.php">Accueil</a></li>
  <li><a href="<?php echo (isset($_SESSION['username'])) ? 'profile.php' : 'connexion.php';?>"><?php echo (isset($_SESSION['username'])) ? 'Profile' : 'Connexion';?></a></li>
  <li><a href="<?php echo (isset($_SESSION['username'])) ? 'deco.php' : 'register.php';?>"><?php echo (isset($_SESSION['username'])) ? 'Deconnexion' : 'S\'inscrire';?></a></li>
  
</ul>

</nav>

