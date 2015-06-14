<div class="row">
    <div class="col-sm-12">
        <table class="table-hover table-striped milieu">
            <h4 class="text-warning"> Suivi des fiches de frais pour: <?php echo reverseDate($moisASelectionner) ?> </h4>
            <thead>
            <tr>

                <th >Nom visiteur</th>
                <th >Prénom visiteur</th>  
                <th >Montant total</th>  
                <th >Etat fiche</th>            
                <th >Mois concerné</th>            
                <th >Dernière modification</th>            
                <th >Rebourser</th> 
                <th >Détail</th>
            </tr>
            </thead>
            <?php
            foreach ($listeFiches as $uneFiche):
                $nomVisiteur = $uneFiche['nom'];
                $prenomVisiteur = $uneFiche['prenom'];
                $montant = $uneFiche['montantValide'];
                $etatFiche = $uneFiche['libEtat'];
                $moisConcerne = $uneFiche['leMois'];
                $derniereModif = $uneFiche['dateModif'];
                $idVisiteur = $uneFiche['idVisiteur'];
                ?>                    
                <form class="form-inline" role="form" method="post" action="index.php?uc=suivreFrais&action=passerEnRembourse">		
                    <tbody>
                    <tr>
                        <div class="form-group">
                        <input class="btn btn-md btn-default" type="hidden" name="idVisiteur" value="<?php echo $idVisiteur ?>" />
                        </div>
                        <td><?php echo $nomVisiteur ?></td>
                        <td><?php echo $prenomVisiteur ?></td>
                        <td><?php echo $montant ?></td>
                        <td><?php echo $etatFiche ?></td>
                        <td><input type="hidden" name="moisConcerne" value="<?php echo $moisConcerne ?>" /><?php echo reverseDate($moisConcerne) ?></td>
                        <td><?php echo $derniereModif ?></td>
                        <td>
                            <div class="form-group">
                            <input class="btn btn-md btn-success" type="submit" value="Rembourser" />
                            </div>
                        </td>
                </form>
                <form class="form-inline" role="form" method="POST" action="index.php?uc=suivreFrais&action=voirDetail">
                    <td>
                        <div class="form-group">
                            <input type="hidden" name="moisConcerne" value="<?php echo $moisConcerne ?>" />
                            <input type="hidden" name="idVisiteur" value="<?php echo $idVisiteur ?>" />
                            <input type="hidden" name="nomVisiteur" value="<?php echo $nomVisiteur ?>" />
                            <input type="hidden" name="prenomVisiteur" value="<?php echo $prenomVisiteur ?>" />
                            <input class="btn btn-md btn-info" type="submit" value="Détail"  />
                        </div>
                    </td> 
                </form>
                    </tr>
                    </tbody>
    </div> 
            <?php endforeach; ?>	  
        </table>
    </div>
</div>
