<!doctype html>
<html lang="fr">
    <head>
		<meta charset="UTF-8">
		<title>Générateur de liste de mots - échelle Dubois-Buyse</title>
		<link rel="stylesheet" href="dubois.css" media="all">
	</head>
	<body>
        <h1>Générateur de liste de mots</h1>

        <div id="errors">
         <?php

             foreach ($errors as $error) {
                 echo $error.'<br />';
             }
         ?>
        </div>
          <?php echo $content; ?>
          <script type="text/javascript"src="js/jquery.js"></script>
          <script type="text/javascript"src="js/select.js"></script>
     </body>
</html>
