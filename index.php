<?php
session_start();
require_once("include/fct.inc.php");
require_once ("include/class.pdogsb.inc.php");
include("vues/v_entete.php") ; ?>
<script src ="js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src ="js/chainedList.js" type="text/javascript"></script>

<?php
$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();
//print_r($_SESSION); // DEBUG
if(!isset($_REQUEST['uc']) || !$estConnecte){
     $_REQUEST['uc'] = 'connexion';
}	 
$uc = $_REQUEST['uc'];


    
    switch($uc){
        case 'connexion':{
                include("controleurs/c_connexion.php");break;
        }
        case 'gererFrais' :{
                include("controleurs/c_gererFrais.php");break;
        }
        case 'etatFrais' :{
                include("controleurs/c_etatFrais.php");break; 
        }
        case 'validerFrais' :{
		include("controleurs/c_validerFrais.php");break; 
	}
        case 'suivreFrais' :{
		include("controleurs/c_suivreFrais.php");break; 
	}
    }

include("vues/v_pied.php") ;

?>

