<?php 
$erreur = '';
session_start();

	if (isset($_SESSION['admin']) && $_SESSION['admin']) {
		header('Location: /administration.php');
	}

	if (isset($_POST['connexion'])) {

		if (isset ($_POST['pseudo']) && isset($_POST['mdp'])) {
			$pseudo = htmlspecialchars($_POST['pseudo']);
			$mdp = htmlspecialchars($_POST['mdp']);

			if (!empty($pseudo) && !empty($mdp)) {
				
				if ($pseudo == 'archy' && $mdp == '1234') {
					$_SESSION['admin'] = true;
					header('Location: /administration.php');
				} else {
					$erreur = 'Les identifiants que vous avez entrés sont invalides';
				}

			} else {
				$erreur = 'Veuillez saisir votre pseudo et mot de passe';
			}
		} else {
			$erreur = 'Veuillez saisir votre pseudo et mot de passe';
		}
		
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<?php include_once 'include/header.php' ?>

	<h1>Connexion</h1>

	<form method="POST" style="text-align: center;">
		<input type="text" placeholder="Nom d'utilisateur" name="pseudo" <?php if (isset($pseudo)) {?>
			value="<?= $pseudo ?>"
		<?php } ?>><br>
		<input type="password" placeholder="Mot de passe" name="mdp" <?php if (isset($mdp)) {?>
			value="<?= $mdp ?>"
		<?php } ?>><br>
		<input type="submit" value="connexion" name="connexion">
	</form>

	<?php if ($erreur) { ?><p style="text-align: center; font-weight: bold;"><?= $erreur ?><?php } ?>


<?php include_once 'include/foot.php' ?>

</body>