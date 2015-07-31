<?php 

$lang = require_once '../config/lang.php';

$error = false;
$content = '';

if( isset( $_POST['id'] ) && isset( $_POST['csv'] ) && isset( $_POST['escaped'] )){
	//Import required classes
	require_once '../classes/OutputHelper.php';
	require_once '../classes/UserXmlGenerator.php';
	require_once '../classes/pfSenseEncrypt.php';

	//Crete objects
	$outputHelper = new OutputHelper();
	$userXmlGenerator = new UserXmlGenerator( new pfSenseEncrypt() );

	//Generate users as XML
	$xmlArray = $userXmlGenerator->createUsersXML( intval( $_POST['id'] ), $_POST['csv'] );

	$content = implode('', $xmlArray);

	//Should the output be escaped?
	if( $_POST['escaped'] == 'y' ){
		//Escape it and replace new lines with <br/>
		$content = nl2br( htmlentities( $content, ENT_QUOTES ) );
	}

}
else{
	$error = true;
	$content = $lang['messages']['missing'];
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
		
		<?php if( $error ) : ?>
			<h1 class="failure"> <?php echo $content; ?> </h1>
			<a href="settings.php"> <?php echo $lang['link-text']['file-config']; ?> </a>
		<?php else : ?>

			<code>
<?php echo $content ?>
			</code>

		<?php endif; ?>


	</body>
</html>