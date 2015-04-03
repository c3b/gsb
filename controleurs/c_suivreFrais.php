<?php
if (($_SESSION['poste']) == 'comptable'){
include("vues/v_sommaire_comptable.php");
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_ENCODED);
switch ($action) {

    case 'SelectionnerMois': {
        $fichesDispo = $pdo->getLesFichesDisponiblesSuivi();
        $lesCles = array_keys( $fichesDispo );
        $moisASelectionner = $lesCles[0];
        include ("vues/v_listeFichesDispo.php");
        
        break;
    }
    
    case 'suivreFiches': {
        $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_NUMBER_INT);
        $fichesDispo = $pdo->getLesFichesDisponiblesSuivi();
        $moisASelectionner = $mois;
        $listeFiches = $pdo->getLesFichesFraisSuivi($mois);

        include ("vues/v_listeFichesDispo.php");
        include ("vues/v_suiviFichesFrais.php");

        break;
    }

    case 'passerEnRembourse': {
        if(isset($_POST['idVisiteur'])){
            $idVisiteur = filter_input(INPUT_POST, 'idVisiteur', FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if(isset($_POST['moisConcerne'])){
            $mois = filter_input(INPUT_POST, 'moisConcerne', FILTER_SANITIZE_NUMBER_INT);
        }
        $etat = 'RB';
        $pdo->majEtatFicheFrais($idVisiteur,$mois,$etat);
        ajouterValideOk("La fiche est passée en remboursée");
        include("vues/v_valideOk.php");

        $listeFiches = $pdo->getLesFichesFraisSuivi($mois);
        $fichesDispo = $pdo->getLesFichesDisponiblesSuivi();
        $moisASelectionner = $mois;
        include 'vues/v_listeFichesDispo.php';
        include 'vues/v_suiviFichesfrais.php';

        break;
    }
    
    case 'voirDetail': {
        if(isset($_POST['moisConcerne'])){
            $leMois = filter_input(INPUT_POST, 'moisConcerne', FILTER_SANITIZE_NUMBER_INT);
        }
        if(isset($_POST['idVisiteur'])){
            $idVisiteur = filter_input(INPUT_POST, 'idVisiteur', FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if(isset($_POST['nomVisiteur'])){
           $nomVisiteur = filter_input(INPUT_POST, 'nomVisiteur', FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if(isset($_POST['prenomVisiteur'])){
           $prenomVisiteur = filter_input(INPUT_POST, 'prenomVisiteur', FILTER_SANITIZE_SPECIAL_CHARS);
        }

        $lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
        $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);
        $numAnnee =substr( $leMois,0,4);
        $numMois =substr( $leMois,4,2);
        $libEtat = $lesInfosFicheFrais['libEtat'];
        $montantValide = $lesInfosFicheFrais['montantValide'];
        $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
        $dateModif =  dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
        include("vues/v_etatFraisModal.php");

        //$pdo->majEtatFicheFrais($idVisiteur,$mois,$etat);
        $listeFiches = $pdo->getLesFichesFraisSuivi($leMois); // anciennement $mois
        $fichesDispo = $pdo->getLesFichesDisponiblesSuivi();
        $moisASelectionner = $leMois;
        include 'vues/v_listeFichesDispo.php';
        include 'vues/v_suiviFichesfrais.php';

        break;
    } 

}






}else{
    echo 'Vous n\'êtes pas comptable !!';
}