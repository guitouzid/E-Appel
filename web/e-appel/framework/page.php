<?php
    defined('__FRAMEWORK3IL__') or die ('Accès Interdit');
    
    class Page {

       private static $_instance = null;
       protected $vue = '';
       protected $template = '';
       protected $css = array();
       protected $scripts = array();
       
       public function __construct() 
       {  
           
       }

       public static function getInstance() 
       {
         if(is_null(self::$_instance)) 
         {
           self::$_instance = new Page();  
         }

         return self::$_instance;
       }
       
       public function setVue($vue) 
       {
          $vue = 'application/views/'.$vue.'.view.php';
          if (file_exists($vue))
          {
              $this->vue=$vue;
          }
          else
          {
              throw new Erreur("Le fichier vue n'existe pas");
          }
       }
       
       public function setTemplate($template) 
       {
          $template = 'application/templates/'.$template.'.template.php';
          if (file_exists($template))
          {
              $this->template=$template;
          }
          else
          {
              throw new Erreur("Le fichier template n'existe pas");
          }
       }
       
       public function afficher()
       {
           if ($this->template=='') throw new Erreur("Le fichier template n'a pas été renseigné");
           require_once $this->template;
       }
       
       public function vue()
       {
           if ($this->vue=='') throw new Erreur("Le fichier vue n'a pas été renseigné");
           require_once $this->vue;
       }
       
       public function ajouterCSS($css)
       {
           $css = 'application/styles/'.$css.'.css';
           if (file_exists($css))
           {
               $this->css[] = $css;
           }
           else
           {
               throw new Erreur("Le fichier css n'existe pas");
           }
       }
       
       public function ajouterScript($js)
       {
           $js = 'application/javascript/'.$js.'.js';
           if (file_exists($js))
           {
               $this->scripts[] = $js;
           }
           else
           {
               throw new Erreur("Le fichier javascript n'existe pas");
           }
       }
       
       public function linkCSS()
       {
           $html = '';
           foreach ($this->css as $style)
           {
               $html .= "<link rel='stylesheet' type='text/css' href='".$style."'>";
           }
           echo ($html);
       }
       
       public function linkScripts()
       {
           $html = '';
           foreach ($this->scripts as $js)
           {
               $html .= "<script type='text/javascript' src='".$js."'></script> ";
           }
           echo ($html);
       }
    }

?>
 