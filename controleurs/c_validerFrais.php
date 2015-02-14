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
            $lesMois = $pdo->dernierMoisCloture($idVisiteur);
                var_dump($lesMois);
                $lesVisiteurs = $pdo->getVisiteur();
                include 'vues/v_listeVisiteurs.php';
                
                break;
            }

        case 'selectionnerMois': {

                $lesMois = $pdo->dernierMoisCloture($idVisiteur);
                if($lesMois == null){
                    ajouterErreur("Pas de fiche de frais pour ce visiteur ce mois");
                    include("vues/v_erreurs.php");
                    //echo '<meta http-equiv="Refresh" content="timer;url=Prod/gsbMVC/index.php?uc=validerFrais&action=selectionnerVisiteur">';
                    //header('Location: index.php?uc=validerFrais&action=selectionnerVisiteur'); 
                }else{
                                    var_dump($lesMois);

                include 'vues/v_listeVisiteurs_mois.php';
                }

                break;
            }

        case 'validerMajFraisForfaitComptable': {
            
            include('vues/v_validerFiche.php');
            
                include ("vues/v_ficheVisiteur.php");  

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
            
            
        case 'supprimerFraisComptable': {
            $idVisiteur = $_SESSION['visitor'];
                $mois = $_SESSION['moa'];
                $idFrais = $_REQUEST['idFrais'];
                $tailleLibelle = $_REQUEST['tailleLibelle'];
                $debutLibelle = $_REQUEST['debutLibelle'];
                if(strcmp($debutLibelle,'REFUSE')){
                    if($tailleLibelle + 7 > 100){
                        $pdo->refuserFraisHorsForfaitTronque($idFrais);
                    }else{
                        $pdo->refuserFraisHorsForfait($idFrais);
                    }
                }
                else{
                    ajouterErreur("Le Frais a déjà été refusé");
                    include("vues/v_erreurs.php");
                }
                break;
            }
        
        case 'reporterFraisComptable': {
            $idVisiteur = $_SESSION['visitor'];
                $mois = $_SESSION['moa'];
                $moisProchain = ajouterMois($mois);
                
                $idFrais = $_REQUEST['idFrais'];
                $libelle = $_REQUEST['libelle'];
			$date = $_REQUEST['date'];
			$montant=$_REQUEST['montant'];

               
                    $pdo->supprimerFraisHorsForfait($idFrais); 
                    if($pdo->estPremierFraisMois($idVisiteur,$moisProchain)){
                        $pdo->creeNouvellesLignesFrais($idVisiteur,$moisProchain);
                        $pdo->creeNouveauFraisHorsForfait($idVisiteur,$moisProchain,$libelle,$date,$montant);
                    }else{
                        $pdo->creeNouveauFraisHorsForfait($idVisiteur,$moisProchain,$libelle,$date,$montant); 
                    }
                
                
                break;
            }
            
        case 'validerFiche': {
                $idVisiteur = $_SESSION['visitor'];
                $mois = $_SESSION['moa'];
                var_dump($idVisiteur);
                var_dump($mois);
                $pdo->majEtatFicheFrais($idVisiteur,$mois,'VA');
                
            
            
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