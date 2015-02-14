
<div id="enteteFiche">
      <h2>Modifier la fiche de <?php echo substr(($_SESSION['moa']),4,2)."/". substr(($_SESSION['moa']),0,4) ." du visiteur ".$pdo->getNomPrenomVisiteur($idVisiteur)['nom']. ' ' .$pdo->getNomPrenomVisiteur($idVisiteur)['prenom']; ?></h2> 
     

   <?php
   $caca = $pdo->getLesInfosFicheFrais($_SESSION['visitor'],$_SESSION['moa']);
  
   $etatFiche = $caca['libEtat'];
   ?>

<h3><?php echo 'Etat fiche: '. $etatFiche ?></h3>

</div>
  