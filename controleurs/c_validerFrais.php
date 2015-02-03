<?php
if (($_SESSION['poste']) == 'comptable'){
include("vues/v_sommaire_comptable.php");
echo 'VALIDER FRAIS';

}else{
    echo 'vous n\'êtes pas comptable !!';
}
include("vues/v_listeVisiteurs.php");
include("vues/v_listeFraisForfait.php");
include("vues/v_listeFraisHorsForfait.php");


//choisir le visiteur et le mois:




switch($action){
	case 'selectionnerVisiteur':{
		$lesVisiteurs=$pdo->getVisiteur();
		include("vues/v_listeVisiteurs.php");
		break;
	}
	case 'voirEtatFrais':{
		$leMois = $_REQUEST['lstMois']; 
		$lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
		$moisASelectionner = $leMois;
		include("vues/v_listeMois.php");
		$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);
		$numAnnee =substr( $leMois,0,4);
		$numMois =substr( $leMois,4,2);
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montantValide = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		include("vues/v_etatFrais.php");
	}
}
?>