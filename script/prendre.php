
<?php session_start(); ?>

<?php require("../db/db.php"); ?>

<?php

// VARIABLES

$utilisateurId = $_SESSION['id'];


// POST AJAX AJOUTER POUR TODOLIST

if (isset($_GET['ajouter']) && $_GET['ajouter'] == "Y" && isset($_GET['contenu']) && $_GET['contenu'] == "Todolist")
{
	$titre = $_POST['titre'];
	$contenu = $_POST['contenu'];
	$experience = $_POST['experience'];

	$insererUtilisateur = $dbh->prepare('INSERT INTO todolist (titre, contenu, experience, utilisateur_id) VALUES (:titre, :contenu, :experience, :id)');
	$insererUtilisateur->bindValue('titre', $titre);
	$insererUtilisateur->bindValue('contenu', $contenu);
	$insererUtilisateur->bindValue('experience', $experience);
	$insererUtilisateur->bindValue('id', $utilisateurId);
	$insererUtilisateur->execute();
}


// POST AJAX MODIFIER POUR TODOLIST

if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['contenu']) && $_GET['contenu'] == "Todolist")
{
	$id = $_POST['id'];	
	$titre = $_POST['titre'];
	$contenu = $_POST['contenu'];
	$experience = $_POST['experience'];

	$nouveauTodolist = $dbh->prepare('UPDATE todolist SET titre = :titre, contenu = :contenu, experience = :experience WHERE id = :id');
	$nouveauTodolist->bindValue('titre', $titre);
	$nouveauTodolist->bindValue('contenu', $contenu);
	$nouveauTodolist->bindValue('experience', $experience);
	$nouveauTodolist->bindValue('id', $id);
	$nouveauTodolist->execute();
}


// POST AJAX AJOUTER POUR WORD FR

if (isset($_GET['ajouter']) && $_GET['ajouter'] == "Y" && isset($_GET['lang']) && $_GET['lang'] == "FR")
{
	$mot = $_POST['mot'];
	$definition = $_POST['definition'];
	$exemple = $_POST['exemple'];

	$insererMot = $dbh->prepare('INSERT INTO mot_fr (mot, definition, exemple, utilisateur_id) VALUES (:mot, :definition, :exemple, :id)');
	$insererMot->bindValue('mot', $mot);
	$insererMot->bindValue('definition', $definition);
	$insererMot->bindValue('exemple', $exemple);
	$insererMot->bindValue('id', $utilisateurId);
	$insererMot->execute();
}


// POST AJAX MODIFIER POUR MOT FR

if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['contenu']) && $_GET['contenu'] == "MotFR")
{
	$id = $_POST['id'];	
	$mot = $_POST['mot'];
	$definition = $_POST['definition'];
	$exemple = $_POST['exemple'];

	$nouveauTodolist = $dbh->prepare('UPDATE mot_fr SET mot = :mot, definition = :definition, exemple = :exemple WHERE id = :id');
	$nouveauTodolist->bindValue('mot', $mot);
	$nouveauTodolist->bindValue('definition', $definition);
	$nouveauTodolist->bindValue('exemple', $exemple);
	$nouveauTodolist->bindValue('id', $id);
	$nouveauTodolist->execute();
}


// POST AJAX AJOUTER POUR WORD EN

if (isset($_GET['ajouter']) && $_GET['ajouter'] == "Y" && isset($_GET['lang']) && $_GET['lang'] == "EN")
{
	$mot = $_POST['mot'];
	$traduction = $_POST['traduction'];
	$exemple = $_POST['exemple'];

	$insererMot = $dbh->prepare('INSERT INTO mot_en (mot, traduction, exemple, utilisateur_id) VALUES (:mot, :traduction, :exemple, :id)');
	$insererMot->bindValue('mot', $mot);
	$insererMot->bindValue('traduction', $traduction);
	$insererMot->bindValue('exemple', $exemple);
	$insererMot->bindValue('id', $utilisateurId);
	$insererMot->execute();
}


// POST AJAX MODIFIER POUR MOT EN

