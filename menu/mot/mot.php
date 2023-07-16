
<?php

session_start();

require("../../db/db.php");

require("../../script/verification.php");

include("../../script/theme.php");

// VARIABLES SESSIONS

$utilisateurId = $_SESSION['id'];
$utilisateurAvatar = $_SESSION['avatar'];
$utilisateurNom = $_SESSION['nom'];
$utilisateurMdp = $_SESSION['mdp'];
$utilisateurEmail = $_SESSION['email'];
$utilisateurSexe = $_SESSION['sexe'];
$utilisateurNiveau = $_SESSION['niveau'];
$utilisateurExperience = $_SESSION['experience'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://kit.fontawesome.com/118716b668.js" crossorigin="anonymous"></script>
	<title>To Do List <?php if (isset($_GET['mot'])) { ?> (<?php echo $_GET['mot']; ?>) <?php } ?></title>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans">
    <link rel="shortcut icon" type="image/png" href="../../images/favicon.png">
	<link rel="stylesheet" type="text/css" href="../../css/global.css">
	<link rel="stylesheet" type="text/css" href="../../css/menu/mot.css">
	<link rel="stylesheet" type="text/css" href="../../css/theme/<?php echo $themeActuelle; ?>" id="theme_sombre">
</head>

<body class="<?php echo $themeBody; ?>">

<div id="container">

	<!-- HEADER -->

	<header>

		<!-- MOT NAV GAUCHE -->
		
		<nav id="mot-nav-gauche">

			<ul class="ul flex">

				<li><a class="a-menu page-non-actuelle" href="../../index">Index</a></li>

				<?php

				if (isset($_GET['mot']) && $_GET['mot'] == "fr")
				{
					?>

					<li><a class="a-menu page-actuelle">Mots FR</a></li>

					<?php
				}

				else
				{
					?>

					<li><a class="a-menu page-non-actuelle" href="mot?mot=fr&p=1">Mots FR</a>

					<?php
				}

				if (isset($_GET['mot']) && $_GET['mot'] == "en")
				{
					?>

					<li><a class="a-menu page-actuelle">Mots EN</a></li>

					<?php
				}

				else
				{
					?>

					<li><a class="a-menu page-non-actuelle" href="mot?mot=en&p=1">Mots EN</a></li>

					<?php
				}

				if (isset($_GET['mot']) && $_GET['mot'] == "ch")
				{
					?>

					<li><a class="a-menu page-actuelle">Mots CH</a></li>

					<?php
				}

				else
				{
					?>

					<li><a class="a-menu page-non-actuelle" href="mot?mot=ch&p=1">Mots CH</a></li>

					<?php
				}

				if (isset($_GET['mot']) && $_GET['mot'] == "inf")
				{
					?>

					<li><a class="a-menu page-actuelle">Mots INF</a></li>

					<?php
				}

				else
				{
					?>

					<li><a class="a-menu page-non-actuelle" href="mot?mot=inf&p=1">Mots INF</a></li>

					<?php
				}
			
				?>

			</ul>

		</nav>

		<!-- MOT NAV DROITE -->

		<nav id="mot-nav-droite">
			
			<ul class="ul flex">

				<?php

				if (isset($_GET['mot']) && $_GET['mot'] == "completer")
				{
					?>

					<li><a class="a-menu page-actuelle">Completer</a></li>

					<?php
				}

				else
				{
					?>

					<li><a class="a-menu page-non-actuelle" href="mot?mot=completer&p=1">Completer</a></li>

					<?php
				}

				?>

			</ul>

		</nav>

	</header>

	<!-- MOT MAIN -->

	<main class="main">

		<?php

		// MOT FRANCAIS

		if (isset($_GET['mot']) && $_GET['mot'] == "fr")
		{
			include("mot_fr.php");
		}

		// MOT ANGLAIS

		else if (isset($_GET['mot']) && $_GET['mot'] == "en")
		{
			include("mot_en.php");
		}

		// MOT CHINOIS

		else if (isset($_GET['mot']) && $_GET['mot'] == "ch")
		{
			include("mot_ch.php");
		}

		// MOT INF

		else if (isset($_GET['mot']) && $_GET['mot'] == "inf")
		{
			include("mot_inf.php");
		}

		// MOT COMPLETER

		else if (isset($_GET['mot']) && $_GET['mot'] == "completer")
		{
			include("mot_completer.php");
		}		

		?>

	</main>

</div>

<div style="display: none" id="display_none">
	<img id="lien-sombre" src=".." alt="none">
</div>
	
</body>
<script src="../../javascript/minjquery-3.6.0.js"></script>
<script src="../../javascript/script.js"></script>
</html>