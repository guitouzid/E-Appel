<?php
    defined('__EAPPEL__') or die ('Accès Interdit');
    
    class Utilisateurs extends DataTable
    {
        public function lister($order = '', $dir = '')
        {
            $sql = 'SELECT * FROM utilisateurs
                    ORDER BY '.$order.' '.$dir;
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
        
        public function creer($login, $nom, $prenom, $email, $pwd)
        {
            $sql = 'INSERT INTO Utilisateurs(login, nom, prenom, motdepasse, email, type) VALUES (:login, :nom, :prenom, :pwd, :email, :type)';
            $sql = $this->db->prepare($sql);
            
            $sql->bindValue(':login', $login);
            $sql->bindValue(':nom', $nom);
            $sql->bindValue(':prenom', $prenom);
            $sql->bindValue(':pwd', md5($pwd));
            $sql->bindValue(':email', $email);
            $sql->bindValue(':type', 1);
            
            try
            {
                $sql->execute();
            }
            catch (PDOException $e)
            {
                throw new Erreur('Erreur SQL : '.$e->getMessage());
            }
            
            return $sql;
        }
        
        public function supprimer($id)
        {
            $sql = 'DELETE FROM utilisateurs WHERE id = :id';
            $req = $this->db->prepare($sql);
            $req->bindValue(':id', $id);
            
            try
            {
                $req->execute();
            }
            catch (PDOException $e)
            {
                throw new Erreur('Erreur SQL : '.$e->getMessage());
            }
            
            return $req;
        }
        
        public function modifier($id, $nom, $prenom, $email, $pwd)
        {
            if (empty($pwd))
            {
                $sql = 'UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email WHERE id = :id';
                $sql = $this->db->prepare($sql);
            }
            else
            {
                $sql = 'UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email, motdepasse = :pwd WHERE id = :id';
                $sql = $this->db->prepare($sql);
                $sql->bindValue(':pwd', md5($pwd));
            }
            $sql->bindValue(':nom', $nom);
            $sql->bindValue(':prenom', $prenom);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':id', $id);
            
            try
            {
                $sql->execute();
            }
            catch (PDOException $e)
            {
                throw new Erreur('Erreur SQL : '.$e->getMessage());
            }
            
            return $sql;
        }
        
        public function utilisateur($id)
        {
            $sql = 'SELECT * FROM utilisateurs WHERE id = :id';
            $req = $this->db->prepare($sql);
            $req->bindValue(':id', $id);
            
            try
            {
                $req->execute();
            }
            catch(PDOException $e)
            {
                throw new Erreur('Erreur SQL : '.$e->getMessage());
            }
            
            return $req->fetch();
        }
    }
?>