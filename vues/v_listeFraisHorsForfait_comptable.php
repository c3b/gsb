
<table class="listeLegere">
  	   <caption>Descriptif des éléments hors forfait
       </caption>
             <tr>
                <th class="date">Date</th>
		<th class="libelle">Libellé</th>  
                <th class="montant">Montant</th>  
                <th class="action">Refus</th>            
                <th class="action">Report</th>            
             </tr>
          
    <?php    
	    foreach( $lesFraisHorsForfait as $unFraisHorsForfait) 
		{
			$libelle = $unFraisHorsForfait['libelle'];
                        $tailleLibelle = strlen($libelle);
                        $debutLibelle = substr($libelle, 0, 6);
			$date = $unFraisHorsForfait['date'];
			$montant=$unFraisHorsForfait['montant'];
			$id = $unFraisHorsForfait['id'];
	?>		
            <tr>
                <td> <?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
                <td><a href="index.php?uc=validerFrais&action=supprimerFraisComptable&idFrais=<?php echo $id ?>&tailleLibelle=<?php echo $tailleLibelle ?>&debutLibelle=<?php echo $debutLibelle ?>" 
				onclick="return confirm('Voulez-vous vraiment refuser ce frais ?');">Refuser</a></td>
                <td><a href="index.php?uc=validerFrais&action=reporterFraisComptable&idFrais=<?php echo $id ?>&montant=<?php echo $montant ?>&date=<?php echo $date ?>&libelle=<?php echo $libelle ?>" 
				onclick="return confirm('Voulez-vous vraiment reporter ce frais ?');">Reporter</a></td>
                                
                                
             </tr>
	<?php		 
          
          }
	?>	  
                                          
    </table>
      <!--<form action="index.php?uc=gererFrais&action=validerCreationFrais" method="post">
      <div class="corpsForm">
         
          <fieldset>
            <legend>Nouvel élément hors forfait
            </legend>
            <p>
              <label for="txtDateHF">Date (jj/mm/aaaa): </label>
              <input type="text" id="txtDateHF" name="dateFrais" size="10" maxlength="10" value=""  />
            </p>
            <p>
              <label for="txtLibelleHF">Libellé</label>
              <input type="text" id="txtLibelleHF" name="libelle" size="70" maxlength="256" value="" />
            </p>
            <p>
              <label for="txtMontantHF">Montant : </label>
              <input type="text" id="txtMontantHF" name="montant" size="10" maxlength="10" value="" />
            </p>
          </fieldset>
      </div>
      <div class="piedForm">
      <p>
        <input id="ajouter" type="submit" value="Ajouter" size="20" />
        <input id="effacer" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
        
      </form> -->
  </div>
  

