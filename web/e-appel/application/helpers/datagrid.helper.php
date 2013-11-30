<?php
    defined('__EAPPEL__') or die('Accès interdit');
    
    class DatagridHelper
    {
        public static function lienTri($nom, $ordre, $tri)
        {
            $css = array('tri');
            
            if ($tri['order']==$nom)
            {
                $ordre = Requete::get('dir');                
                if ($nom==Requete::get('order'))
                {
                    if ($ordre == 'asc')
                    {
                        $css[] = 'desc';
                        $ordre = 'desc';
                    }
                    else
                    {
                        $css[] = 'asc';
                        $ordre = 'asc';
                    }
                }
                else 
                {
                    $css[] = 'asc';
                }
            }
            
            ?>
                <a href="<?php echo(Application::getURL().'&order='.strtolower($nom).'&tri='.$ordre); ?>"><?php echo($nom); ?><span class="<?php echo(implode(' ', $css)); ?>"></span></a>
            <?php
        }
    }
?>