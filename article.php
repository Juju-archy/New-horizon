<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Article</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<?php include_once 'include/header.php' ?>

	<h1>New Horizon</h1>

	<div id="site">

		
		<div id="article-unique">
			<h3>Vivre sa vie</h3>
			<img src="image/villa.jpg">
			<p class="resume">Libérez-vous</p>

			<p class="date_article">date de parution</p>
			<p class="categorie_article"><b>Catégorie</b> : </p>

			<div class="paragraphe">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod ...</p>
			</div>

			<hr>

			<div id="commentaire">
				<h2>Commentaires</h2>
				<form>
					<input type="text" name="pseudo" placeholder="Pseudo"><br>
					<textarea placeholder="Votre commentaire :"></textarea><br>
					<input type="submit" name="envoyer" value="Envoyer">
				</form>

				<div class="comment">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
					<p class="auteur">Auteur du commentaire</p>
				</div>
			</div>
		</div>
	

		<?php include_once 'include/side_bar.php' ?>

	</div>

<?php include_once 'include/foot.php' ?>

</body>