    <div class="col-sm-6">
      <form class="form form-inline" role="form" action="index.php?uc=suivreFrais&action=suivreFiches" method="post">

	<div class="form-group"> 
        <label for="lstMois" accesskey="n">Mois à sélectionner : </label>
        <select class="form-control" id="lstMois" name="lstMois">
            <?php 
			foreach ($fichesDispo as $unMoisFiche)
			{
			    $mois = $unMoisFiche['mois'];
				$numAnnee =  $unMoisFiche['numAnnee'];
				$numMois =  $unMoisFiche['numMois'];
				if($mois == $moisASelectionner){
				?>
				<option selected value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
				<?php 
				}
				else{ ?>
				<option value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
				<?php 
				}
			
			}
           
		   ?>    
            
        </select>
        </div>
       <div class="form-group">
           <input class="form-control" id="ok" type="submit" value="Valider" size="20" />
      </div>    
      
        
      </form>
    </div>
    </div>