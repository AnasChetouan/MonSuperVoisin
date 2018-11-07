
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8"/>
			<title><?php echo $pageTitle; ?></title>
			<link rel="stylesheet" href="style/css/style.css" />
			
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