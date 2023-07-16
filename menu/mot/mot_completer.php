
<section id="section-gauche">

	<article class="article-un">

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
			$completerY = "Y";

			$compterMot = $dbh->prepare('SELECT COUNT(*) AS count FROM mot_fr WHERE utilisateur_id = :id AND completer = :completer');
			$compterMot->bindValue('id', $utilisateurId);
			$compterMot->bindValue('completer', $completerY);
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

			$prendreMotCompleterFR = $dbh->prepare('SELECT * FROM mot_fr ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
			$prendreMotCompleterFR->setFetchMode(PDO::FETCH_ASSOC);
			$prendreMotCompleterFR->execute();

			$motCHInfo = $prendreMotCompleterFR->fetchAll();

			if (count($motCHInfo) == 0)
			{
			    header('Location: mot?mot=completer&p=1');
			}
		}

		else if (isset($_GET['contenu']) && $_GET['contenu'] == "completer-en")
		{
			$completerY = "Y";

			$compterMot = $dbh->prepare('SELECT COUNT(*) AS count FROM mot_en WHERE utilisateur_id = :id AND completer = :completer');
			$compterMot->bindValue('id', $utilisateurId);
			$compterMot->bindValue('completer', $completerY);
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

			$prendreMotCompleterEN = $dbh->prepare('SELECT * FROM mot_en ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
			$prendreMotCompleterEN->setFetchMode(PDO::FETCH_ASSOC);
			$prendreMotCompleterEN->execute();

			$motFRInfo = $prendreMotCompleterEN->fetchAll();

			if (count($motFRInfo) == 0)
			{
				header('Location: mot?mot=completer&contenu=completer-en&p=1');
			}	    	
		}

		else if (isset($_GET['contenu']) && $_GET['contenu'] == "completer-ch")
		{
			$completerY = "Y";

			$compterMot = $dbh->prepare('SELECT COUNT(*) AS count FROM mot_ch WHERE utilisateur_id = :id AND completer = :completer');
			$compterMot->bindValue('id', $utilisateurId);
			$compterMot->bindValue('completer', $completerY);
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

			$prendreMotCompleterCH = $dbh->prepare('SELECT * FROM mot_ch ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
			$prendreMotCompleterCH->setFetchMode(PDO::FETCH_ASSOC);
			$prendreMotCompleterCH->execute();

			$motFRInfo = $prendreMotCompleterCH->fetchAll();

			if (count($motFRInfo) == 0)
			{
				header('Location: mot?mot=completer&contenu=completer-ch&p=1');
			}
		}

		else if (isset($_GET['contenu']) && $_GET['contenu'] == "completer-inf")
		{
			$completerY = "Y";

			$compterMot = $dbh->prepare('SELECT COUNT(*) AS count FROM mot_inf WHERE utilisateur_id = :id AND completer = :completer');
			$compterMot->bindValue('id', $utilisateurId);
			$compterMot->bindValue('completer', $completerY);
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

			$prendreMotCompleterINF = $dbh->prepare('SELECT * FROM mot_inf ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
			$prendreMotCompleterINF->setFetchMode(PDO::FETCH_ASSOC);
			$prendreMotCompleterINF->execute();

			$motFRInfo = $prendreMotCompleterINF->fetchAll();

			if (count($motFRInfo) == 0)
			{
				header('Location: mot?mot=completer&contenu=completer-inf&p=1');
			}
		}				

		?>

		<div>

			<h2 class="h">Actuellement sur :

			<?php

			// MOT COMPLETER MENU : CONTENU ACTUEL

			if (isset($_GET['mot']) AND !isset($_GET['contenu']))
			{
			    ?>

			    Mots FR

			    <?php
			}	

			else if (isset($_GET['mot']) && isset($_GET['contenu']) && $_GET['contenu'] == "completer-en")
			{
				?>

				Mots EN

				<?php
			}

			else if (isset($_GET['mot']) && isset($_GET['contenu']) && $_GET['contenu'] == "completer-ch")
			{
				?>

				Mots CH

				<?php
			}

			else if (isset($_GET['mot']) && isset($_GET['contenu']) && $_GET['contenu'] == "completer-inf")
			{
				?>

				Mots INF

				<?php
			}			

			?> </h2>

		</div>

		<div class="flex-dir-col marg-top">

			<div class="flex">

			    <?php

			    // MOT COMPLETER MENU : CONTENU 

				if (isset($_GET['mot']) && $_GET['mot'] == "completer" && !isset($_GET['contenu']))
				{
					?>

					<a class="page-actuelle a-menu">Mots FR</a>

					<?php
				}

				else
				{
					?>

			        <a class="page-non-actuelle a-menu" href="mot?mot=completer&p=1">Mots FR</a>

					<?php
				}

				if (isset($_GET['contenu']) && $_GET['contenu'] == "completer-en")
				{
					?>

					<a class="page-actuelle a-menu">Mots EN</a>

					<?php
				}

				else
				{
					?>

			        <a class="page-non-actuelle a-menu" href="mot?mot=completer&contenu=completer-en&p=1">Mots EN</a>

					<?php
				}			

				if (isset($_GET['contenu']) && $_GET['contenu'] == "completer-ch")
				{
					?>

					<a class="page-actuelle a-menu">Mots CH</a>

					<?php
				}

				else
				{
					?>

			        <a class="page-non-actuelle a-menu" href="mot?mot=completer&contenu=completer-ch&p=1">Mots CH</a>

					<?php
				}

				?>

			</div>

			<div class="flex marg-top-faible">

				<?php

				// MOT COMPLETER MENU : CONTENU			

				if (isset($_GET['contenu']) && $_GET['contenu'] == "completer-inf")
				{
					?>

					<a class="page-actuelle a-menu">Mots INF</a>

					<?php
				}

				else
				{
					?>

			        <a class="page-non-actuelle a-menu" href="mot?mot=completer&contenu=completer-inf&p=1">Mots INF</a>

					<?php
				}

			    ?>

			</div>

		</div>

		<div class="flex">

			<?php

			// MOT COMPLETER MENU : PAGE

			for ($compteur = 1; $compteur <= $nombreDePage; $compteur++)
			{
				if ($getP != $compteur)
				{
					if (!isset($_GET['contenu']))
					{
						?>

						<a class="page-non-actuelle a-page marg-top" href="mot?mot=completer&p=<?php echo $compteur; ?>"><?php echo $compteur; ?></a>

						<?php
					}

					else if (isset($_GET['contenu']) && $_GET['contenu'] == "completer-en")
					{
						?>

						<a class="page-non-actuelle a-page marg-top" href="mot?mot=completer&contenu=completer-en&p=<?php echo $compteur; ?>"><?php echo $compteur; ?></a>

						<?php
					}

					else if (isset($_GET['contenu']) && $_GET['contenu'] == "completer-ch")
					{
						?>

						<a class="page-non-actuelle a-page marg-top" href="mot?mot=completer&contenu=completer-ch&p=<?php echo $compteur; ?>"><?php echo $compteur; ?></a>

						<?php
					}

					else if (isset($_GET['contenu']) && $_GET['contenu'] == "completer-inf")
					{
						?>

						<a class="page-non-actuelle a-page marg-top" href="mot?mot=completer&contenu=completer-inf&p=<?php echo $compteur; ?>"><?php echo $compteur; ?></a>

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
		$completerY = "Y";

		$prendreMotFR = $dbh->prepare('SELECT * FROM mot_fr WHERE utilisateur_id = :id AND completer = :completer ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
		$prendreMotFR->bindValue('id', $utilisateurId);
		$prendreMotFR->bindValue('completer', $completerY);
		$prendreMotFR->execute();			

	    if ($prendreMotFR->rowCount() > 0)
	    {
	        while ($motFRInfo = $prendreMotFR->fetch())
	        {
	        	$motFRId = htmlspecialchars($motFRInfo['id']);
	        	$motFRMot = htmlspecialchars($motFRInfo['mot']);
	        	$motFRDefinition = htmlspecialchars($motFRInfo['definition']);
	        	$motFRExemple = htmlspecialchars($motFRInfo['exemple']);

	        	if (!isset($_GET['modifier']) && !isset($_GET['id']))
	        	{
	        		?>

			        <div class="div-mot-boucle">

					    <p class="pad-bot-zero title"><?= $motFRMot; ?></p>

					    <p class="p-section"><?= $motFRDefinition; ?></p>
					    <p class="p-section"><?= $motFRExemple; ?></p>

						<div class="div-mot-boucle-a">

							<a class="mot-boucle-a"
								href="mot?mot=completer<?php if (isset($_GET['p'])) { echo "&p=" . $_GET['p']; } ?>&modifier=Y&id=<?php echo $motFRId; ?>">Modifier</a>

							<a class="mot-boucle-a" onclick="revoirMotFR(<?= $motFRId; ?>)" id="completer-mot-fr">Revoir</a>

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

							<input class="input-submit" type="submit" name="modifier" id="modifier-mot-completer-fr" value="Modifier">
						</div>

					</form>

					<?php
	        	}
	        }
	    }
    }

	else if (isset($_GET['contenu']) && $_GET['contenu'] == "completer-en")
	{
		$completerY = "Y";			

		$prendreMotEN = $dbh->prepare('SELECT * FROM mot_en WHERE utilisateur_id = :id AND completer = :completer ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
		$prendreMotEN->bindValue('id', $utilisateurId);	        
		$prendreMotEN->bindValue('completer', $completerY);			        
		$prendreMotEN->execute();

		if ($prendreMotEN->rowCount() > 0)
		{
	        while ($motENInfo = $prendreMotEN->fetch())
	        {
	        	$motENId = htmlspecialchars($motENInfo['id']);
	        	$motENMot = htmlspecialchars($motENInfo['mot']);
	        	$motENTraduction = htmlspecialchars($motENInfo['traduction']);
	        	$motENExemple = htmlspecialchars($motENInfo['exemple']);

	        	if (!isset($_GET['modifier']) && !isset($_GET['id']))
	        	{
	        		?>

			        <div class="div-mot-boucle">

					    <p class="pad-bot-zero title"><?= $motENMot; ?></p>

					    <p class="p-section"><?= $motENTraduction; ?></p>
					    <p class="p-section"><?= $motENExemple; ?></p>

						<div class="div-mot-boucle-a">

							<a class="mot-boucle-a"
								href="mot?mot=completer&contenu=completer-en<?php if (isset($_GET['p'])) { echo "&p=" . $_GET['p']; } ?>&modifier=Y&id=<?php echo $motENId; ?>">Modifier</a>

							<a class="mot-boucle-a" onclick="revoirMotEN(<?= $motENId; ?>)" id="completer-mot-completer">Revoir</a>

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

							<input class="input-submit" type="submit" name="modifier" id="modifier-mot-completer-en" value="Modifier">
						</div>		

					</form>

					<?php
				}
	        }
	    }
	}

	else if (isset($_GET['contenu']) && $_GET['contenu'] == "completer-ch")
	{
		$completerY = "Y";	

		$prendreMotCH = $dbh->prepare('SELECT * FROM mot_ch WHERE utilisateur_id = :id AND completer = :completer ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
		$prendreMotCH->bindValue('id', $utilisateurId);	        
		$prendreMotCH->bindValue('completer', $completerY);			        
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

	        	if (!isset($_GET['modifier']) && !isset($_GET['id']))
	        	{
	        		?>

			        <div class="div-mot-boucle">

					    <p class="pad-bot-zero title"><?= $motCHMot; ?></p>

					    <p class="p-section"><?= $motCHTraductionFR; ?></p>
					    <p class="p-section"><?= $motCHTraductionEN; ?></p>
					    <p class="p-section"><?= $motCHExemple; ?></p>

						<div class="div-mot-boucle-a">

							<a class="mot-boucle-a"
								href="mot?mot=completer&contenu=completer-ch<?php if (isset($_GET['p'])) { echo "&p=" . $_GET['p']; } ?>&modifier=Y&id=<?php echo $motCHId; ?>">Modifier</a>

							<a class="mot-boucle-a" onclick="revoirMotCH(<?= $motCHId; ?>)" id="completer-mot-completer">Revoir</a>

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

							<input class="input-submit" type="submit" name="modifier" id="modifier-mot-completer-ch" value="Modifier">
						</div>

					</form>

					<?php
				}
	        }
	    }
	}

	else if (isset($_GET['contenu']) && $_GET['contenu'] == "completer-inf")
	{
		$completerY = "Y";	

		$prendreMotINF = $dbh->prepare('SELECT * FROM mot_inf WHERE utilisateur_id = :id AND completer = :completer ORDER BY id DESC LIMIT ' . $debut . ', ' . $motParPage);
		$prendreMotINF->bindValue('id', $utilisateurId);	        
		$prendreMotINF->bindValue('completer', $completerY);			        
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

	        	if (!isset($_GET['modifier']) && !isset($_GET['id']))
	        	{
	        		?>

			        <div class="div-mot-boucle">

					    <p class="pad-bot-zero title"><?= $motINFLanguage; ?></p>

					    <p class="p-section"><?= $motINFSujet; ?></p>
					    <p class="p-section"><?= $motINFContenu; ?></p>
					    <p class="p-section"><?= $motINFNote; ?></p>

						<div class="div-mot-boucle-a">

							<a class="mot-boucle-a"
								href="mot?mot=completer&contenu=completer-inf<?php if (isset($_GET['p'])) { echo "&p=" . $_GET['p']; } ?>&modifier=Y&id=<?php echo $motINFId; ?>">Modifier</a>

							<a class="mot-boucle-a" onclick="revoirMotINF(<?= $motINFId; ?>)" id="completer-mot-completer">Revoir</a>

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

							<input class="input-submit" type="submit" name="modifier" id="modifier-mot-completer-inf" value="Modifier">
						</div>

					</form>

					<?php
				}
	        }
	    }
	}			       		

	?>
			
</section>