if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['contenu']) && $_GET['contenu'] == "MotEN")
{
	$id = $_POST['id'];	
	$mot = $_POST['mot'];
	$traduction = $_POST['traduction'];
	$exemple = $_POST['exemple'];

	$nouveauTodolist = $dbh->prepare('UPDATE mot_en SET mot = :mot, traduction = :traduction, exemple = :exemple WHERE id = :id');
	$nouveauTodolist->bindValue('mot', $mot);
	$nouveauTodolist->bindValue('traduction', $traduction);
	$nouveauTodolist->bindValue('exemple', $exemple);
	$nouveauTodolist->bindValue('id', $id);
	$nouveauTodolist->execute();
}


// POST AJAX AJOUTER POUR WORD CH

if (isset($_GET['ajouter']) && $_GET['ajouter'] == "Y" && isset($_GET['lang']) && $_GET['lang'] == "CH")
{
	$mot = $_POST['mot'];
	$traductionFR = $_POST['traductionFR'];
	$traductionEN = $_POST['traductionEN'];
	$exemple = $_POST['exemple'];

	$insererMot = $dbh->prepare('INSERT INTO mot_ch (mot, traductionFR, traductionEN, exemple, utilisateur_id) VALUES (:mot, :traductionFR, :traductionEN, :exemple, :id)');
	$insererMot->bindValue('mot', $mot);
	$insererMot->bindValue('traductionFR', $traductionFR);
	$insererMot->bindValue('traductionEN', $traductionEN);
	$insererMot->bindValue('exemple', $exemple);
	$insererMot->bindValue('id', $utilisateurId);
	$insererMot->execute();
}


// POST AJAX MODIFIER POUR MOT CH

if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['contenu']) && $_GET['contenu'] == "MotCH")
{
	$id = $_POST['id'];	
	$mot = $_POST['mot'];
	$traductionFR = $_POST['traductionFR'];
	$traductionEN = $_POST['traductionEN'];
	$exemple = $_POST['exemple'];

	$nouveauTodolist = $dbh->prepare('UPDATE mot_ch SET mot = :mot, traductionFR = :traductionFR, traductionEN = :traductionEN, exemple = :exemple WHERE id = :id');
	$nouveauTodolist->bindValue('mot', $mot);
	$nouveauTodolist->bindValue('traductionFR', $traductionFR);
	$nouveauTodolist->bindValue('traductionEN', $traductionEN);
	$nouveauTodolist->bindValue('exemple', $exemple);
	$nouveauTodolist->bindValue('id', $id);
	$nouveauTodolist->execute();
}


// POST AJAX AJOUTER POUR WORD INF

if (isset($_GET['ajouter']) && $_GET['ajouter'] == "Y" && isset($_GET['lang']) && $_GET['lang'] == "INF")
{
	$language = $_POST['language'];
	$sujet = $_POST['sujet'];
	$contenu = $_POST['contenu'];
	$note = $_POST['note'];

	$insererMot = $dbh->prepare('INSERT INTO mot_inf (language, sujet, contenu, note, utilisateur_id) VALUES (:language, :sujet, :contenu, :note, :id)');
	$insererMot->bindValue('language', $language);
	$insererMot->bindValue('sujet', $sujet);
	$insererMot->bindValue('contenu', $contenu);
	$insererMot->bindValue('note', $note);
	$insererMot->bindValue('id', $utilisateurId);
	$insererMot->execute();
}


// POST AJAX MODIFIER POUR MOT INF

if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['contenu']) && $_GET['contenu'] == "MotINF")
{
	$id = $_POST['id'];
	$language = $_POST['language'];
	$sujet = $_POST['sujet'];
	$contenu = $_POST['contenu'];
	$note = $_POST['note'];

	$nouveauTodolist = $dbh->prepare('UPDATE mot_inf SET language = :language, sujet = :sujet, contenu = :contenu, note = :note WHERE id = :id');
	$nouveauTodolist->bindValue('language', $language);
	$nouveauTodolist->bindValue('sujet', $sujet);
	$nouveauTodolist->bindValue('contenu', $contenu);
	$nouveauTodolist->bindValue('note', $note);
	$nouveauTodolist->bindValue('id', $id);
	$nouveauTodolist->execute();
}


// POST AJAX MODIFIER POUR COMPLETER MOT FR

