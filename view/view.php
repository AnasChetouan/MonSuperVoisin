
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8"/>
			<title><?php echo $pageTitle; ?></title>
			<link rel="stylesheet" href="style/css/style.css" />
			<?php $nav = File::build_path(array('view','header', 'header.php'));
                        require $nav; ?>
		</head>
	<body>	
		<main>
	<?php

$filepath = File::build_path(array('view', $controller, $view.'.php')); //static::$controller est la variable $controller déclarer au debut de chaque classe
require $filepath;
?>

                </main>
	
    </body>
 
   
</html>