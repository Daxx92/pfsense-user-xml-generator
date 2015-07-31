<?php $lang = require_once '../config/lang.php' ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title> <?php echo $lang['general']['page-title']; ?> </title>

		<link href="css/styles.css" rel="stylesheet">

	</head>
	<body>
		<div class="center">
			
			<h1> <?php echo $lang['pages']['index']['h1']; ?> </h1>

			<p>
				<?php echo $lang['pages']['index']['note']; ?>
			</p>

			<ul>
				<?php
					foreach( $lang['pages']['index']['fields'] as $field ){
						echo '<li>'. $field .'</li>';
					}
				?>
			</ul>

			<form action="upload.php" method="post" enctype="multipart/form-data">
				<?php echo $lang['pages']['index']['form']['file']; ?>
				<input type="file" name="csv" id="csv">
				<input type="submit" value="<?php echo $lang['pages']['index']['form']['submit']; ?>" name="submit">
			</form>

			<hr/>
			<a href="settings.php"> <?php echo $lang['link-text']['file-config']; ?> </a>

		</div>


	</body>
</html>