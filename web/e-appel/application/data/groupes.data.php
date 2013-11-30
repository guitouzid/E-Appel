<?php
    defined('__EAPPEL__') or die ('Accès Interdit');
    
    class Groupes extends DataTable
    {
        public function lister()
        {
            $sql = "SELECT id, CONCAT(cursus,'A',annee,'G',numero) AS nom
                    FROM groupes
                    ORDER BY cursus, annee, numero";
            $req = $this->db->prepare($sql);
            
            try
            {
                $req->execute();
            }
            catch (PDOException $err)
            {
                throw new Erreur('Erreur SQL'.$err->getMessage());
            }
            
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function getGroupe($id)
        {
            $sql = "SELECT *, CONCAT(cursus,'A',annee,'G',numero) AS groupe
                    FROM groupes
                    WHERE id=:id";
            $sql = $this->db->prepare($sql);
            
            $sql->bindValue(':id', $id);
            
            try
            {
                $sql->execute();
            }
            catch (PDOException $e)
            {
                throw new Erreur('Erreur SQL : '.$e->getMessage());
            }
            
            return $sql->fetch();
        }
    }
?>