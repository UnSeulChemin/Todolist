
<?php

$themeBody = '';
$themeActuelle = '';

if (isset($_COOKIE['theme']) && !empty($_COOKIE['theme']) && $_COOKIE['theme'] == 'sombre')
{
	$themeBody = 'sombre';
	$themeActuelle = 'sombre.css';
}

else
{
	$themeBody = 'empty';
	$themeActuelle = 'empty.css';
}

?>
