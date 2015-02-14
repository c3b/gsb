<div id="contenu">
    <h2>Sélectionner un Visiteur Médical et un date</h2>


<form action="index.php?uc=validerFrais&action=validerMajFraisForfaitComptable" method="post">
        <div class="corpsForm">
            
            
  
           <?php //if($idVisiteur != NULL): ?>
            <p> <!-- choix de la date de la fiche du visiteur -->

                <label for="lstMois" accesskey="n">Mois : </label>
                <select id="lstMois" name="lstMois">
                    <?php var_dump($lesMois);var_dump($dernierMoisCloture); ?>
                    <?php  //foreach ($lesMois as $unMois): ?>
                    <option <?php //if($_REQUEST['lstMois'] == $unMois['mois']){ echo "selected";} ?>value="<?php echo $lesMois ?>"><?php echo reverseDate($lesMois);
                        //echo '/';
                        //echo $unMois['numAnnee'] ?>
                        </option>

                    <?php //endforeach; ?>

                </select>
             </p>
             <?php //endif; ?>
             
        </div>
        <div class="piedForm">
            <p>
                <input id="ok" type="submit" value="Valider" size="20" />
                <input id="annuler" type="reset" value="Effacer" size="20" />
            </p> 
          </div>

    </form>