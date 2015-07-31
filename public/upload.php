<?php 

require_once '../classes/FileHelper.php';
$lang = require_once '../config/lang.php';

$fileHelper = new FileHelper();
$message = "";
$success = false;

if( !isset( $_FILES['csv'] ) ){
	$message = $lang['messages']['missing'];
}
else if( !$fileHelper->uploadCSV( $_FILES['csv'], './' ) ){
	$message = $lang['messages']['upload']['failure'];
}
else{
	$message = $lang['messages']['upload']['success'];
	$success = true;
}

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
			<?php if( $success ) :?>
				<h1 class="success"> <?php echo $message; ?> </h1>
				<a href="settings.php"> <?php echo $lang['link-text']['file-config']; ?> </a>
			<?php else : ?>
				<h1 class="failure"> <?php echo $message; ?> </h1>
				<a href="index.php"> <?php echo $lang['link-text']['file-upload']; ?> </a>
			<?php endif; ?>

		</div>


	</body>
</html>