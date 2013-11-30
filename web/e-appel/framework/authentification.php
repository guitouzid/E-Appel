<?php
    defined('__FRAMEWORK3IL__') or die ('Accès Interdit');

    class Authentification
    {
        protected static $_authentification = NULL;
        protected $utilisateur = NULL;
        protected $table;
        protected $colLogin;
        protected $colMotdepasse;
        protected $colIdentifiant;

        private function __construct($table, $colIdentifiant, $colLogin, $colMotdepasse) 
        {
            $this->table = $table;
            $this->colIdentifiant = $colIdentifiant;
            $this->colLogin = $colLogin;
            $this->colMotdepasse = $colMotdepasse;
            
            if (isset($_SESSION['framework3il.message']))
            {
                self::chargerUtilisateur();
            }
        }        
        
        public static function getAuthentification($table = NULL, $colIdentifiant = NULL, $colLogin = NULL, $colMotdepasse = NULL)
        {
            if (is_null(self::$_authentification) === TRUE)
            {
                if ($table == NULL || $colIdentifiant == NULL || $colLogin == NULL || $colMotdepasse == NULL)
                {
                    die("Les champs de l'authentication ne doivent pas être vides !");
                }
                else
                {
                    self::$_authentification = new Authentification($table, $colIdentifiant, $colLogin, $colMotdepasse);
                }
            }
            
            return self::$_authentification;
        }
        
        public static function authentifier($login, $motdepasse)
        {
            $application = Application::getApplication();
            
            $sql = "SELECT ".self::$_authentification->colIdentifiant." FROM ".self::$_authentification->table." WHERE ".self::$_authentification->colLogin."=:login AND ".self::$_authentification->colMotdepasse."=:motdepasse LIMIT 1";
            $req = $application->getDb()->prepare($sql);
            $req->bindValue(':login', $login);
            $req->bindValue(':motdepasse', md5($motdepasse));
            
            try
            {
                $req->execute();
            }
            catch(PDOException $e)
            {
                throw new Erreur('Erreur SQL : '.$e->getMessage());
            }
            
            $id = $req->fetchColumn();
            
            if ($id == FALSE)
            {
                return FALSE;
            }
            else
            {
                print_r("ID : ".$id);
                Message::deposer($id);
                return TRUE;
            }
        }
        
        protected function chargerUtilisateur()
        {
            $application = Application::getApplication();
            
            $sql = "SELECT * FROM utilisateurs WHERE id=:id";
            
            $req = $application->getDb()->prepare($sql);
            $req->bindValue(':id', $_SESSION['framework3il.message']);
            
            try
            {
                $req->execute();
            }
            catch(PDOException $e)
            {
                throw new Erreur('Erreur SQL : '.$e->getMessage());
            }
            $req = $req->fetch();
            
            // On cache le mot de passe
            $req['motdepasse'] = 'trolololololo....';
            
            $this->utilisateur = $req;
        }
        
        public function deconnecter()
        {
            $this->utilisateur = NULL;
            unset($_SESSION['framework3il.message']);
        }
        
        public function estConnecte()
        {
            if (self::$_authentification->utilisateur == NULL)
            {
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        
        public function getUtilisateur()
        {
            if (self::$_authentification->utilisateur == NULL)
            {
                return FALSE;
            }
            else
            {
                return self::$_authentification->utilisateur;
            }
        }
        
        public function getUtilisateurId()
        {
            if (self::$_authentification->utilisateur == NULL)
            {
                return FALSE;
            }
            else
            {
                return self::$_authentification->utilisateur[$this->colIdentifiant];
            }
        }
        
        public static function encoder($motdepasse)
        {
            
        }
        
        public static function saler($str)
        {
            
        }
    }
?>
