
<section id="section-gauche">
			
	<article class="article-un">
				
		<form method="POST">

			<div class="flex-dir-col">
			    <input class="marg-top-none input" type="text" name="mot" id="mot" placeholder="Mot">       
			    <input class="input" type="text" name="definition" id="definition" placeholder="Definition">
			    <input class="input" type="text" name="exemple" id="exemple" placeholder="Exemple">

			    <input class="input-submit" type="submit" name="ajouter" id="ajouter-mot-fr" value="Ajouter">
			    <p class="none message-erreur erreur"></p>
			</div>

		</form>

	</article>

	<article class="article-deux">

		<?php

		// PAGINATION

		if (!empty($_GET['p']))
		{
			$getP = $_GET['p'];
		}

		else
		{
			$getP = 1;
		}

		if (!isset($_GET['contenu']))
		{
			$completer = "N";

			$compterMot = $dbh->prepare('SELECT COUNT(*) AS count FROM mot_fr WHERE utilisateur_id = :id AND completer = :completer');
			$compterMot->bindValue('id', $utilisateurId);
			$compterMot->bindValue('completer', $completer);
			$compterMot->execute();

			if ($compterMot->rowCount() > 0)
			{
				$nombreDeMot = $compterMot->fetch();
			}

			$motParPage = 5;
			$nombreDePage = ceil($nombreDeMot['count'] / $motParPage);

			// POUR LE LIMIT

			$debut = ($getP -1) * $motParPage;

			// POUR REDIRIGER SI HORS VALEUR DU $_GET['P']
			// LAISSER COMME CA, AUTREMENT ON A UNE ERREUR SUR LA PAGE SANS ELEMENT

			$prendreMotFR = $dbh->prepare('SELECT * FROM mot_fr ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
			$prendreMotFR->setFetchMode(PDO::FETCH_ASSOC);
			$prendreMotFR->execute();

			$motFRInfo = $prendreMotFR->fetchAll();

			if (count($motFRInfo) == 0)
			{
				 header('Location: mot?mot=fr&p=1');
			}
		}

		else if (isset($_GET['contenu']) && $_GET['contenu'] == "favoris")
		{
			$favoris = "Y";
			$completerN = "N";

			$compterMot = $dbh->prepare('SELECT COUNT(*) AS count FROM mot_fr WHERE utilisateur_id = :id AND favoris = :favoris AND completer = :completer');
			$compterMot->bindValue('id', $utilisateurId);
			$compterMot->bindValue('favoris', $favoris);
			$compterMot->bindValue('completer', $completerN);
			$compterMot->execute();

			if ($compterMot->rowCount() > 0)
			{
				$nombreDeMot = $compterMot->fetch();
			}

			$motParPage = 5;
			$nombreDePage = ceil($nombreDeMot['count'] / $motParPage);

			// POUR LE LIMIT

			$debut = ($getP -1) * $motParPage;

			// POUR REDIRIGER SI HORS VALEUR DU $_GET['P']
			// LAISSER COMME CA, AUTREMENT ON A UNE ERREUR SUR LA PAGE SANS ELEMENT

			$prendreMotFR = $dbh->prepare('SELECT * FROM mot_fr ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
			$prendreMotFR->setFetchMode(PDO::FETCH_ASSOC);
			$prendreMotFR->execute();

			$motFRInfo = $prendreMotFR->fetchAll();

			if (count($motFRInfo) == 0)
			{
				header('Location: mot?mot=fr&contenu=favoris&p=1');
			}	    	
		}

		?>

		<div>

			<h2 class="h">Actuellement sur :

			<?php

			// MOT FR MENU : CONTENU ACTUEL

			if (isset($_GET['mot']) && isset($_GET['contenu']))
			{
				echo $_GET['contenu'];
			}

			else if (isset($_GET['mot']))
			{
				?>

				accueil

				<?php
			}			    	

			?> </h2>

		</div>

		<div class="flex marg-top">

			<?php

			// MOT FR MENU : CONTENU

			if (isset($_GET['mot']) && $_GET['mot'] == "fr" && !isset($_GET['contenu']))
			{
				?>

				<a class="page-actuelle a-menu">Accueil</a>

				<?php
			}

			else
			{
				?>

			    <a class="page-non-actuelle a-menu" href="mot?mot=fr&p=1">Accueil</a>

				<?php
			}

			if (isset($_GET['contenu']) && $_GET['contenu'] == "favoris")
			{
				?>

				<a class="page-actuelle a-menu">Favoris</a>

				<?php
			}

			else
			{
				?>

			    <a class="page-non-actuelle a-menu" href="mot?mot=fr&contenu=favoris&p=1">Favoris</a>

				<?php
			}

			?>

		</div>		    

		<div class="flex">

			<?php

			// MOT FR MENU : PAGE

			for ($compteur = 1; $compteur <= $nombreDePage; $compteur++)
			{ 
				if ($getP != $compteur)
				{
					if (!isset($_GET['contenu']))
					{
						?>

						<a class="page-non-actuelle a-page marg-top" href="mot?mot=fr&p=<?php echo $compteur; ?>"><?php echo $compteur; ?></a>

						<?php
					}

					else if (isset($_GET['contenu']) && $_GET['contenu'] == "favoris")
					{
						?>

						<a class="page-non-actuelle a-page marg-top" href="mot?mot=fr&contenu=favoris&p=<?php echo $compteur; ?>"><?php echo $compteur; ?></a>

						<?php
					}
				}

				else
				{
					?>

					<a class="page-actuelle a-page marg-top"><?php echo $compteur; ?></a>

					<?php
				}
			}

			?>

		</div>

	</article>

</section>

<section id="section_droite">

	<?php

	if (!isset($_GET['contenu']))
	{
		$completer = "N";

		$prendreMotFR = $dbh->prepare('SELECT * FROM mot_fr WHERE utilisateur_id = :id AND completer = :completer ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
		$prendreMotFR->bindValue('id', $utilisateurId);
		$prendreMotFR->bindValue('completer', $completer);
		$prendreMotFR->execute();

	    if ($prendreMotFR->rowCount() > 0)
	    {
	        while ($motFRInfo = $prendreMotFR->fetch())
	        {
	        	$motFRId = htmlspecialchars($motFRInfo['id']);  				
	        	$motFRMot = htmlspecialchars($motFRInfo['mot']);  				
	        	$motFRDefinition = htmlspecialchars($motFRInfo['definition']);
	        	$motFRExemple = htmlspecialchars($motFRInfo['exemple']);

	        	$motFRFavoris = $motFRInfo['favoris'];

	        	if (!isset($_GET['modifier']) && !isset($_GET['id']))
	        	{
	        		?>

			        <div class="div-mot-boucle">

			          	<div class="flex-ali-center">

					      	<p class="title"><?= $motFRMot; ?></p>

					      	<?php 

					      	if ($motFRFavoris == "Y")
					      	{
					      		?>

					      		<a onclick="titleDesactiveFaFR(<?= $motFRId; ?>)"><i class="i favoris-actuelle fa-regular fa-star"></i></a>
					 					    
					 			<?php
					      	}

					      	else
					      	{
					      		?>

								 <a onclick="titleFaFR(<?= $motFRId; ?>)"><i class="i favoris-non-actuelle fa-regular fa-star"></i></a>

					      		<?php
					      	}

					      	?>

					    </div>

					    <p class="p-section"><?= $motFRDefinition; ?></p>
					    <p class="p-section"><?= $motFRExemple; ?></p>

						<div class="div-mot-boucle-a">

							<a class="mot-boucle-a"
								href="mot?mot=fr<?php if (isset($_GET['p'])) { echo "&p=" . $_GET['p']; } ?>&modifier=Y&id=<?php echo $motFRId; ?>">Modifier</a>

							<a class="mot-boucle-a" onclick="completerMotFR(<?= $motFRId; ?>)">Compléter</a>

							<a class="mot-boucle-corbeille" onclick="supprimerMotFR(<?= $motFRId; ?>)"><i class="fa-solid fa-trash"></i></a>

						</div>

			        </div>

	        		<?php
	        	}

	        	else if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['id']))
	        	{
					$getid = $_GET['id'];

					$prendreMotFR = $dbh->prepare('SELECT * FROM mot_fr WHERE id = :id');
					$prendreMotFR->bindValue('id', $getid);
					$prendreMotFR->execute();

					$motFRInfo = $prendreMotFR->fetch();

		        	$motFRId = $motFRInfo['id'];
		        	$motFRMot = $motFRInfo['mot'];  				
		        	$motFRDefinition = $motFRInfo['definition'];
		        	$motFRExemple = $motFRInfo['exemple'];

					?>

					<form class="form" method="POST">

						<div class="flex-dir-col-center">
							<input class="input" type="hidden" id="id-modifier-mot-fr" value="<?= $motFRId; ?>">
							<input class="input" type="text" id="mot-modifier-mot-fr" value="<?= $motFRMot; ?>">
							<input class="input" type="text" id="definition-modifier-mot-fr" value="<?= $motFRDefinition; ?>">
							<input class="input" type="text" id="exemple-modifier-mot-fr" value="<?= $motFRExemple; ?>">

							<input class="input-submit" type="submit" name="modifier" id="modifier-mot-fr" value="Modifier">
						</div>

					</form>

					<?php
	        	}
	        }
	    }
    }

	else if (isset($_GET['contenu']) && $_GET['contenu'] == "favoris")
	{
		$favoris = "Y";
		$completer = "N";

		$prendreMotFR = $dbh->prepare('SELECT * FROM mot_fr WHERE utilisateur_id = :id AND favoris = :favoris AND completer = :completer ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
		$prendreMotFR->bindValue('id', $utilisateurId);
		$prendreMotFR->bindValue('favoris', $favoris);			        
		$prendreMotFR->bindValue('completer', $completer);			        
		$prendreMotFR->execute();

	    if ($prendreMotFR->rowCount() > 0)
	    {
	        while ($motFRInfo = $prendreMotFR->fetch())
	        {
	        	$motFRId = htmlspecialchars($motFRInfo['id']);  				
	        	$motFRMot = htmlspecialchars($motFRInfo['mot']);  				
	        	$motFRDefinition = htmlspecialchars($motFRInfo['definition']);
	        	$motFRExemple = htmlspecialchars($motFRInfo['exemple']);

	        	$motFRFavoris = $motFRInfo['favoris'];

	        	if (!isset($_GET['modifier']) && !isset($_GET['id']))
	        	{
	        		?>

			        <div class="div-mot-boucle">

			          	<div class="flex-ali-center">

					      	<p class="title"><?= $motFRMot; ?></p>

					      	<?php 

					      	if ($motFRFavoris == "Y")
					      	{
					      		?>

					      		<a onclick="titleDesactiveFaFR(<?= $motFRId; ?>)"><i class="i favoris-actuelle fa-regular fa-star"></i></a>
					 					    
					 			<?php
					      	}

					      	else
					      	{
					      		?>

								<a onclick="titleFaFR(<?= $motFRId; ?>)"><i class="i favoris-non-actuelle fa-regular fa-star"></i></a>

					      		<?php
					      	}

					      	?>

					    </div>

					    <p class="p-section"><?= $motFRDefinition; ?></p>
					    <p class="p-section"><?= $motFRExemple; ?></p>

						<div class="div-mot-boucle-a">

							<a class="mot-boucle-a"
								href="mot?mot=fr&contenu=favoris<?php if (isset($_GET['p'])) { echo "&p=" . $_GET['p']; } ?>&modifier=Y&id=<?php echo $motFRId; ?>">Modifier</a>

							<a class="mot-boucle-a" onclick="completerMotFR(<?= $motFRId; ?>)">Compléter</a>

							<a class="mot-boucle-corbeille" onclick="supprimerMotFR(<?= $motFRId; ?>)"><i class="fa-solid fa-trash"></i></a>

						</div>

			        </div>

	        		<?php
	        	}

	        	else if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['id']))
	        	{
					$getid = $_GET['id'];

					$prendreMotFR = $dbh->prepare('SELECT * FROM mot_fr WHERE id = :id');
					$prendreMotFR->bindValue('id', $getid);
					$prendreMotFR->execute();

					$motFRInfo = $prendreMotFR->fetch();

		        	$motFRId = $motFRInfo['id'];  				
		        	$motFRMot = $motFRInfo['mot'];  				
		        	$motFRDefinition = $motFRInfo['definition'];
		        	$motFRExemple = $motFRInfo['exemple'];

					?>

					<form class="form" method="POST">

						<div class="flex-dir-col-center">
							<input class="input" type="hidden" id="id-modifier-mot-fr" value="<?= $motFRId; ?>">
							<input class="input" type="text" id="mot-modifier-mot-fr" value="<?= $motFRMot; ?>">
							<input class="input" type="text" id="definition-modifier-mot-fr" value="<?= $motFRDefinition; ?>">
							<input class="input" type="text" id="exemple-modifier-mot-fr" value="<?= $motFRExemple; ?>">

							<input class="input-submit" type="submit" name="modifier" id="modifier-mot-fr-favoris" value="Modifier">
						</div>

					</form>

					<?php
	        	}
	        }
	    }
	}

	?>
			
</section>