if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['contenu']) && $_GET['contenu'] == "completer-MotFR")
{
	$id = $_POST['id'];	
	$mot = $_POST['mot'];
	$definition = $_POST['definition'];
	$exemple = $_POST['exemple'];

	$nouveauTodolist = $dbh->prepare('UPDATE mot_fr SET mot = :mot, definition = :definition, exemple = :exemple WHERE id = :id');
	$nouveauTodolist->bindValue('mot', $mot);
	$nouveauTodolist->bindValue('definition', $definition);
	$nouveauTodolist->bindValue('exemple', $exemple);
	$nouveauTodolist->bindValue('id', $id);
	$nouveauTodolist->execute();
}


// POST AJAX MODIFIER POUR COMPLETER MOT EN

if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['contenu']) && $_GET['contenu'] == "completer-MotEN")
{
	$id = $_POST['id'];	
	$mot = $_POST['mot'];
	$traduction = $_POST['traduction'];
	$exemple = $_POST['exemple'];

	$nouveauTodolist = $dbh->prepare('UPDATE mot_en SET mot = :mot, traduction = :traduction, exemple = :exemple WHERE id = :id');
	$nouveauTodolist->bindValue('mot', $mot);
	$nouveauTodolist->bindValue('traduction', $traduction);
	$nouveauTodolist->bindValue('exemple', $exemple);
	$nouveauTodolist->bindValue('id', $id);
	$nouveauTodolist->execute();
}


// POST AJAX MODIFIER POUR COMPLETER MOT CH

if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['contenu']) && $_GET['contenu'] == "completer-MotCH")
{
	$id = $_POST['id'];	
	$mot = $_POST['mot'];
	$traductionFR = $_POST['traductionFR'];
	$traductionEN = $_POST['traductionEN'];
	$exemple = $_POST['exemple'];

	$nouveauTodolist = $dbh->prepare('UPDATE mot_ch SET mot = :mot, traductionFR = :traductionFR, traductionEN = :traductionEN, exemple = :exemple WHERE id = :id');
	$nouveauTodolist->bindValue('mot', $mot);
	$nouveauTodolist->bindValue('traductionFR', $traductionFR);
	$nouveauTodolist->bindValue('traductionEN', $traductionEN);
	$nouveauTodolist->bindValue('exemple', $exemple);
	$nouveauTodolist->bindValue('id', $id);
	$nouveauTodolist->execute();
}


// POST AJAX MODIFIER POUR COMPLETER MOT INF

if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['contenu']) && $_GET['contenu'] == "completer-MotINF")
{
	$id = $_POST['id'];
	$language = $_POST['language'];
	$sujet = $_POST['sujet'];
	$contenu = $_POST['contenu'];
	$note = $_POST['note'];

	$nouveauTodolist = $dbh->prepare('UPDATE mot_inf SET language = :language, sujet = :sujet, contenu = :contenu, note = :note WHERE id = :id');
	$nouveauTodolist->bindValue('language', $language);
	$nouveauTodolist->bindValue('sujet', $sujet);
	$nouveauTodolist->bindValue('contenu', $contenu);
	$nouveauTodolist->bindValue('note', $note);
	$nouveauTodolist->bindValue('id', $id);
	$nouveauTodolist->execute();
}


// GET AJAX

