<?php
    defined('__EAPPEL__') or die('Acces interdit');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>e-Appel</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="application/styles/e-appel.css" />
        <?php $this->linkCSS();?>
    </head>
    <body>        
        <?php $this->vue(); ?>        
    </body>
</html>
