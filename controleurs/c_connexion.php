<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch($action){
	case 'demandeConnexion':{
		include("vues/v_connexion.php");
		break;
	}
	case 'valideConnexion':{
		$login = $_REQUEST['login'];
		$mdp = $_REQUEST['mdp'];
		$visiteur = $pdo->getInfosVisiteur($login,$mdp);
                $comptable = $pdo->getInfosComptable($login,$mdp); //ajout
		if((!is_array( $visiteur)) && (!is_array($comptable))){
			ajouterErreur("Login ou mot de passe incorrect");
			include("vues/v_erreurs.php");
			include("vues/v_connexion.php");
		}elseif (is_array($visiteur)){
			$id = $visiteur['id'];
			$nom =  $visiteur['nom'];
			$prenom = $visiteur['prenom'];
                        $poste = 'visiteur';
                        connecter($id,$nom,$prenom,$poste);
			include("vues/v_sommaire.php");
                        // DEBUG echo 'visiteur'.print_r($visiteur);

                        //DEBUG echo 'comptable'.print_r($comptable);
                }else{
                        $id = $comptable['id'];
			$nom =  $comptable['nom'];
			$prenom = $comptable['prenom'];
                        $poste = 'comptable';
			connecter($id,$nom,$prenom,$poste);
                        include("vues/v_sommaire_comptable.php");
                        //DEBUG echo 'visiteur'.print_r($visiteur);

                        //DEBUG echo 'comptable'.print_r($comptable);

		}
		break;
	}
	default :{
		include("vues/v_connexion.php");
		break;
	}
}


?>