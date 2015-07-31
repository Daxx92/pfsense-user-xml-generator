<?php 

require_once '../classes/FileHelper.php';
$lang = require_once '../config/lang.php';

$fileHelper = new FileHelper();

$files = $fileHelper->listCsvFiles();

?>

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
			
			<h1> <?php echo $lang['pages']['options']['h1']; ?> </h1>

			<form action="output.php" method="post" enctype="multipart/form-data">
				<?php echo $lang['pages']['options']['file']; ?>
				<select name="csv" id="csv">
					<option value="0"> <?php echo $lang['pages']['options']['form']['default']; ?> </option>
					<?php
						foreach ($files as $file) {
							echo '<option value="' . $file . '"> ' . $file . ' </option>';
						}
					?>
				</select>

				<br/><br/>
				<?php echo $lang['pages']['options']['uid']; ?>
				<input type="number" min="0" name="id" id="id"/>

				<br/><br/>
				<?php echo $lang['pages']['options']['format']; ?>
				<select name="escaped" id="escaped">
					<option value="y"><?php echo $lang['pages']['options']['form']['html-output']; ?></option>
					<option value="n"><?php echo $lang['pages']['options']['form']['source-output']; ?></option>
				</select>
				
				<br/><br/>

				<input type="submit" value="<?php echo $lang['pages']['options']['form']['submit']; ?>">
			</form>


			<hr/>
			<a href="index.php"> <?php echo $lang['link-text']['file-upload']; ?> </a>

		</div>


	</body>
</html>