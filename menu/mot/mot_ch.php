
<section id="section-gauche">
			
	<article class="article-un">
				
		<form method="POST">

			<div class="flex-dir-col">
			    <input class="marg-top-none input" type="text" name="mot" id="mot" placeholder="Mot">          
			    <input class="input" type="text" name="traduction-fr" id="traduction-fr" placeholder="Traduction (FR)">
			    <input class="input" type="text" name="traduction-en" id="traduction-en" placeholder="Traduction (EN)">
			    <input class="input" type="text" name="exemple" id="exemple" placeholder="Exemple">

			    <input class="input-submit" type="submit" name="ajouter" id="ajouter-mot-ch" value="Ajouter">
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
			$completerN = "N";

			$compterMot = $dbh->prepare('SELECT COUNT(*) AS count FROM mot_ch WHERE utilisateur_id = :id AND completer = :completer');
			$compterMot->bindValue('id', $utilisateurId);
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

			$prendreMotCH = $dbh->prepare('SELECT * FROM mot_ch ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
			$prendreMotCH->setFetchMode(PDO::FETCH_ASSOC);
			$prendreMotCH->execute();

			$motCHInfo = $prendreMotCH->fetchAll();

			if (count($motCHInfo) == 0)
			{
			    header('Location: mot?mot=ch&p=1');
			}
		}

		else if (isset($_GET['contenu']) && $_GET['contenu'] == "favoris")
		{
			$favoris = "Y";
			$completerN = "N";

			$compterMot = $dbh->prepare('SELECT COUNT(*) AS count FROM mot_ch WHERE utilisateur_id = :id AND favoris = :favoris AND completer = :completer');
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

			$prendreMotCH = $dbh->prepare('SELECT * FROM mot_ch ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
			$prendreMotCH->setFetchMode(PDO::FETCH_ASSOC);
			$prendreMotCH->execute();

			$motCHInfo = $prendreMotCH->fetchAll();

			if (count($motCHInfo) == 0)
			{
				header('Location: mot?mot=ch&contenu=favoris&p=1');
			}	    	
		}			    

		?>

		<div>

			<h2 class="h">Actuellement sur :

			<?php

			// MOT CH MENU : CONTENU ACTUEL	

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

		    // MOT CH MENU : CONTENU

			if (isset($_GET['mot']) && $_GET['mot'] == "ch" && !isset($_GET['contenu']))
			{
				?>

				<a class="page-actuelle a-menu">Accueil</a>

				<?php
			}

			else
			{
				?>

		        <a class="page-non-actuelle a-menu" href="mot?mot=ch&p=1">Accueil</a>

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

		        <a class="page-non-actuelle a-menu" href="mot?mot=ch&contenu=favoris&p=1">Favoris</a>

				<?php
			}

		    ?>

		</div>		        

		<div class="flex">

			<?php

			// MOT CH MENU : PAGE

			for ($compteur = 1; $compteur <= $nombreDePage; $compteur++)
			{
				if ($getP != $compteur)
				{
					if (!isset($_GET['contenu']))
					{
						?>

						<a class="page-non-actuelle a-page marg-top" href="mot?mot=ch&p=<?php echo $compteur; ?>"><?php echo $compteur; ?></a>

						<?php
					}

					else if (isset($_GET['contenu']) && $_GET['contenu'] == "favoris")
					{
						?>

						<a class="page-non-actuelle a-page marg-top" href="mot?mot=ch&contenu=favoris&p=<?php echo $compteur; ?>"><?php echo $compteur; ?></a>

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
		$completerN = "N";

		$prendreMotCH = $dbh->prepare('SELECT * FROM mot_ch WHERE utilisateur_id = :id AND completer = :completer ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
		$prendreMotCH->bindValue('id', $utilisateurId);
		$prendreMotCH->bindValue('completer', $completerN);
		$prendreMotCH->execute();

	    if ($prendreMotCH->rowCount() > 0)
	    {
	        while ($motCHInfo = $prendreMotCH->fetch())
	        {
	        	$motCHId = htmlspecialchars($motCHInfo['id']);			
	        	$motCHMot = htmlspecialchars($motCHInfo['mot']);			
	        	$motCHTraductionFR = htmlspecialchars($motCHInfo['traductionFR']);
	        	$motCHTraductionEN = htmlspecialchars($motCHInfo['traductionEN']);
	        	$motCHExemple = htmlspecialchars($motCHInfo['exemple']);

	        	$motCHFavoris = $motCHInfo['favoris'];

	        	if (!isset($_GET['modifier']) && !isset($_GET['id']))
	        	{
	        		?>

			        <div class="div-mot-boucle">

			          	<div class="flex-ali-center">

					      	<p class="title"><?= $motCHMot; ?></p>

					      	<?php 

					      	if ($motCHFavoris == "Y")
					      	{
					      		?>

					      		<a onclick="titleDesactiveFaCH(<?= $motCHId; ?>)"><i class="i favoris-actuelle fa-regular fa-star"></i></a>
					 					    
					 			<?php
					      	}

					      	else
					      	{
					      		?>

								<a onclick="titleFaCH(<?= $motCHId; ?>)"><i class="i favoris-non-actuelle fa-regular fa-star"></i></a>

					      		<?php
					      	}

					      	?>

					   	</div>

					    <p class="p-section"><?= $motCHTraductionFR; ?></p>
					    <p class="p-section"><?= $motCHTraductionEN; ?></p>
					    <p class="p-section"><?= $motCHExemple; ?></p>

						<div class="div-mot-boucle-a">

							<a class="mot-boucle-a"
								href="mot?mot=ch<?php if (isset($_GET['p'])) { echo "&p=" . $_GET['p']; } ?>&modifier=Y&id=<?php echo $motCHId; ?>">Modifier</a>

							<a class="mot-boucle-a" onclick="completerMotCH(<?= $motCHId; ?>)" id="completer-mot-ch">Compléter</a>

							<a class="mot-boucle-corbeille" onclick="supprimerMotCH(<?= $motCHId; ?>)"><i class="fa-solid fa-trash"></i></a>

						</div>

			        </div>

	        		<?php
	        	}

	        	else if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['id']))
	        	{
					$getid = $_GET['id'];

					$prendreMotCH = $dbh->prepare('SELECT * FROM mot_ch WHERE id = :id');
					$prendreMotCH->bindValue('id', $getid);
					$prendreMotCH->execute();

					$motCHInfo = $prendreMotCH->fetch();

		        	$motCHId = $motCHInfo['id'];  				
		        	$motCHMot = $motCHInfo['mot'];  				
		        	$motCHTraductionFR = $motCHInfo['traductionFR'];
		        	$motCHTraductionEN = $motCHInfo['traductionEN'];
		        	$motCHExemple = $motCHInfo['exemple'];

					?>

					<form class="form" method="POST">

						<div class="flex-dir-col-center">
							<input class="input" type="hidden" id="id-modifier-mot-ch" value="<?= $motCHId; ?>">
							<input class="input" type="text" id="mot-modifier-mot-ch" value="<?= $motCHMot; ?>">
							<input class="input" type="text" id="traductionFR-modifier-mot-ch" value="<?= $motCHTraductionFR; ?>">
							<input class="input" type="text" id="traductionEN-modifier-mot-ch" value="<?= $motCHTraductionEN; ?>">
							<input class="input" type="text" id="exemple-modifier-mot-ch" value="<?= $motCHExemple; ?>">

							<input class="input-submit" type="submit" name="modifier" id="modifier-mot-ch" value="Modifier">
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
		$completerN = "N";

		$prendreMotCH = $dbh->prepare('SELECT * FROM mot_ch WHERE utilisateur_id = :id AND favoris = :favoris AND completer = :completer ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
		$prendreMotCH->bindValue('id', $utilisateurId);
		$prendreMotCH->bindValue('favoris', $favoris);			        
		$prendreMotCH->bindValue('completer', $completerN);			        
		$prendreMotCH->execute();

	    if ($prendreMotCH->rowCount() > 0)
	    {
	        while ($motCHInfo = $prendreMotCH->fetch())
	        {
	        	$motCHId = htmlspecialchars($motCHInfo['id']);			
	        	$motCHMot = htmlspecialchars($motCHInfo['mot']);			
	        	$motCHTraductionFR = htmlspecialchars($motCHInfo['traductionFR']);
	        	$motCHTraductionEN = htmlspecialchars($motCHInfo['traductionEN']);
	        	$motCHExemple = htmlspecialchars($motCHInfo['exemple']);

	        	$motCHFavoris = $motCHInfo['favoris'];

	        	if (!isset($_GET['modifier']) && !isset($_GET['id']))
	        	{
	        		?>

			        <div class="div-mot-boucle">

			          	<div class="flex-ali-center">

					      	<p class="title"><?= $motCHMot; ?></p>

					      	<?php 

					      	if ($motCHFavoris == "Y")
					      	{
					      		?>

					      		<a onclick="titleDesactiveFaCH(<?= $motCHId; ?>)"><i class="i favoris-actuelle fa-regular fa-star"></i></a>
					 					    
					 			<?php
					      	}

					      	else
					      	{
					      		?>

								 <a onclick="titleFaCH(<?= $motCHId; ?>)"><i class="i favoris-non-actuelle fa-regular fa-star"></i></a>

					      		<?php
					      	}

					      	?>

					    </div>

					    <p class="p-section"><?= $motCHTraductionFR; ?></p>
					    <p class="p-section"><?= $motCHTraductionEN; ?></p>
					    <p class="p-section"><?= $motCHExemple; ?></p>

						<div class="div-mot-boucle-a">

							<a class="mot-boucle-a"
								href="mot?mot=ch&contenu=favoris<?php if (isset($_GET['p'])) { echo "&p=" . $_GET['p']; } ?>&modifier=Y&id=<?php echo $motCHId; ?>">Modifier</a>

							<a class="mot-boucle-a" onclick="completerMotCH(<?= $motCHId; ?>)" id="completer-mot-ch">Compléter</a>

							<a class="mot-boucle-corbeille" onclick="supprimerMotCH(<?= $motCHId; ?>)"><i class="fa-solid fa-trash"></i></a>

						</div>

			        </div>

	        		<?php
	        	}

	        	else if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['id']))
	        	{
					$getid = $_GET['id'];

					$prendreMotCH = $dbh->prepare('SELECT * FROM mot_ch WHERE id = :id');
					$prendreMotCH->bindValue('id', $getid);
					$prendreMotCH->execute();

					$motCHInfo = $prendreMotCH->fetch();

		        	$motCHId = $motCHInfo['id'];  				
		        	$motCHMot = $motCHInfo['mot'];  				
		        	$motCHTraductionFR = $motCHInfo['traductionFR'];
		        	$motCHTraductionEN = $motCHInfo['traductionEN'];
		        	$motCHExemple = $motCHInfo['exemple'];

					?>

					<form class="form" method="POST">

						<div class="flex-dir-col-center">
							<input class="input" type="hidden" id="id-modifier-mot-ch" value="<?= $motCHId; ?>">
							<input class="input" type="text" id="mot-modifier-mot-ch" value="<?= $motCHMot; ?>">
							<input class="input" type="text" id="traductionFR-modifier-mot-ch" value="<?= $motCHTraductionFR; ?>">
							<input class="input" type="text" id="traductionEN-modifier-mot-ch" value="<?= $motCHTraductionEN; ?>">
							<input class="input" type="text" id="exemple-modifier-mot-ch" value="<?= $motCHExemple; ?>">

							<input class="input-submit" type="submit" name="modifier" id="modifier-mot-ch-favoris" value="Modifier">
						</div>		

					</form>

					<?php
				}
	        }
	    }
	}        		

	?>

</section>
