
<section id="section-gauche">
			
	<article class="article-un">
				
		<form method="POST">

			<div class="flex-dir-col">
			    <input class="marg-top-none input" type="text" name="language" id="language" placeholder="Language">          
			    <input class="input" type="text" name="sujet" id="sujet" placeholder="Sujet">
			    <input class="input" type="text" name="contenu" id="contenu" placeholder="Contenu">
			    <input class="input" type="text" name="note" id="note" placeholder="Note (facultatif)">

			    <input class="input-submit" type="submit" name="ajouter" id="ajouter-mot-inf" value="Ajouter">
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

 			$compterMot = $dbh->prepare('SELECT COUNT(*) AS count FROM mot_inf WHERE utilisateur_id = :id AND completer = :completer');
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

			$prendreMotINF = $dbh->prepare('SELECT * FROM mot_inf ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
			$prendreMotINF->setFetchMode(PDO::FETCH_ASSOC);
			$prendreMotINF->execute();

			$motINFInfo = $prendreMotINF->fetchAll();

			if (count($motINFInfo) == 0)
			{
				header('Location: mot?mot=inf&p=1');
			}
		}

		else if (isset($_GET['contenu']) && $_GET['contenu'] == "favoris")
		{
			$favoris = "Y";
			$completerN = "N";

			$compterMot = $dbh->prepare('SELECT COUNT(*) AS count FROM mot_inf WHERE utilisateur_id = :id AND favoris = :favoris AND completer = :completer');
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

			$prendreMotINF = $dbh->prepare('SELECT * FROM mot_inf ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
			$prendreMotINF->setFetchMode(PDO::FETCH_ASSOC);
			$prendreMotINF->execute();

			$motINFInfo = $prendreMotINF->fetchAll();

			if (count($motINFInfo) == 0)
			{
				header('Location: mot?mot=inf&contenu=favoris&p=1');
			}	    	
		}		    

		else if (isset($_GET['contenu']) && $_GET['contenu'] == "symfony")
		{
			$symfony = "Symfony";
			$completerN = "N";

			$compterMot = $dbh->prepare('SELECT COUNT(*) AS count FROM mot_inf WHERE utilisateur_id = :id AND language = :language AND completer = :completer');
			$compterMot->bindValue('id', $utilisateurId);
			$compterMot->bindValue('language', $symfony);			
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

			$prendreMotINF = $dbh->prepare('SELECT * FROM mot_inf ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
			$prendreMotINF->setFetchMode(PDO::FETCH_ASSOC);
			$prendreMotINF->execute();

			$motINFInfo = $prendreMotINF->fetchAll();

			if (count($motINFInfo) == 0)
			{
			    header('Location: mot?mot=inf&contenu=symfony&p=1');
			}	    	
		}

		else if (isset($_GET['contenu']) && $_GET['contenu'] == "php")
		{
			$php = "PHP";
			$completerN = "N";

			$compterMot = $dbh->prepare('SELECT COUNT(*) AS count FROM mot_inf WHERE utilisateur_id = :id AND language = :language AND completer = :completer');
			$compterMot->bindValue('id', $utilisateurId);
			$compterMot->bindValue('language', $php);			
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

			$prendreMotINF = $dbh->prepare('SELECT * FROM mot_inf ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
			$prendreMotINF->setFetchMode(PDO::FETCH_ASSOC);
			$prendreMotINF->execute();

			$motINFInfo = $prendreMotINF->fetchAll();

			if (count($motINFInfo) == 0)
			{
			    header('Location: mot?mot=inf&contenu=php&p=1');
			}	    	
		}		

		else if (isset($_GET['contenu']) && $_GET['contenu'] == "git")
		{
			$git = "Git";
			$completerN = "N";

			$compterMot = $dbh->prepare('SELECT COUNT(*) AS count FROM mot_inf WHERE utilisateur_id = :id AND language = :language AND completer = :completer');
			$compterMot->bindValue('id', $utilisateurId);
			$compterMot->bindValue('language', $git);			
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

			$prendreMotINF = $dbh->prepare('SELECT * FROM mot_inf ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
			$prendreMotINF->setFetchMode(PDO::FETCH_ASSOC);
			$prendreMotINF->execute();

			$motINFInfo = $prendreMotINF->fetchAll();

			if (count($motINFInfo) == 0)
			{
			    header('Location: mot?mot=inf&contenu=git&p=1');
			}	    	
		}		

		?>

		<div>

			<h2 class="h">Actuellement sur :

			<?php

			// MOT INF MENU : CONTENU ACTUEL

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

		<div class="flex-dir-col marg-top">

			<div class="flex">

			    <?php

		   		// MOT INF MENU : CONTENU    

				if (isset($_GET['mot']) && $_GET['mot'] == "inf" && !isset($_GET['contenu']))
				{
					?>

					<a class="page-actuelle a-menu">Accueil</a>

					<?php
				}

				else
				{
					?>

			        <a class="page-non-actuelle a-menu" href="mot?mot=inf&p=1">Accueil</a>

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

			        <a class="page-non-actuelle a-menu" href="mot?mot=inf&contenu=favoris&p=1">Favoris</a>

					<?php
				}					

				if (isset($_GET['contenu']) && $_GET['contenu'] == "symfony")
				{
					?>

					<a class="page-actuelle a-menu">Symfony</a>

					<?php
				}

				else
				{
					?>

					<a class="page-non-actuelle a-menu" href="mot?mot=inf&contenu=symfony&p=1">Symfony</a>

					<?php
				}


				if (isset($_GET['contenu']) && $_GET['contenu'] == "php")
				{
					?>

					<a class="page-actuelle a-menu">PHP</a>

					<?php
				}

				else
				{
					?>

					<a class="page-non-actuelle a-menu" href="mot?mot=inf&contenu=php&p=1">PHP</a>

					<?php
				}

				?>

			</div>

			<div class="flex marg-top-faible">

				<?php

		   		// MOT INF MENU : CONTENU					

				if (isset($_GET['contenu']) && $_GET['contenu'] == "git")
				{
					?>

					<a class="page-actuelle a-menu">Git</a>

					<?php
				}

				else
				{
					?>

					<a class="page-non-actuelle a-menu" href="mot?mot=inf&contenu=git&p=1">Git</a>

					<?php
				}

			    ?>

			</div>

		</div>

		<div class="flex">

			<?php

			// MOT INF MENU : PAGE

			for ($compteur = 1; $compteur <= $nombreDePage; $compteur++)
			{ 
				if ($getP != $compteur)
				{
					if (!isset($_GET['contenu']))
					{
						?>

						<a class="page-non-actuelle a-page marg-top" href="mot?mot=inf&p=<?php echo $compteur; ?>"><?php echo $compteur; ?></a>

						<?php
					}

					else if (isset($_GET['contenu']) && $_GET['contenu'] == "favoris")
					{
						?>

						<a class="page-non-actuelle a-page marg-top" href="mot?mot=inf&contenu=favoris&p=<?php echo $compteur; ?>"><?php echo $compteur; ?></a>

						<?php
					}

					else if (isset($_GET['contenu']) && $_GET['contenu'] == "symfony")
					{
						?>

						<a class="page-non-actuelle a-page marg-top" href="mot?mot=inf&contenu=symfony&p=<?php echo $compteur; ?>"><?php echo $compteur; ?></a>

						<?php
					}

					else if (isset($_GET['contenu']) && $_GET['contenu'] == "php")
					{
						?>

						<a class="page-non-actuelle a-page marg-top" href="mot?mot=inf&contenu=php&p=<?php echo $compteur; ?>"><?php echo $compteur; ?></a>

						<?php
					}

					else if (isset($_GET['contenu']) && $_GET['contenu'] == "git")
					{
						?>

						<a class="page-non-actuelle a-page marg-top" href="mot?mot=inf&contenu=git&p=<?php echo $compteur; ?>"><?php echo $compteur; ?></a>

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

		$prendreMotINF = $dbh->prepare('SELECT * FROM mot_inf WHERE utilisateur_id = :id AND completer = :completer ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
		$prendreMotINF->bindValue('id', $utilisateurId);
		$prendreMotINF->bindValue('completer', $completerN);
		$prendreMotINF->execute();

	    if ($prendreMotINF->rowCount() > 0)
	    {
	       	while ($motINFInfo = $prendreMotINF->fetch())
	        {
	        	$motINFId = htmlspecialchars($motINFInfo['id']);
	        	$motINFLanguage = htmlspecialchars($motINFInfo['language']);	
	        	$motINFSujet = htmlspecialchars($motINFInfo['sujet']);
	        	$motINFContenu = htmlspecialchars($motINFInfo['contenu']);
	        	$motINFNote = htmlspecialchars($motINFInfo['note']);

	        	$motINFavoris = $motINFInfo['favoris'];

	        	if (!isset($_GET['modifier']) && !isset($_GET['id']))
	        	{
	        		?>

			        <div class="div-mot-boucle">

			          	<div class="flex-ali-center">

					      	<p class="title"><?= $motINFLanguage; ?></p>

					      	<?php 

					      	if ($motINFavoris == "Y")
					      	{
					      		?>

					      		<a onclick="titleDesactiveFaINF(<?= $motINFId; ?>)"><i class="i favoris-actuelle fa-regular fa-star"></i></a>
					 					    
					 			<?php					
					      	}

					      	else
					      	{
					      		?>

								 <a onclick="titleFaINF(<?= $motINFId; ?>)"><i class="i favoris-non-actuelle fa-regular fa-star"></i></a>

					      		<?php
					      	}

					      	?>

					    </div>

					    <p class="p-section"><?= $motINFSujet; ?></p>
					    <p class="p-section"><?= $motINFContenu; ?></p>
					    <p class="p-section"><?= $motINFNote; ?></p>

						<div class="div-mot-boucle-a">

							<a class="mot-boucle-a"
								href="mot?mot=inf<?php if (isset($_GET['p'])) { echo "&p=" . $_GET['p']; } ?>&modifier=Y&id=<?php echo $motINFId; ?>">Modifier</a>

							<a class="mot-boucle-a" onclick="completerMotINF(<?= $motINFId; ?>)" id="completer-mot-inf">Compléter</a>

							<a class="mot-boucle-corbeille" onclick="supprimerMotINF(<?= $motINFId; ?>)"><i class="fa-solid fa-trash"></i></a>

						</div>

			        </div>

	        		<?php
	        	}

	        	else if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['id']))
	        	{
					$getid = $_GET['id'];

					$prendreMotINF = $dbh->prepare('SELECT * FROM mot_inf WHERE id = :id');
					$prendreMotINF->bindValue('id', $getid);
					$prendreMotINF->execute();

					$motINFInfo = $prendreMotINF->fetch();

		        	$motINFId = $motINFInfo['id'];			
		        	$motINFLanguage = $motINFInfo['language'];			
		        	$motINFSujet = $motINFInfo['sujet'];
		        	$motINFContenu = $motINFInfo['contenu'];
		        	$motINFNote = $motINFInfo['note'];

					?>

					<form class="form" method="POST">

						<div class="flex-dir-col-center">
							<input class="input" type="hidden" id="id-modifier-mot-inf" value="<?= $motINFId; ?>">
							<input class="input" type="text" id="language-modifier-mot-inf" value="<?= $motINFLanguage; ?>">
							<input class="input" type="text" id="sujet-modifier-mot-inf" value="<?= $motINFSujet; ?>">
							<input class="input" type="text" id="contenu-modifier-mot-inf" value="<?= $motINFContenu; ?>">
							<input class="input" type="text" id="note-modifier-mot-inf" value="<?= $motINFNote; ?>">

							<input class="input-submit" type="submit" name="modifier" id="modifier-mot-inf" value="Modifier">
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

		$prendreMotINF = $dbh->prepare('SELECT * FROM mot_inf WHERE utilisateur_id = :id AND favoris = :favoris AND completer = :completer ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
		$prendreMotINF->bindValue('id', $utilisateurId);
		$prendreMotINF->bindValue('favoris', $favoris);			        
		$prendreMotINF->bindValue('completer', $completerN);			        
		$prendreMotINF->execute();

	    if ($prendreMotINF->rowCount() > 0)
	    {
	        while ($motINFInfo = $prendreMotINF->fetch())
	        {
	        	$motINFId = htmlspecialchars($motINFInfo['id']);
	        	$motINFLanguage = htmlspecialchars($motINFInfo['language']);	
	        	$motINFSujet = htmlspecialchars($motINFInfo['sujet']);
	        	$motINFContenu = htmlspecialchars($motINFInfo['contenu']);
	        	$motINFNote = htmlspecialchars($motINFInfo['note']);

	        	$motINFavoris = $motINFInfo['favoris'];

	        	if (!isset($_GET['modifier']) && !isset($_GET['id']))
	        	{
	        		?>

			        <div class="div-mot-boucle">

			          	<div class="flex-ali-center">

					      	<p class="title"><?= $motINFLanguage; ?></p>

					      	<?php 

					      	if ($motINFavoris == "Y")
					      	{
					      		?>

					      		<a onclick="titleDesactiveFaINF(<?= $motINFId; ?>)"><i class="i favoris-actuelle fa-regular fa-star"></i></a>
					 					    
					 			<?php
					      	}

					      	else
					      	{
					      		?>

								<a onclick="titleFaINF(<?= $motINFId; ?>)"><i class="i favoris-non-actuelle fa-regular fa-star"></i></a>

					      		<?php
					      	}

					      	?>

					    </div>

					    <p class="p-section"><?= $motINFSujet; ?></p>
					    <p class="p-section"><?= $motINFContenu; ?></p>
					    <p class="p-section"><?= $motINFNote; ?></p>

						<div class="div-mot-boucle-a">

							<a class="mot-boucle-a"
								href="mot?mot=inf&contenu=favoris<?php if (isset($_GET['p'])) { echo "&p=" . $_GET['p']; } ?>&modifier=Y&id=<?php echo $motINFId; ?>">Modifier</a>

							<a class="mot-boucle-a" onclick="completerMotINF(<?= $motINFId; ?>)" id="completer-mot-inf">Compléter</a>

							<a class="mot-boucle-corbeille" onclick="supprimerMotINF(<?= $motINFId; ?>)"><i class="fa-solid fa-trash"></i></a>

						</div>

			        </div>

	        		<?php
	        	}

	        	else if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['id']))
	        	{
					$getid = $_GET['id'];

					$prendreMotINF = $dbh->prepare('SELECT * FROM mot_inf WHERE id = :id');
					$prendreMotINF->bindValue('id', $getid);
					$prendreMotINF->execute();

					$motINFInfo = $prendreMotINF->fetch();

		        	$motINFId = $motINFInfo['id'];			
		        	$motINFLanguage = $motINFInfo['language'];			
		        	$motINFSujet = $motINFInfo['sujet'];
		        	$motINFContenu = $motINFInfo['contenu'];
		        	$motINFNote = $motINFInfo['note'];

					?>

					<form class="form" method="POST">

						<div class="flex-dir-col-center">
							<input class="input" type="hidden" id="id-modifier-mot-inf" value="<?= $motINFId; ?>">
							<input class="input" type="text" id="language-modifier-mot-inf" value="<?= $motINFLanguage; ?>">
							<input class="input" type="text" id="sujet-modifier-mot-inf" value="<?= $motINFSujet; ?>">
							<input class="input" type="text" id="contenu-modifier-mot-inf" value="<?= $motINFContenu; ?>">
							<input class="input" type="text" id="note-modifier-mot-inf" value="<?= $motINFNote; ?>">

							<input class="input-submit" type="submit" name="modifier" id="modifier-mot-inf-favoris" value="Modifier">
						</div>		

					</form>

					<?php
				}
	        }
	    }
	}

	else if (isset($_GET['contenu']) && $_GET['contenu'] == "symfony")
	{
		$symfony = "Symfony";
		$completerN = "N";

		$prendreMotINF = $dbh->prepare('SELECT * FROM mot_inf WHERE utilisateur_id = :id AND language = :language AND completer = :completer ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
		$prendreMotINF->bindValue('id', $utilisateurId);
		$prendreMotINF->bindValue('language', $symfony);			        
		$prendreMotINF->bindValue('completer', $completerN);			        
		$prendreMotINF->execute();

	    if ($prendreMotINF->rowCount() > 0)
	    {
	        while ($motINFInfo = $prendreMotINF->fetch())
	        {
	        	$motINFId = htmlspecialchars($motINFInfo['id']);
	        	$motINFLanguage = htmlspecialchars($motINFInfo['language']);	
	        	$motINFSujet = htmlspecialchars($motINFInfo['sujet']);
	        	$motINFContenu = htmlspecialchars($motINFInfo['contenu']);
	        	$motINFNote = htmlspecialchars($motINFInfo['note']);

	        	$motINFavoris = $motINFInfo['favoris'];

	        	if (!isset($_GET['modifier']) && !isset($_GET['id']))
	        	{
	        		?>

			        <div class="div-mot-boucle">

			          	<div class="flex-ali-center">

					      	<p class="title"><?= $motINFLanguage; ?></p>

					      	<?php 

					      	if ($motINFavoris == "Y")
					      	{
					      		?>

					      		<a onclick="titleDesactiveFaINF(<?= $motINFId; ?>)"><i class="i favoris-actuelle fa-regular fa-star"></i></a>
					 					    
					 			<?php					
					      	}

					      	else
					      	{
					      		?>

								<a onclick="titleFaINF(<?= $motINFId; ?>)"><i class="i favoris-non-actuelle fa-regular fa-star"></i></a>

					      		<?php
					      	}

					      	?>

					    </div>

					    <p class="p-section"><?= $motINFSujet; ?></p>
					    <p class="p-section"><?= $motINFContenu; ?></p>
					    <p class="p-section"><?= $motINFNote; ?></p>

						<div class="div-mot-boucle-a">

							<a class="mot-boucle-a"
								href="mot?mot=inf&contenu=symfony<?php if (isset($_GET['p'])) { echo "&p=" . $_GET['p']; } ?>&modifier=Y&id=<?php echo $motINFId; ?>">Modifier</a>

							<a class="mot-boucle-a" onclick="completerMotINF(<?= $motINFId; ?>)" id="completer-mot-inf">Compléter</a>

							<a class="mot-boucle-corbeille" onclick="supprimerMotINF(<?= $motINFId; ?>)"><i class="fa-solid fa-trash"></i></a>

						</div>

			        </div>

	        		<?php
	        	}

	        	else if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['id']))
	        	{
					$getid = $_GET['id'];

					$prendreMotINF = $dbh->prepare('SELECT * FROM mot_inf WHERE id = :id');
					$prendreMotINF->bindValue('id', $getid);
					$prendreMotINF->execute();

					$motINFInfo = $prendreMotINF->fetch();

		        	$motINFId = $motINFInfo['id'];			
		        	$motINFLanguage = $motINFInfo['language'];			
		        	$motINFSujet = $motINFInfo['sujet'];
		        	$motINFContenu = $motINFInfo['contenu'];
		        	$motINFNote = $motINFInfo['note'];

					?>

					<form class="form" method="POST">

						<div class="flex-dir-col-center">
							<input class="input" type="hidden" id="id-modifier-mot-inf" value="<?= $motINFId; ?>">
							<input class="input" type="text" id="language-modifier-mot-inf" value="<?= $motINFLanguage; ?>">
							<input class="input" type="text" id="sujet-modifier-mot-inf" value="<?= $motINFSujet; ?>">
							<input class="input" type="text" id="contenu-modifier-mot-inf" value="<?= $motINFContenu; ?>">
							<input class="input" type="text" id="note-modifier-mot-inf" value="<?= $motINFNote; ?>">

							<input class="input-submit" type="submit" name="modifier" id="modifier-mot-inf-symfony" value="Modifier">
						</div>

					</form>

					<?php
				}
	        }
	    }
	}

	else if (isset($_GET['contenu']) && $_GET['contenu'] == "php")
	{
		$php = "PHP";
		$completerN = "N";

		$prendreMotINF = $dbh->prepare('SELECT * FROM mot_inf WHERE utilisateur_id = :id AND language = :language AND completer = :completer ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
		$prendreMotINF->bindValue('id', $utilisateurId);
		$prendreMotINF->bindValue('language', $php);			        
		$prendreMotINF->bindValue('completer', $completerN);			        
		$prendreMotINF->execute();

	    if ($prendreMotINF->rowCount() > 0)
	    {
	        while ($motINFInfo = $prendreMotINF->fetch())
	        {
	        	$motINFId = htmlspecialchars($motINFInfo['id']);
	        	$motINFLanguage = htmlspecialchars($motINFInfo['language']);	
	        	$motINFSujet = htmlspecialchars($motINFInfo['sujet']);
	        	$motINFContenu = htmlspecialchars($motINFInfo['contenu']);
	        	$motINFNote = htmlspecialchars($motINFInfo['note']);

	        	$motINFavoris = $motINFInfo['favoris'];

	        	if (!isset($_GET['modifier']) && !isset($_GET['id']))
	        	{
	        		?>

			        <div class="div-mot-boucle">

			          	<div class="flex-ali-center">

					      	<p class="title"><?= $motINFLanguage; ?></p>

					      	<?php 

					      	if ($motINFavoris == "Y")
					      	{
					      		?>

					      		<a onclick="titleDesactiveFaINF(<?= $motINFId; ?>)"><i class="i favoris-actuelle fa-regular fa-star"></i></a>
					 					    
					 			<?php					
					      	}

					      	else
					      	{
					      		?>

								<a onclick="titleFaINF(<?= $motINFId; ?>)"><i class="i favoris-non-actuelle fa-regular fa-star"></i></a>

					      		<?php
					      	}

					      	?>

					    </div>

					    <p class="p-section"><?= $motINFSujet; ?></p>
					    <p class="p-section"><?= $motINFContenu; ?></p>
					    <p class="p-section"><?= $motINFNote; ?></p>

						<div class="div-mot-boucle-a">

							<a class="mot-boucle-a"
								href="mot?mot=inf&contenu=php<?php if (isset($_GET['p'])) { echo "&p=" . $_GET['p']; } ?>&modifier=Y&id=<?php echo $motINFId; ?>">Modifier</a>

							<a class="mot-boucle-a" onclick="completerMotINF(<?= $motINFId; ?>)" id="completer-mot-inf">Compléter</a>

							<a class="mot-boucle-corbeille" onclick="supprimerMotINF(<?= $motINFId; ?>)"><i class="fa-solid fa-trash"></i></a>

						</div>

			        </div>

	        		<?php
	        	}

	        	else if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['id']))
	        	{
					$getid = $_GET['id'];

					$prendreMotINF = $dbh->prepare('SELECT * FROM mot_inf WHERE id = :id');
					$prendreMotINF->bindValue('id', $getid);
					$prendreMotINF->execute();

					$motINFInfo = $prendreMotINF->fetch();

		        	$motINFId = $motINFInfo['id'];			
		        	$motINFLanguage = $motINFInfo['language'];			
		        	$motINFSujet = $motINFInfo['sujet'];
		        	$motINFContenu = $motINFInfo['contenu'];
		        	$motINFNote = $motINFInfo['note'];

					?>

					<form class="form" method="POST">

						<div class="flex-dir-col-center">
							<input class="input" type="hidden" id="id-modifier-mot-inf" value="<?= $motINFId; ?>">
							<input class="input" type="text" id="language-modifier-mot-inf" value="<?= $motINFLanguage; ?>">
							<input class="input" type="text" id="sujet-modifier-mot-inf" value="<?= $motINFSujet; ?>">
							<input class="input" type="text" id="contenu-modifier-mot-inf" value="<?= $motINFContenu; ?>">
							<input class="input" type="text" id="note-modifier-mot-inf" value="<?= $motINFNote; ?>">

							<input class="input-submit" type="submit" name="modifier" id="modifier-mot-inf-php" value="Modifier">
						</div>

					</form>

					<?php
				}
	        }
	    }
	}		

	else if (isset($_GET['contenu']) && $_GET['contenu'] == "git")
	{
		$git = "Git";
		$completerN = "N";

		$prendreMotINF = $dbh->prepare('SELECT * FROM mot_inf WHERE utilisateur_id = :id AND language = :language AND completer = :completer ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
		$prendreMotINF->bindValue('id', $utilisateurId);
		$prendreMotINF->bindValue('language', $git);			        
		$prendreMotINF->bindValue('completer', $completerN);			        
		$prendreMotINF->execute();

	    if ($prendreMotINF->rowCount() > 0)
	    {
	        while ($motINFInfo = $prendreMotINF->fetch())
	        {
	        	$motINFId = htmlspecialchars($motINFInfo['id']);
	        	$motINFLanguage = htmlspecialchars($motINFInfo['language']);	
	        	$motINFSujet = htmlspecialchars($motINFInfo['sujet']);
	        	$motINFContenu = htmlspecialchars($motINFInfo['contenu']);
	        	$motINFNote = htmlspecialchars($motINFInfo['note']);

	        	$motINFavoris = $motINFInfo['favoris'];

	        	if (!isset($_GET['modifier']) && !isset($_GET['id']))
	        	{
	        		?>

			        <div class="div-mot-boucle">

			          	<div class="flex-ali-center">

					      	<p class="title"><?= $motINFLanguage; ?></p>

					      	<?php 

					      	if ($motINFavoris == "Y")
					      	{
					      		?>

					      		<a onclick="titleDesactiveFaINF(<?= $motINFId; ?>)"><i class="i favoris-actuelle fa-regular fa-star"></i></a>
					 					    
					 			<?php					
					      	}

					      	else
					      	{
					      		?>

								 <a onclick="titleFaINF(<?= $motINFId; ?>)"><i class="i favoris-non-actuelle fa-regular fa-star"></i></a>

					      		<?php
					      	}

					      	?>

					    </div>

					    <p class="p-section"><?= $motINFSujet; ?></p>
					    <p class="p-section"><?= $motINFContenu; ?></p>
					    <p class="p-section"><?= $motINFNote; ?></p>

						<div class="div-mot-boucle-a">

							<a class="mot-boucle-a"
								href="mot?mot=inf&contenu=git<?php if (isset($_GET['p'])) { echo "&p=" . $_GET['p']; } ?>&modifier=Y&id=<?php echo $motINFId; ?>">Modifier</a>

							<a class="mot-boucle-a" onclick="completerMotINF(<?= $motINFId; ?>)" id="completer-mot-inf">Compléter</a>

							<a class="mot-boucle-corbeille" onclick="supprimerMotINF(<?= $motINFId; ?>)"><i class="fa-solid fa-trash"></i></a>

						</div>

			        </div>

	        		<?php
	        	}

	        	else if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['id']))
	        	{
					$getid = $_GET['id'];

					$prendreMotINF = $dbh->prepare('SELECT * FROM mot_inf WHERE id = :id');
					$prendreMotINF->bindValue('id', $getid);
					$prendreMotINF->execute();

					$motINFInfo = $prendreMotINF->fetch();

		        	$motINFId = $motINFInfo['id'];			
		        	$motINFLanguage = $motINFInfo['language'];			
		        	$motINFSujet = $motINFInfo['sujet'];
		        	$motINFContenu = $motINFInfo['contenu'];
		        	$motINFNote = $motINFInfo['note'];

					?>

					<form class="form" method="POST">

						<div class="flex-dir-col-center">
							<input class="input" type="hidden" id="id-modifier-mot-inf" value="<?= $motINFId; ?>">
							<input class="input" type="text" id="language-modifier-mot-inf" value="<?= $motINFLanguage; ?>">
							<input class="input" type="text" id="sujet-modifier-mot-inf" value="<?= $motINFSujet; ?>">
							<input class="input" type="text" id="contenu-modifier-mot-inf" value="<?= $motINFContenu; ?>">
							<input class="input" type="text" id="note-modifier-mot-inf" value="<?= $motINFNote; ?>">

							<input class="input-submit" type="submit" name="modifier" id="modifier-mot-inf-git" value="Modifier">
						</div>		

					</form>

					<?php
				}
	        }
	    }
	}

	?>
			
</section>
