<div class="message col-sm-4">
<div class="bg-danger text-danger text-center">
<?php 
foreach($_REQUEST['erreurs'] as $erreur)
	{
      echo $erreur;
	}
?>
</div>
</div>
