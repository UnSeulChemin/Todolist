
<?php session_start(); ?>

<?php require("../db/db.php"); ?>

<?php

// VARIABLES

$getId = $_GET['id'];


// SUPPRIMER COMPTE

if (isset($_GET['supprimerCompte']) && $_GET['supprimerCompte'] == "Y")
{
	$recupererUtilisateur = $dbh->prepare('SELECT * FROM utilisateur WHERE id = :id');
	$recupererUtilisateur->bindValue('id', $getId);
	$recupererUtilisateur->execute();

	if ($recupererUtilisateur->rowCount() > 0)
	{
		$utilisateurInfo = $recupererUtilisateur->fetch();
		$utilisateurAvatar = $utilisateurInfo['avatar'];

		$supprimerUtilisateur = $dbh->prepare('DELETE FROM utilisateur WHERE id = :id');
		$supprimerUtilisateur->bindValue('id', $getId);
		$supprimerUtilisateur->execute();	

		session_destroy();

		if ($utilisateurAvatar != "default.jpg")
		{
			unlink("../images/avatar/" . $utilisateurAvatar);
		}
	}
}

?>