if (isset($_GET['id']) AND !empty($_GET['id']))
{

	// VARIABLES

	$getId = $_GET['id'];
	$favorisY ="Y";
	$favorisN = "N";
	$completerY = "Y";
	$completerN = "N";


    // COMPLETER TODOLIST

	if (isset($_GET['completer']) && $_GET['completer'] == "Y" && isset($_GET['todolist']) && $_GET['todolist'] == "Y")
	{
		$prendreTodolist = $dbh->prepare('SELECT * FROM todolist WHERE id = :id');
		$prendreTodolist->bindValue('id', $getId);
		$prendreTodolist->execute();

		if ($prendreTodolist->rowCount() > 0)
		{
			$todolistInfo = $prendreTodolist->fetch();

			$todolistExperience = $todolistInfo['experience'];

			$prendreUtilisateur = $dbh->prepare('SELECT * FROM utilisateur WHERE id = :id');
	        $prendreUtilisateur->bindValue('id', $utilisateurId);
	        $prendreUtilisateur->execute();

	        if ($prendreUtilisateur->rowCount() > 0)
	        {
				$utilisateurInfo = $prendreUtilisateur->fetch();

				$utilisateurExperience = $utilisateurInfo['experience'];

				$utilisateurExperienceAjouter = $todolistExperience + $utilisateurExperience;

		        $nouveauUtilisateurExperience = $dbh->prepare("UPDATE utilisateur SET experience = :experience WHERE id = :id");
		        $nouveauUtilisateurExperience->bindValue('experience', $utilisateurExperienceAjouter);
		        $nouveauUtilisateurExperience->bindValue('id', $utilisateurId);
		        $nouveauUtilisateurExperience->execute();

		        if ($nouveauUtilisateurExperience)
		        {
					$_SESSION['experience'] = $utilisateurExperienceAjouter;
		        	
					$supprimerTodolist = $dbh->prepare('DELETE FROM todolist WHERE id = :id');
					$supprimerTodolist->bindValue('id', $getId);
					$supprimerTodolist->execute();
		        }
	        }
		}
	}


    // FAVORIS MOT FR

	if (isset($_GET['favoris']) && $_GET['favoris'] == "Y" && isset($_GET['motFR']) && $_GET['motFR'] == "Y")
	{
		$prendreMotFR = $dbh->prepare('SELECT * FROM mot_fr WHERE id = :id');
		$prendreMotFR->bindValue('id', $getId);
		$prendreMotFR->execute();

		if ($prendreMotFR->rowCount() > 0)
		{
			$supprimerMotFR = $dbh->prepare('UPDATE mot_fr SET favoris = :favoris WHERE id = :id');
			$supprimerMotFR->bindValue('favoris', $favorisY);
			$supprimerMotFR->bindValue('id', $getId);
			$supprimerMotFR->execute();
		}
	}


    // NON FAVORIS MOT FR

	if (isset($_GET['favoris']) && $_GET['favoris'] == "N" && isset($_GET['motFR']) && $_GET['motFR'] == "Y")
	{
		$prendreMotFR = $dbh->prepare('SELECT * FROM mot_fr WHERE id = :id');
		$prendreMotFR->bindValue('id', $getId);
		$prendreMotFR->execute();

		if ($prendreMotFR->rowCount() > 0)
		{
			$supprimerMotFR = $dbh->prepare('UPDATE mot_fr SET favoris = :favoris WHERE id = :id');
			$supprimerMotFR->bindValue('favoris', $favorisN);
			$supprimerMotFR->bindValue('id', $getId);
			$supprimerMotFR->execute();
		}
	}


    // COMPLETER MOT FR

	if (isset($_GET['completer']) && $_GET['completer'] == "Y" && isset($_GET['motFR']) && $_GET['motFR'] == "Y")
	{
		$prendreMotFR = $dbh->prepare('SELECT * FROM mot_fr WHERE id = :id');
		$prendreMotFR->bindValue('id', $getId);
		$prendreMotFR->execute();

		if ($prendreMotFR->rowCount() > 0)
		{
			$nouveauCompleterMotFR = $dbh->prepare('UPDATE mot_fr SET completer = :completer WHERE id = :id');
			$nouveauCompleterMotFR->bindValue('completer', $completerY);
			$nouveauCompleterMotFR->bindValue('id', $getId);
			$nouveauCompleterMotFR->execute();

			if ($nouveauCompleterMotFR)
			{
				$nouveauFavorisMotFR = $dbh->prepare('UPDATE mot_fr SET favoris = :favoris WHERE id = :id');
				$nouveauFavorisMotFR->bindValue('favoris', $favorisN);
				$nouveauFavorisMotFR->bindValue('id', $getId);
				$nouveauFavorisMotFR->execute();
			}
		}
	}


    // REVOIR MOT FR

	if (isset($_GET['revoir']) && $_GET['revoir'] == "Y" && isset($_GET['motFR']) && $_GET['motFR'] == "Y")
	{
		$prendreMotFR = $dbh->prepare('SELECT * FROM mot_fr WHERE id = :id');
		$prendreMotFR->bindValue('id', $getId);
		$prendreMotFR->execute();

		if ($prendreMotFR->rowCount() > 0)
		{
			$nouveauCompleterMotFR = $dbh->prepare('UPDATE mot_fr SET completer = :completer WHERE id = :id');
			$nouveauCompleterMotFR->bindValue('completer', $completerN);
			$nouveauCompleterMotFR->bindValue('id', $getId);
			$nouveauCompleterMotFR->execute();
		}
	}	


    // SUPPRIMER MOT FR

	if (isset($_GET['supprimer']) && $_GET['supprimer'] == "Y" && isset($_GET['motFR']) && $_GET['motFR'] == "Y")
	{
		$prendreMotFR = $dbh->prepare('SELECT * FROM mot_fr WHERE id = :id');
		$prendreMotFR->bindValue('id', $getId);
		$prendreMotFR->execute();

		if ($prendreMotFR->rowCount() > 0)
		{
			$supprimerMotFR = $dbh->prepare('DELETE FROM mot_fr WHERE id = :id');
			$supprimerMotFR->bindValue('id', $getId);
			$supprimerMotFR->execute();
		}
	}	


    // FAVORIS MOT EN

	if (isset($_GET['favoris']) && $_GET['favoris'] == "Y" && isset($_GET['motEN']) && $_GET['motEN'] == "Y")
	{
		$prendreMotFR = $dbh->prepare('SELECT * FROM mot_en WHERE id = :id');
		$prendreMotFR->bindValue('id', $getId);
		$prendreMotFR->execute();

		if ($prendreMotFR->rowCount() > 0)
		{
			$supprimerMotFR = $dbh->prepare('UPDATE mot_en SET favoris = :favoris WHERE id = :id');
			$supprimerMotFR->bindValue('favoris', $favorisY);
			$supprimerMotFR->bindValue('id', $getId);
			$supprimerMotFR->execute();
		}
	}


    // NON FAVORIS MOT EN

	if (isset($_GET['favoris']) && $_GET['favoris'] == "N" && isset($_GET['motEN']) && $_GET['motEN'] == "Y")
	{
		$prendreMotFR = $dbh->prepare('SELECT * FROM mot_en WHERE id = :id');
		$prendreMotFR->bindValue('id', $getId);
		$prendreMotFR->execute();

		if ($prendreMotFR->rowCount() > 0)
		{
			$supprimerMotFR = $dbh->prepare('UPDATE mot_en SET favoris = :favoris WHERE id = :id');
			$supprimerMotFR->bindValue('favoris', $favorisN);
			$supprimerMotFR->bindValue('id', $getId);
			$supprimerMotFR->execute();
		}
	}


    // COMPLETER MOT EN

	if (isset($_GET['completer']) && $_GET['completer'] == "Y" && isset($_GET['motEN']) && $_GET['motEN'] == "Y")
	{
		$prendreMotEN = $dbh->prepare('SELECT * FROM mot_en WHERE id = :id');
		$prendreMotEN->bindValue('id', $getId);
		$prendreMotEN->execute();

		if ($prendreMotEN->rowCount() > 0)
		{
			$nouveauCompleterMotEN = $dbh->prepare('UPDATE mot_en SET completer = :completer WHERE id = :id');
			$nouveauCompleterMotEN->bindValue('completer', $completerY);
			$nouveauCompleterMotEN->bindValue('id', $getId);
			$nouveauCompleterMotEN->execute();

			if ($nouveauCompleterMotEN)
			{
				$nouveauFavorisMotEN = $dbh->prepare('UPDATE mot_en SET favoris = :favoris WHERE id = :id');
				$nouveauFavorisMotEN->bindValue('favoris', $favorisN);
				$nouveauFavorisMotEN->bindValue('id', $getId);
				$nouveauFavorisMotEN->execute();
			}
		}
	}


    // REVOIR MOT EN

	if (isset($_GET['revoir']) && $_GET['revoir'] == "Y" && isset($_GET['motEN']) && $_GET['motEN'] == "Y")
	{
		$prendreMotEN = $dbh->prepare('SELECT * FROM mot_en WHERE id = :id');
		$prendreMotEN->bindValue('id', $getId);
		$prendreMotEN->execute();

		if ($prendreMotEN->rowCount() > 0)
		{
			$nouveauCompleterMotEN = $dbh->prepare('UPDATE mot_en SET completer = :completer WHERE id = :id');
			$nouveauCompleterMotEN->bindValue('completer', $completerN);
			$nouveauCompleterMotEN->bindValue('id', $getId);
			$nouveauCompleterMotEN->execute();
		}
	}	


    // SUPPRIMER MOT EN

	if (isset($_GET['supprimer']) && $_GET['supprimer'] == "Y" && isset($_GET['motEN']) && $_GET['motEN'] == "Y")
	{
		$prendreMotEN = $dbh->prepare('SELECT * FROM mot_en WHERE id = :id');
		$prendreMotEN->bindValue('id', $getId);
		$prendreMotEN->execute();

		if ($prendreMotEN->rowCount() > 0)
		{
			$supprimerMotEN = $dbh->prepare('DELETE FROM mot_en WHERE id = :id');
			$supprimerMotEN->bindValue('id', $getId);
			$supprimerMotEN->execute();
		}
	}	


    // FAVORIS MOT CH

	if (isset($_GET['favoris']) && $_GET['favoris'] == "Y" && isset($_GET['motCH']) && $_GET['motCH'] == "Y")
	{
		$prendreMotFR = $dbh->prepare('SELECT * FROM mot_ch WHERE id = :id');
		$prendreMotFR->bindValue('id', $getId);
		$prendreMotFR->execute();

		if ($prendreMotFR->rowCount() > 0)
		{
			$supprimerMotFR = $dbh->prepare('UPDATE mot_ch SET favoris = :favoris WHERE id = :id');
			$supprimerMotFR->bindValue('favoris', $favorisY);
			$supprimerMotFR->bindValue('id', $getId);
			$supprimerMotFR->execute();
		}
	}


    // NON FAVORIS MOT CH

	if (isset($_GET['favoris']) && $_GET['favoris'] == "N" && isset($_GET['motCH']) && $_GET['motCH'] == "Y")
	{
		$prendreMotFR = $dbh->prepare('SELECT * FROM mot_ch WHERE id = :id');
		$prendreMotFR->bindValue('id', $getId);
		$prendreMotFR->execute();

		if ($prendreMotFR->rowCount() > 0)
		{
			$supprimerMotFR = $dbh->prepare('UPDATE mot_ch SET favoris = :favoris WHERE id = :id');
			$supprimerMotFR->bindValue('favoris', $favorisN);
			$supprimerMotFR->bindValue('id', $getId);
			$supprimerMotFR->execute();
		}
	}


    // COMPLETER MOT CH

	if (isset($_GET['completer']) && $_GET['completer'] == "Y" && isset($_GET['motCH']) && $_GET['motCH'] == "Y")
	{
		$prendreMotCH = $dbh->prepare('SELECT * FROM mot_ch WHERE id = :id');
		$prendreMotCH->bindValue('id', $getId);
		$prendreMotCH->execute();

		if ($prendreMotCH->rowCount() > 0)
		{
			$nouveauCompleterMotCH = $dbh->prepare('UPDATE mot_ch SET completer = :completer WHERE id = :id');
			$nouveauCompleterMotCH->bindValue('completer', $completerY);
			$nouveauCompleterMotCH->bindValue('id', $getId);
			$nouveauCompleterMotCH->execute();

			if ($nouveauCompleterMotCH)
			{
				$nouveauFavorisMotCH = $dbh->prepare('UPDATE mot_ch SET favoris = :favoris WHERE id = :id');
				$nouveauFavorisMotCH->bindValue('favoris', $favorisN);
				$nouveauFavorisMotCH->bindValue('id', $getId);
				$nouveauFavorisMotCH->execute();
			}
		}
	}


    // REVOIR MOT CH

	if (isset($_GET['revoir']) && $_GET['revoir'] == "Y" && isset($_GET['motCH']) && $_GET['motCH'] == "Y")
	{
		$prendreMotCH = $dbh->prepare('SELECT * FROM mot_ch WHERE id = :id');
		$prendreMotCH->bindValue('id', $getId);
		$prendreMotCH->execute();

		if ($prendreMotCH->rowCount() > 0)
		{
			$nouveauCompleterMotCH = $dbh->prepare('UPDATE mot_ch SET completer = :completer WHERE id = :id');
			$nouveauCompleterMotCH->bindValue('completer', $completerN);
			$nouveauCompleterMotCH->bindValue('id', $getId);
			$nouveauCompleterMotCH->execute();
		}
	}


    // SUPPRIMER MOT CH

	if (isset($_GET['supprimer']) && $_GET['supprimer'] == "Y" && isset($_GET['motCH']) && $_GET['motCH'] == "Y")
	{
		$prendreMotEN = $dbh->prepare('SELECT * FROM mot_ch WHERE id = :id');
		$prendreMotEN->bindValue('id', $getId);
		$prendreMotEN->execute();

		if ($prendreMotEN->rowCount() > 0)
		{
			$supprimerMotEN = $dbh->prepare('DELETE FROM mot_ch WHERE id = :id');
			$supprimerMotEN->bindValue('id', $getId);
			$supprimerMotEN->execute();
		}
	}	


    // FAVORIS MOT INF

	if (isset($_GET['favoris']) && $_GET['favoris'] == "Y" && isset($_GET['motINF']) && $_GET['motINF'] == "Y")
	{
		$prendreMotFR = $dbh->prepare('SELECT * FROM mot_inf WHERE id = :id');
		$prendreMotFR->bindValue('id', $getId);
		$prendreMotFR->execute();

		if ($prendreMotFR->rowCount() > 0)
		{
			$supprimerMotFR = $dbh->prepare('UPDATE mot_inf SET favoris = :favoris WHERE id = :id');
			$supprimerMotFR->bindValue('favoris', $favorisY);
			$supprimerMotFR->bindValue('id', $getId);
			$supprimerMotFR->execute();
		}
	}


    // NON FAVORIS MOT INF

	if (isset($_GET['favoris']) && $_GET['favoris'] == "N" && isset($_GET['motINF']) && $_GET['motINF'] == "Y")
	{
		$prendreMotFR = $dbh->prepare('SELECT * FROM mot_inf WHERE id = :id');
		$prendreMotFR->bindValue('id', $getId);
		$prendreMotFR->execute();

		if ($prendreMotFR->rowCount() > 0)
		{
			$supprimerMotFR = $dbh->prepare('UPDATE mot_inf SET favoris = :favoris WHERE id = :id');
			$supprimerMotFR->bindValue('favoris', $favorisN);
			$supprimerMotFR->bindValue('id', $getId);
			$supprimerMotFR->execute();
		}
	}	


    // COMPLETER MOT INF

	if (isset($_GET['completer']) && $_GET['completer'] == "Y" && isset($_GET['motINF']) && $_GET['motINF'] == "Y")
	{
		$prendreMotINF = $dbh->prepare('SELECT * FROM mot_inf WHERE id = :id');
		$prendreMotINF->bindValue('id', $getId);
		$prendreMotINF->execute();

		if ($prendreMotINF->rowCount() > 0)
		{
			$nouveauCompleterMotINF = $dbh->prepare('UPDATE mot_inf SET completer = :completer WHERE id = :id');
			$nouveauCompleterMotINF->bindValue('completer', $completerY);
			$nouveauCompleterMotINF->bindValue('id', $getId);
			$nouveauCompleterMotINF->execute();

			if ($nouveauCompleterMotINF)
			{
				$nouveauFavorisMotINF = $dbh->prepare('UPDATE mot_inf SET favoris = :favoris WHERE id = :id');
				$nouveauFavorisMotINF->bindValue('favoris', $favorisN);
				$nouveauFavorisMotINF->bindValue('id', $getId);
				$nouveauFavorisMotINF->execute();
			}
		}
	}


    // REVOIR MOT INF

	if (isset($_GET['revoir']) && $_GET['revoir'] == "Y" && isset($_GET['motINF']) && $_GET['motINF'] == "Y")
	{
		$prendreMotINF = $dbh->prepare('SELECT * FROM mot_inf WHERE id = :id');
		$prendreMotINF->bindValue('id', $getId);
		$prendreMotINF->execute();

		if ($prendreMotINF->rowCount() > 0)
		{
			$nouveauCompleterMotINF = $dbh->prepare('UPDATE mot_inf SET completer = :completer WHERE id = :id');
			$nouveauCompleterMotINF->bindValue('completer', $completerN);
			$nouveauCompleterMotINF->bindValue('id', $getId);
			$nouveauCompleterMotINF->execute();
		}
	}	


    // SUPPRIMER MOT INF

	if (isset($_GET['supprimer']) && $_GET['supprimer'] == "Y" && isset($_GET['motINF']) && $_GET['motINF'] == "Y")
	{
		$prendreMotINF = $dbh->prepare('SELECT * FROM mot_inf WHERE id = :id');
		$prendreMotINF->bindValue('id', $getId);
		$prendreMotINF->execute();

		if ($prendreMotINF->rowCount() > 0)
		{
			$supprimerMotINF = $dbh->prepare('DELETE FROM mot_inf WHERE id = :id');
			$supprimerMotINF->bindValue('id', $getId);
			$supprimerMotINF->execute();
		}
	}		

}

?>
