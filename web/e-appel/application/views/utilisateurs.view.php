<?php   
    defined('__EAPPEL__') or die ('Accès Interdit'); 
    require_once './application/helpers/datagrid.helper.php';
?>

<?php if (!empty($this->message)) { ?>
    <p class="message">
        <?php echo($this->message); ?>
    </p>
<?php } ?>
<table id="liste_enseignants" class="datagrid">
    <caption>Liste des Enseignants
        <form action="index.php" method="GET">
            <input type="hidden" name="controller" value="utilisateurs" />
            <input type="hidden" name="action" value="creer" />
            <input type="submit" value="Créer un Utilisateur" />
        </form>
    </caption>
    <thead>
        <tr>
            <th><?php DatagridHelper::lienTri('Nom', 'asc', $this->tri) ?></th>
            <th><?php DatagridHelper::lienTri('Prénom', 'asc', $this->tri) ?></th>
            <th><?php DatagridHelper::lienTri('Login', 'asc', $this->tri) ?></th>
            <th><?php DatagridHelper::lienTri('Email', 'asc', $this->tri) ?></th>
            <th><?php DatagridHelper::lienTri('Type', 'asc', $this->tri) ?></th>
            <th>Commandes <span class="tri"></span></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($this->utilisateurs as $utilisateur) { ?>
        <tr>
            <td><?php echo $utilisateur['nom']; ?></td>
            <td><?php echo $utilisateur['prenom']; ?></td>
            <td><?php echo $utilisateur['login']; ?></td>
            <td><?php echo $utilisateur['email']; ?></td>
            <td><?php if ($utilisateur['type']==1) 
                {
                    echo("Admin");
                }
                else
                {
                    echo("Utilisateur");
                }
                ?>
            </td>
            <td>
                <form action="index.php" method="GET">
                    <input type="hidden" name="controller" id="controller" value="utilisateurs" />
                    <button type="submit" name="action" value="editer"><img src="./application/images/icone_editer.png" alt="Editer" title="Editer" /></button>
                    <button type="submit" name="action" value="supprimer"><img src="./application/images/icone_supprimer.png" alt="Supprimer" title="Supprimer" /></button>
                    <input type="hidden" name="id" id="id" value="<?php echo $utilisateur['id']; ?>" />
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>