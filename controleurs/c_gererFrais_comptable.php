<?php
if (($_SESSION['poste']) == 'comptable'){
    include("vues/v_sommaire_comptable.php");
    $action = $_REQUEST['action'];
    $idComptable = $_SESSION['idComptable'];
    $idVisiteur = $_POST['choixVisit'];
    $nomVisit = $_POST['choixVisit'];
    $numMois = $_POST['lstMois'];

    switch($action){
        case 'selectionnerVisiteur':{
            $lesVisiteurs=$pdo->getVisiteur();
            $lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
            include 'vues/v_listeVisiteurs.php';
        }
        break;

        case 'saisirFrais':{
            if($pdo->estPremierFraisMois($idVisiteur,$mois)){
                $pdo->creeNouvellesLignesFrais($idVisiteur,$mois);
            }
            break;
        }

        case 'validerMajFraisForfaitComptable':{
            $lesFrais = $_REQUEST['lesFrais'];
            if(lesQteFraisValides($lesFrais)){
                $pdo->majFraisForfait($idVisiteur,$mois,$lesFrais);
            }else{
                ajouterErreur("Les valeurs des frais doivent être numériques");
                include("vues/v_erreurs.php");
            }
            break;
        }

        case 'validerCreationFraisComptable':{
            $dateFrais = $_REQUEST['dateFrais'];
            $libelle = $_REQUEST['libelle'];
            $montant = $_REQUEST['montant'];
            valideInfosFrais($dateFrais,$libelle,$montant);
            if (nbErreurs() != 0 ){
                include("vues/v_erreurs.php");
            }else{
                $pdo->creeNouveauFraisHorsForfait($idVisiteur,$mois,$libelle,$dateFrais,$montant);
            }
            break;
        }

        case 'supprimerFraisComptable':{
            $idFrais = $_REQUEST['idFrais'];
            $pdo->supprimerFraisHorsForfait($idFrais);
            break;
        }
    }

    $lesFraisForfait=$pdo->getLesFraisForfait($idVisiteur, $numMois);
    $lesFraisHorsForfait=$pdo->getLesFraisHorsForfait($idVisiteur, $numMois);
    include("vues/v_listeFraisForfait_comptable.php");
    include("vues/v_listeFraisHorsForfait_comptable.php");
    
}else{
    echo 'Vous n\'êtes pas visiteur médical !!';
}