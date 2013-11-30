<?php 
    $login = '';
    $motdepasse = '';
    $erreur = '';
    
    if (!empty($_POST))
    {
        $login = $_POST['login'];
        $motdepasse = $_POST['motdepasse'];
        
        if (empty($_POST['login'])) $erreur = 'Login manquant';
        if (empty($_POST['motdepasse'])) $erreur = 'Mot de passe manquant';
    }
    
    redirigerUrl ('destinataire.php');
    
    function redirigerUrl($url)
    {
        if (!headers_sent())
        {
            header('Location:'.$url);
            echo ("Test3");
        }
        else 
        {
            ?>
                <script type="text/javascript">
                    window.location = '<?php echo ($url); ?>';
                </script>
            <?php
            echo ("Test4");
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="e-appel.css">
    </head>
    <body>
        <?php 
            if ($erreur)
            {
                ?>
                    <p>
                        <?php echo ($erreur); ?>
                    </p>
                <?php 
            }
        ?>
        <form action="login.php" method="POST">
            <label for="login">Login</label>
            <input type="text" name="login" id="login" value="<?php echo ($login) ?>"/>
            <label for="motdepasse">Mot de passe :</label>
            <input type="password" name="motdepasse" id="motdepasse" value="<?php echo ($motdepasse) ?>"/>
            <input type="submit" value="Se Connecter"/>
        </form>
    </body>
</html>
