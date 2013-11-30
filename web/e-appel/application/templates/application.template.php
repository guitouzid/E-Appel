<?php   
    defined('__EAPPEL__') or die ('Accès Interdit'); 
    $utilisateur = Authentification::getAuthentification()->getUtilisateur();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Template <?php echo(basename(__FILE__)); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <?php $this->linkCSS(); ?>
    </head>
    <body>
        <pre>
            <?php //print_r(Authentification::getAuthentification()); ?>
        </pre>
        <div class="conteneur">
            <div id="entete">
                <div id="utilisateur">
                    <p><?php echo($utilisateur['nom']." ".$utilisateur['prenom']) ?></p>
                    <form action="index.php?controller=utilisateurs&action=deconnecter" method="GET">
                        <input id="submit" type="submit" value="Déconnexion" />
                    </form>
                </div>
                <h1><a href=""><img src="./application/images/e-appel_logo.png" alt="logo"></a></h1>
            </div> 
            <nav id="menu_principal">
                <?php MenuPrincipal::afficher(); ?>
            </nav>
            <section>
                <?php $this->vue(); ?>
        
                <?php $this->linkScripts(); ?>
            </section>
        </div>
    </body>
</html>
