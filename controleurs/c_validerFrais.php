<?php

if (($_SESSION['poste']) == 'comptable') {
    include("vues/v_sommaire_comptable.php");
    $idComptable = $_SESSION['idVisiteur'];
    $moisActuel = getMois(date("d/m/Y"));
    $numAnnee = substr($moisActuel, 0, 4);
    $numMois = substr($moisActuel, 4, 2);
    $action = $_REQUEST['action'];

    if (isset($_REQUEST['choixVisit'])) {
        $idVisiteur = $_REQUEST['choixVisit'];
        $_SESSION['visitor'] = $idVisiteur;
    } else {
        $idVisiteur = "";
    }


    if (isset($_REQUEST['lstMois'])) {
        $mois = $_REQUEST['lstMois'];
        $_SESSION['moa'] = $mois;
    } else {
        $mois = "";
    }
    switch ($action) {

        case 'selectionnerVisiteur': {
                $lesVisiteurs = $pdo->getVisiteur();
                include 'vues/v_listeVisiteurs.php';
                break;
            }

        case 'selectionnerMois': {

                $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);

                include 'vues/v_listeVisiteurs_mois.php';
                break;
            }

        case 'validerMajFraisForfaitComptable': {
                if (isset($_REQUEST['lesFrais'])) {
                    $lesFrais = $_REQUEST['lesFrais'];
                    ajouterValideOk("Le changement des frais a été validé");
                            include("vues/v_valideOk.php");
                    
                } else {
                    $lesFrais = array();
                }
                //suppresion des valeurs vides pour eviter fatal error (ajout seb)
                $lesFrais = array_filter($lesFrais);
                $idVisiteur = $_SESSION['visitor'];
                $mois = $_SESSION['moa'];

                if (lesQteFraisValides($lesFrais)) {
                    $pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
                    
                            
                } else {
                    ajouterErreur("Les valeurs des frais doivent être numériques");
                    include("vues/v_erreurs.php");
                }
                break;
            }
            
        case 'validerCreationFrais': {
                $dateFrais = $_REQUEST['dateFrais'];
                $libelle = $_REQUEST['libelle'];
                $montant = $_REQUEST['montant'];
                valideInfosFrais($dateFrais, $libelle, $montant);
                if (nbErreurs() != 0) {
                    include("vues/v_erreurs.php");
                } else {
                    $pdo->creeNouveauFraisHorsForfait($idVisiteur, $mois, $libelle, $dateFrais, $montant);
                }
                break;
            }
            
        case 'supprimerFraisComptable': {
                $idFrais = $_REQUEST['idFrais'];
                $pdo->supprimerFraisHorsForfait($idFrais);
                break;
            }
    }
    
    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
    $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);

    if ($idVisiteur != NULL && $mois != NULL) {
        include("vues/v_listeFraisForfait_comptable.php");
        include("vues/v_listeFraisHorsForfait_comptable.php");
    }
} else {
    echo 'Vous n\'etes pas visiteur médical!!';
}