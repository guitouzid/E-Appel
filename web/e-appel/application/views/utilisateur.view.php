<?php   defined('__EAPPEL__') or die ('Accès Interdit'); ?>

<h2><?php echo($this->titre); ?></h2>

<div id="utilisateurForm">
    <form action="index.php?controller=utilisateurs&action=editer" method="POST">
        <?php if (isset($this->erreurs) && !empty($this->erreurs)) { ?>
            <?php foreach ($this->erreurs as $erreur) { ?>
                <li><?php echo ($erreur); ?></li>
            <?php } ?>
        <?php } ?>
        <ul>
            <input type="hidden" name="id" id="id" value='<?php echo($this->id); ?>'/>
            <dt><label for="login">Login</label></dt>
            <dd><input <?php echo($this->edition); ?> type="text" name="login" id="login" value='<?php echo($this->login); ?>' /></dd>

            <dt><label for="nom">Nom</label></dt>
            <dd><input type="text" name="nom" id="nom" value='<?php echo($this->nom); ?>'/></dd>

            <dt><label for="prenom">Prénom</label></dt>
            <dd><input type="text" name="prenom" id="prenom" value='<?php echo($this->prenom); ?>'/></dd>

            <dt><label for="email">Email</label></dt>
            <dd><input type="text" name="email" id="email" value='<?php echo($this->email); ?>'/></dd>

            <dt><label for="motPasse">Mot de passe :</label></dt>
            <dd><input type="password" name="motPasse" id="motPasse" value=''/></dd>

            <dt><label for="confirmation">Confirmation :</label></dt>
            <dd><input type="password" name="confirmation" id="confirmation" value=''/></dd>

            <input type="submit" value="Se Connecter"/>
        </ul>
    </form>
</div>
