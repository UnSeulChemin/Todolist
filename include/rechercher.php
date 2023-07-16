
<form class="background-trois" method="GET">

	<div id="index-div-rechercher">
		<input type="search" name="rechercher" placeholder="Rechercher un titre">
		<input type="submit" value="Chercher">
	</div>

	<?php

	// GET RECHERCHER

	$prendreTodolist = $dbh->prepare('SELECT * FROM todolist WHERE utilisateur_id = :id ORDER BY id DESC LIMIT 0, 12');
	$prendreTodolist->bindValue('id', $utilisateurId);
	$prendreTodolist->execute();

	if (isset($_GET['rechercher']) AND !empty($_GET['rechercher']))
	{
	    $rechercher = $_GET['rechercher'];

		$prendreTodolist = $dbh->prepare('SELECT * FROM todolist WHERE titre LIKE "%' . $rechercher . '%" AND utilisateur_id = :id ORDER BY id DESC');
		$prendreTodolist->bindValue('id', $utilisateurId);
		$prendreTodolist->execute();
	}

	else if (isset($_GET['rechercher']) AND $_GET['rechercher'] == "")
	{
		header('Location: index');
		exit;
	}

	?>

</form>
