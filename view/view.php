
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8"/>
			<title><?php echo $pageTitle; ?></title>
			<link rel="stylesheet" href="style/css/style.css" />
			<meta charset="UTF-8">
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
			<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<?php $nav = File::build_path(array('view','header', 'header.php'));
                        require $nav; ?>
		</head>
	<body>	
		<main style= "margin: 2%">
	<?php

$filepath = File::build_path(array('view', $controller, $view.'.php')); //static::$controller est la variable $controller déclarée au debut de chaque classe
require $filepath;
?>

                </main>
	
            			<?php $foot = File::build_path(array('view','footer', 'footer.php'));
                        require $foot; ?>
 
</html>