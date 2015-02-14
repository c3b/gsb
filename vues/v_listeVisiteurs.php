<div id="contenu">
    <h2>Sélectionner un Visiteur Médical et un date</h2>

    <form action="index.php?uc=validerFrais&action=selectionnerMois" method="post">
        <div class="corpsForm">
            <p> <!-- choix du visiteur par liste déroulante nom et prénom -->
                <label for="choixVisit" accesskey="cv">Choisir Visiteur : </label>
                <select id="choixVisit" name="choixVisit">
                    <?php foreach ($lesVisiteurs as $unVisiteur):?>
                    <option <?php //if(!empty($_REQUEST['choixVisit']) == $unVisiteur['id']){ echo "selected";} ?> value="<?php echo $unVisiteur['id'] ?>"><?php echo $unVisiteur['nom'];
                        echo ' ';
                        echo $unVisiteur['prenom'] ?>
                        </option>

                    <?php endforeach; ?>    
                </select>
            </p>
            

             
        </div>
        <div class="piedForm">
            <p>
                <input id="ok" type="submit" value="Valider" size="20" />
                <input id="annuler" type="reset" value="Effacer" size="20" />
            </p> 
          </div>

    </form>