<!doctype html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Générateur de liste de mots - échelle Dubois-Buyse</title>
		<link rel="stylesheet" href="dubois.css" media="all">
	</head>
	<body>
<?php
     echo  '<form action="index.php" method="post">';
        echo '<p>';
        echo 'Suite de lettres recherchées';
        echo '<input type="text" name="lettre" '; 

        if (isset($_POST['lettre']))
            echo 'value="'.htmlspecialchars($_POST['lettre'], ENT_QUOTES).'"';

        echo ' />';
        echo  '</p>';

        echo  '<p>';
        echo '<input type="checkbox" name="place[]" value="debut" id="debut" ';

        if (isset($_POST['place']))
            if (in_array('debut', $_POST['place']))
                echo 'checked="checked"';

        echo' />';
        echo '<label for="debut">Début du mot</label>'; 
        echo '</p>';

        echo '<p>';
        echo '<input type="checkbox" name="place[]" value="milieu" id="milieu" ';

        if (isset($_POST['place']))
            if (in_array('milieu', $_POST['place']))
                echo 'checked="checked"';

        echo ' />';
        echo '<label for="milieu">Milieu du mot</label>'; 
        echo '</p>';

        echo '<p>';
        echo '<input type="checkbox" name="place[]" value="fin" id="fin" ';

        if (isset($_POST['place']))
            if (in_array('fin', $_POST['place']))
                echo 'checked="checked"';
		
        echo ' />';
        echo  '<label for="fin">Fin du mot</label>'; 
        echo '</p>';

        echo '<p>';
        echo 'Classe';
        echo '<input type="checkbox" name="classe[]" id="cp" value="CP" ';

        if (isset($_POST['classe']))
            if (in_array('CP', $_POST['classe']))
                echo 'checked="checked"';

        echo '><label for="cp">CP</label>';

        echo '<input type="checkbox" name="classe[]" id="ce1" value="CE1" ';

        if (isset($_POST['classe']))
            if (in_array('CE1', $_POST['classe']))
                echo 'checked="checked"';

        echo '><label for="ce1">CE1</label>';

        echo '<input type="checkbox" name="classe[]" id="ce2" value="CE2" ';

        if (isset($_POST['classe']))
            if (in_array('CE2', $_POST['classe']))
                echo 'checked="checked"';

        echo '><label for="ce2">CE2</label>';

        echo '<input type="checkbox" name="classe[]" id="cm1" value="CM1" ';

        if (isset($_POST['classe']))
            if (in_array('CM1', $_POST['classe']))
                echo 'checked="checked"';

        echo '><label for="cm1">CM1</label>';

        echo '<input type="checkbox" name="classe[]" id="cm2" value="CM2" ';

        if (isset($_POST['classe']))
            if (in_array('CM2', $_POST['classe']))
                echo 'checked="checked"';

        echo '><label for="cm2">CM2</label>';

        echo  '<input type="checkbox" name="classe[]" id="6eme" value="6ème" ';

        if (isset($_POST['classe']))
            if (in_array('6ème', $_POST['classe']))
                echo  'checked="checked"';

        echo '><label for="6eme">6ème</label>';

        echo '<input type="checkbox" name="classe[]" id="5eme" value="5ème" ';

        if (isset($_POST['classe']))
            if (in_array('5ème', $_POST['classe']))
                echo 'checked="checked"';

        echo '><label for="5eme">5ème</label>';

        echo '<input type="checkbox" name="classe[]" id="4eme" value="4ème" ';

        if (isset($_POST['classe']))
            if (in_array('4ème', $_POST['classe']))
               echo 'checked="checked"';

        echo '><label for="4eme">4ème</label>';

        echo '<input type="checkbox" name="classe[]" id="3eme" value="3ème"';

        if (isset($_POST['classe']))
            if (in_array('3ème', $_POST['classe']))
                echo 'checked="checked"';

        echo '><label for="3eme">3ème</label>';

        echo '<input type="checkbox" name="classe[]" id="2nd" value="2nd" ';

        if (isset($_POST['classe']))
            if (in_array('2nd', $_POST['classe']))
                echo 'checked="checked"';
		
        echo '><label for="2nd">2nd</label>';

        echo '</p>';

        echo '<p>';
        echo '<input type="submit" name="submit" value="Rechercher" />';
        echo '</p>';

        echo '</form>';
?>

	    <?php //echo $content; ?>
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