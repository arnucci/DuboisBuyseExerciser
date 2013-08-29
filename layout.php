<!doctype html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Générateur de liste de mots - échelle Dubois-Buyse</title>
		<link rel="stylesheet" href="dubois.css" media="all">
	</head>
	<body>
	    <?php echo $content; ?>
		<?php 
		if (!empty($colonneDebut) || !empty($colonneMilieu) || !empty($colonneFin)) {

			echo '<form action="edition.php" method="post">';
		
				if (!empty($colonneDebut)) {
			
					echo '<div id="colonneDebut">';
				
					echo '<h3>Mots commençant par "'.$cleanLettre.'"</h3>';
					foreach ($colonneDebut as $mot) {
						echo '<input type="checkbox" checked="checked" name="debut[]" value="'.$mot.'" id="debut_'.$mot.'" /><label for="debut_'.$mot.'">'.$mot.'</label><br />';
					}
					echo '</div>';
				}
			
				if (!empty($colonneMilieu)) {

					echo '<div id="colonneMilieu">';
				
					echo '<h3>Mots contenant "'.$cleanLettre.'"</h3>';
					foreach ($colonneMilieu as $mot) {
					echo '<input type="checkbox" checked="checked" name="milieu[]" value="'.$mot.'" id="milieu_'.$mot.'" /><label for="milieu_'.$mot.'">'.$mot.'</label><br />';
					}
					echo '</div>';
				}
			
				if (!empty($colonneFin)) {
			
					echo '<div id="colonneFin">';
				
					echo '<h3>Mots finissant par "'.$cleanLettre.'"</h3>';
					foreach ($colonneFin as $mot) {
						echo '<input type="checkbox" checked="checked" name="fin[]" value="'.$mot.'" id="fin_'.$mot.'" /><label for="fin_'.$mot.'">'.$mot.'</label><br />';
					}
					echo '</div>';
				}
				
				echo '<p>';
				echo '<input type="checkbox" name="editiontype[]" value="pdf" id="pdf" /><label for="pdf">PDF</label>';
				echo '<input type="checkbox" name="editiontype[]" value="excel" id="excel" /><label for="excel">Excel</label>';
				echo '</p>';
				
				
				echo '<div class="clear"><hr /></div>';
				echo '<p>';
				echo '<input type="hidden" name="lettre" value="'.$cleanLettre.'" />';
				echo '<input type="submit" name="submit" value="Editer">';
				echo '</p>';
			}
		?>
		
	</body>
</html>