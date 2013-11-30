<?php   defined('__EAPPEL__') or die ('Accès Interdit'); ?>

<!DOCTYPE html>
<div id='liste_groupes'>
    <ul>
        <?php foreach ($this->groupes as $G) { ?>
            <li><a groupe3il='<?php echo($G['id']); ?>' href="index.php?controller=groupes&action=detail&id=<?php echo($G['id']); ?>"><?php echo($G['nom']); ?></a></li>
        <?php } ?>
    </ul>
</div>
<div id="detail_groupe">
    
</div>
