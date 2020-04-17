<?php 

	session_start();

	require_once 'php/config.php';

	if (!isset($_SESSION['admin']) OR !$_SESSION['admin']) {
		header('Location: /');
	}

	//ajout de la catégrie
$message_cat = '';
	if (isset($_POST['category'])) {
		if (!empty($_POST['nom_cat']) && !empty($_POST['slug'])) {
			$nom_cat = htmlspecialchars($_POST['nom_cat']);
			$slug = htmlspecialchars($_POST['slug']);

			$ins = $bdd->prepare('INSERT INTO categories (categorie, url) VALUES (?,?)');
			$ens = $ins->execute([$nom_cat, $slug]);
 
			//message ajout
			if ($ens) {
				$message_cat = 'La nouvelle catégorie a été ajoutée';
			} else {
				$message_cat = 'Une erreur est survenue';
			}

		} else {
			$message_cat = 'Veuillez renseigner un nom de catégorie ainsi qu\'une url';
		}
	}

$categories = $bdd -> query('SELECT * from categories');

$message_article = '';
$image_max = 3; //3mo max

if (isset($_POST['article'])) {
	
	if (isset($_POST['categorie_article'], $_POST['titre'], $_POST['contenu'], $_FILES['miniature']['tmp_name'])) {

		$categorie = htmlspecialchars($_POST['categorie_article']);
		$titre = htmlspecialchars($_POST['titre']);
		$contenu = htmlspecialchars($_POST['contenu']);
		$miniature = $_FILES['miniature'];

		if (!empty($category) && !empty($titre) && !empty($contenu) && !empty($miniature)) {
			if(filesize($miniature['tmp_name'])<= $image_max*50){
				if (exif_imagetype($miniature['tmp_name']) == 2) {
					
					$ins = $bdd ->prepare('INSERT INTO article (id, categorie, contenu, date_publication) VALUES (:titre, :categorie, :contenu, NOW())');
					$res = $ins->execute([
						':titre'=>$titre,
						'categorie'=>$categorie,
						'contenu'=>$contenu
						]);

					if ($res) {
						$last_id = $bdd -> lastInsertId();
						$chemin = 'image/miniatures/'.$last_id.'.jpeg';
						$move = move_uploaded_file($miniature['tmp_name'], $chemin);

						if ($move) {
							$message_article = 'L\'article a été publié';
						} else {
							$message_article = 'Une erreur est survenue sur votre article';
						}

					} else {
						$message_article = 'Une erreur est survenue durant l\'ajout de votre l\'article';
					}

				} else {
					$message_article = 'L\'image doit être au format JPEG.';
				}

			}else {
				$message_article = 'La taille de l\'image ne peut pas dépasser '.$image_max.'mo';
			}
		} 
	} else {
		$message_article = 'Veuillez compléter tous les champs';
	} 
} else {
		$message_article = 'Veuillez compléter tous les champs';
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<h1>Administration</h1>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<?php include_once 'include/header.php' ?>

	<title>Administration</title>

	<div id="admin">
		<br>

		<form method="POST">
			<input  type="text" placeholder="Nom de la catégorie" name="nom_cat">
			<input type="text" placeholder="URL de la catégorie" name="slug" size="30"><br>
			<input type="submit" value="Créer la catégorie" name="category">
		</form>
<br>
		<?php if ($message_cat) {?>
			<p><?= $message_cat?></p>
		<?php } ?>
<br>

	<h3>Rédiger un article</h3>

	<form method="POST" enctype="multipart/form-data">
		<select name="categorie_article">
			<?php while ($o = $categories->fetch(PDO::FETCH_ASSOC)) { ?>
			<option value="<?= $o['url'] ?>">
				<?= $o['categorie'] ?>
			</option>
		<?php } ?>
		</select>
		<input type="text" name="titre" placeholder="Titre de l'article" <?php if(isset($titre)){echo 'value="'.$titre.'"';} ?>><br>
		<textarea style="width: 80%; height: 150px" placeholder="Contenu de l'article" name="contenu"><?php if (isset($contenu)) {
			echo $contenu;
		} ?></textarea>
		<input type="file" name="miniature"><label for="miniature">Miniature de l'article</label><br>
		<input type="submit" value="Publier" name="article">
	</form>
	<br>
	<p><?= $message_article?></p>

	</div>
	<br><br>

	<a href="php/deconnexion.php">Se déconnecter</a>


<?php include_once 'include/foot.php' ?>

</body>