<?php
// // Récupération des variables nécessaires à l'activation
$username = $_GET['log'];
$cle = $_GET['cle'];

$stmt = $db->prepare("SELECT cle, actif FROM users WHERE username LIKE :username");

if($stmt->execute(array(':username' => $username)) && $row = $stmt->fetch())
  {
    $clebdd = $row['cle'];    // Récupération de la clé
    $actif = $row['actif']; // $actif contiendra alors 0 ou 1
  }

  // On teste la valeur de la variable $actif récupérée dans la BDD
if($actif == '1') // Si le compte est déjà actif on prévient
{
   require('view/Validation/already_actif.php');
}
else // Si ce n'est pas le cas on passe aux comparaisons
{
   if($cle == $clebdd) // On compare nos deux clés    
     {
        // La requête qui va passer notre champ actif de 0 à 1
        $stmt = $db->prepare("UPDATE users SET actif = 1 WHERE username LIKE :username ");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
         // Si elles correspondent on active le compte !    
        require('view/Validation/validate_actif.php');
     }
   else // Si les deux clés sont différentes on provoque une erreur...
     {
        require('view/Validation/invalidation.php');
     }
}
?>
