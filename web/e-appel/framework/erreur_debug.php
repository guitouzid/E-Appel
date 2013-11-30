<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Erreur</h1>
        <p>Erreur : <?php echo($this->message); ?></p>
        <p>Fichier : <?php echo($this->file); ?></p>
        <p>Ligne : <?php echo($this->line); ?></p>
        <p>Fonction : <?php echo($trace[0]['function']); ?></p>
        <pre><?php echo($this->getTraceAsString()); ?></pre>
    </body>
</html>
