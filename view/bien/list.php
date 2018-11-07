<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Liste des biens</title>
    </head>
    <body>
        <?php
        foreach ($tab_b as $b)
            echo '<p> Bien d\'id  ' . $b->getIdBien() . '.</p>';
        ?>
    </body>
</html>