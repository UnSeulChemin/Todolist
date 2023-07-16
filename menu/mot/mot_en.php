
<section id="section-gauche">
			
	<article class="article-un">
				
		<form method="POST">

			<div class="flex-dir-col">
			    <input class="marg-top-none input" type="text" name="mot" id="mot" placeholder="Mot">          
			    <input class="input" type="text" name="traduction" id="traduction" placeholder="Traduction">
			    <input class="input" type="text" name="exemple" id="exemple" placeholder="Exemple">

			    <input class="input-submit" type="submit" name="ajouter" id="ajouter-mot-en" value="Ajouter">
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

			$compterMot = $dbh->prepare('SELECT COUNT(*) AS count FROM mot_en WHERE utilisateur_id = :id AND completer = :completer');
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

			$prendreMotEN = $dbh->prepare('SELECT * FROM mot_en ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
			$prendreMotEN->setFetchMode(PDO::FETCH_ASSOC);
			$prendreMotEN->execute();

			$motENInfo = $prendreMotEN->fetchAll();

			if (count($motENInfo) == 0)
			{
			    header('Location: mot?mot=en&p=1');
			}
		}

		else if (isset($_GET['contenu']) && $_GET['contenu'] == "favoris")
		{
			$favoris = "Y";
			$completerN = "N";

			$compterMot = $dbh->prepare('SELECT COUNT(*) AS count FROM mot_en WHERE utilisateur_id = :id AND favoris = :favoris AND completer = :completer');
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

			$prendreMotEN = $dbh->prepare('SELECT * FROM mot_en ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
			$prendreMotEN->setFetchMode(PDO::FETCH_ASSOC);
			$prendreMotEN->execute();

			$motENInfo = $prendreMotEN->fetchAll();

			if (count($motENInfo) == 0)
			{
				header('Location: mot?mot=en&contenu=favoris&p=1');
			}	    	
		}

		?>

		<div>

			<h2 class="h">Actuellement sur :

			<?php

			// MOT EN MENU : CONTENU ACTUEL

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

		    // MOT EN MENU : CONTENU

			if (isset($_GET['mot']) && $_GET['mot'] == "en" && !isset($_GET['contenu']))
			{
				?>

				<a class="page-actuelle a-menu">Accueil</a>

				<?php
			}

			else
			{
				?>

		        <a class="page-non-actuelle a-menu" href="mot?mot=en&p=1">Accueil</a>

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

		        <a class="page-non-actuelle a-menu" href="mot?mot=en&contenu=favoris&p=1">Favoris</a>

				<?php
			}

		    ?>

		</div>	

		<div class="flex">

			<?php

			// MOT EN MENU : PAGE

			for ($compteur = 1; $compteur <= $nombreDePage; $compteur++)
			{ 
				if ($getP != $compteur)
				{
					if (!isset($_GET['contenu']))
					{
						?>

						<a class="page-non-actuelle a-page marg-top" href="mot?mot=en&p=<?php echo $compteur; ?>"><?php echo $compteur; ?></a>

						<?php
					}

					else if (isset($_GET['contenu']) && $_GET['contenu'] == "favoris")
					{
						?>

						<a class="page-non-actuelle a-page marg-top" href="mot?mot=en&contenu=favoris&p=<?php echo $compteur; ?>"><?php echo $compteur; ?></a>

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

		$prendreMotEN = $dbh->prepare('SELECT * FROM mot_en WHERE utilisateur_id = :id AND completer = :completer ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
		$prendreMotEN->bindValue('id', $utilisateurId);
		$prendreMotEN->bindValue('completer', $completerN);
		$prendreMotEN->execute();			

	    if ($prendreMotEN->rowCount() > 0)
	    {
	    	while ($motENInfo = $prendreMotEN->fetch())
	    	{
	        	$motENId = htmlspecialchars($motENInfo['id']);
	        	$motENMot = htmlspecialchars($motENInfo['mot']);
	        	$motENTraduction = htmlspecialchars($motENInfo['traduction']);
	        	$motENExemple = htmlspecialchars($motENInfo['exemple']);

	        	$motENFavoris = $motENInfo['favoris'];

	        	if (!isset($_GET['modifier']) && !isset($_GET['id']))
	        	{
	        		?>

			        <div class="div-mot-boucle">

			          	<div class="flex-ali-center">

					      	<p class="title"><?= $motENMot; ?></p>

					      	<?php 

					      	if ($motENFavoris == "Y")
					      	{
					      		?>

					      		<a onclick="titleDesactiveFaEN(<?= $motENId; ?>)"><i class="i favoris-actuelle fa-regular fa-star"></i></a>
					 					    
					 			<?php
					      	}

					      	else
					      	{
					      		?>

								<a onclick="titleFaEN(<?= $motENId; ?>)"><i class="i favoris-non-actuelle fa-regular fa-star"></i></a>

					      		<?php
					      	}

					      	?>

					    </div>

					    <p class="p-section"><?= $motENTraduction; ?></p>
					    <p class="p-section"><?= $motENExemple; ?></p>

						<div class="div-mot-boucle-a">

							<a class="mot-boucle-a"
								href="mot?mot=en<?php if (isset($_GET['p'])) { echo "&p=" . $_GET['p']; } ?>&modifier=Y&id=<?php echo $motENId; ?>">Modifier</a>

							<a class="mot-boucle-a" onclick="completerMotEN(<?= $motENId; ?>)" id="completer-mot-en">Compléter</a>

							<a class="mot-boucle-corbeille" onclick="supprimerMotEN(<?= $motENId; ?>)"><i class="fa-solid fa-trash"></i></a>

						</div>

			        </div>

	        		<?php
	        	}

	        	else if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['id']))
	        	{
					$getid = $_GET['id'];

					$prendreMotEN = $dbh->prepare('SELECT * FROM mot_en WHERE id = :id');
					$prendreMotEN->bindValue('id', $getid);
					$prendreMotEN->execute();

					$motENInfo = $prendreMotEN->fetch();

		        	$motENId = $motENInfo['id'];	
		        	$motENMot = $motENInfo['mot'];
		        	$motENTraduction = $motENInfo['traduction'];
		        	$motENExemple = $motENInfo['exemple'];

					?>

					<form class="form" method="POST">

						<div class="flex-dir-col-center">
							<input class="input" type="hidden" id="id-modifier-mot-en" value="<?= $motENId; ?>">
							<input class="input" type="text" id="mot-modifier-mot-en" value="<?= $motENMot; ?>">
							<input class="input" type="text" id="traduction-modifier-mot-en" value="<?= $motENTraduction; ?>">
							<input class="input" type="text" id="exemple-modifier-mot-en" value="<?= $motENExemple; ?>">

							<input class="input-submit" type="submit" name="modifier" id="modifier-mot-en" value="Modifier">
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

		$prendreMotEN = $dbh->prepare('SELECT * FROM mot_en WHERE utilisateur_id = :id AND favoris = :favoris AND completer = :completer ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
		$prendreMotEN->bindValue('id', $utilisateurId);
		$prendreMotEN->bindValue('favoris', $favoris); 
		$prendreMotEN->bindValue('completer', $completerN);			        
		$prendreMotEN->execute();

		if ($prendreMotEN->rowCount() > 0)
		{
	        while ($motENInfo = $prendreMotEN->fetch())
	        {
	        	$motENId = htmlspecialchars($motENInfo['id']);
	        	$motENMot = htmlspecialchars($motENInfo['mot']);
	        	$motENTraduction = htmlspecialchars($motENInfo['traduction']);
	        	$motENExemple = htmlspecialchars($motENInfo['exemple']);

	        	$motENFavoris = $motENInfo['favoris'];

	        	if (!isset($_GET['modifier']) && !isset($_GET['id']))
	        	{
	        		?>

			        <div class="div-mot-boucle">

			          	<div class="flex-ali-center">

					      	<p class="title"><?= $motENMot; ?></p>

					      	<?php 

					      	if ($motENFavoris == "Y")
					      	{
					      		?>

					      		<a onclick="titleDesactiveFaEN(<?= $motENId; ?>)"><i class="i favoris-actuelle fa-regular fa-star"></i></a>
					 					    
					 			<?php
					      	}

					      	else
					      	{
					      		?>

								<a onclick="titleFaEN(<?= $motENId; ?>)"><i class="i favoris-non-actuelle fa-regular fa-star"></i></a>

					      		<?php
					      	}

					      	?>

					    </div>

					    <p class="p-section"><?= $motENTraduction; ?></p>
					    <p class="p-section"><?= $motENExemple; ?></p>

						<div class="div-mot-boucle-a">

							<a class="mot-boucle-a"
								href="mot?mot=en&contenu=favoris<?php if (isset($_GET['p'])) { echo "&p=" . $_GET['p']; } ?>&modifier=Y&id=<?php echo $motENId; ?>">Modifier</a>

							<a class="mot-boucle-a" onclick="completerMotEN(<?= $motENId; ?>)" id="completer-mot-en">Compléter</a>

							<a class="mot-boucle-corbeille" onclick="supprimerMotEN(<?= $motENId; ?>)"><i class="fa-solid fa-trash"></i></a>

						</div>

			        </div>

	        		<?php
	        	}

	        	else if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['id']))
	        	{
					$getid = $_GET['id'];

					$prendreMotEN = $dbh->prepare('SELECT * FROM mot_en WHERE id = :id');
					$prendreMotEN->bindValue('id', $getid);
					$prendreMotEN->execute();

					$motENInfo = $prendreMotEN->fetch();

		        	$motENId = $motENInfo['id'];  				
		        	$motENMot = $motENInfo['mot'];  				
		        	$motENTraduction = $motENInfo['traduction'];
		        	$motENExemple = $motENInfo['exemple'];

					?>

					<form class="form" method="POST">

						<div class="flex-dir-col-center">
							<input class="input" type="hidden" id="id-modifier-mot-en" value="<?= $motENId; ?>">
							<input class="input" type="text" id="mot-modifier-mot-en" value="<?= $motENMot; ?>">
							<input class="input" type="text" id="traduction-modifier-mot-en" value="<?= $motENTraduction; ?>">
							<input class="input" type="text" id="exemple-modifier-mot-en" value="<?= $motENExemple; ?>">

							<input class="input-submit" type="submit" name="modifier" id="modifier-mot-en-favoris" value="Modifier">
						</div>

					</form>

					<?php
				}
	        }
	    }
	}        		

	?>
			
</section>
