<?php

/***************************************************************************************/
/***********                      IMAGES FONCTIONS                             *********/
/***************************************************************************************/

function uploadFichier($fichier,$type=array(),$content_dir){ 

    if( isset($_FILES[$fichier]) && is_uploaded_file($_FILES[$fichier]['tmp_name']) ) {     


            // On defini quelques
            if (!file_exists($content_dir)) {
                mkdir($content_dir,777,true);       
            }
            //$content_dir = 'images/articles/'; // dossier où sera déplacé le fichier
            $tmp_file = $_FILES[$fichier]['tmp_name'];

            // On recupere l'extension du fichier
            /*$info = new SplFileInfo($_FILES[$fichier]['name']);
            $ext = $info->getExtension();*/

            $info = explode('.', $_FILES[$fichier]['name']);
            $ext = end($info);

            // On génère un nouveau nom aleatoire et on le complète evec l'extension du fichier
            $lettres = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $new_name = substr(str_shuffle($lettres), 0, 15).'.'.$ext;

            // On l'assigne au nom du fichier recupéré 
            $_FILES[$fichier]['name'] = $new_name ;         
            $name_file = $_FILES[$fichier]['name'];
            if( !is_uploaded_file($tmp_file) ){
                //exit("Le fichier est introuvable");
             }

            // on vérifie maintenant l'extension
            //$type_file = $_FILES[$fichier]['type'];
            if( !in_array(strtolower($ext),$type)){
            $type = implode(', ',$type);
                $msg = "<span class ='noir'>Erreur :</span> le fichier n\'est pas de type <span class ='noir'>$type</span>";
                flash($msg,"error",true,8);
                exit("Le fichier n'est pas de type correct");
             }
            // on fait un test de sécurité
            if( preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name_file) ) {
                $msg = "<span class ='noir'>Erreur :</span> le nom du fichier n\'est pas <span class ='noir'>Valide</span>";
                flash($msg,"error",true,8);
                exit("Nom de fichier non valide");
            }

            // on copie le fichier dans le dossier de destination
            if( !move_uploaded_file($tmp_file, $content_dir.$name_file) ) {
                $msg = "<span class ='noir'>Erreur :</span> impossible de copier le fichier dans <span class ='noir'>$content_dir</span>";
                flash($msg,"error",true,8);
                exit("Impossible de copier le fichier dans $content_dir");
            }

            if (strstr($_FILES[$fichier]['type'], 'image')) {
                $thumbs_dir = $content_dir.'/thumbs';
                if (!file_exists($thumbs_dir)) {
                    mkdir($thumbs_dir,777,true);
                }
                resizeImage(($content_dir . $name_file), ($thumbs_dir.'/'. $name_file), 50, 40, $proportional=true);
                //resizeImage(($content_dir . $name_file), ($thumbs_dir.'/__'. $name_file), 2000, 1600, $proportional=true);
                //cropImage(($content_dir . $name_file), ($thumbs_dir.'/BB__'. $name_file), 0, 100, 1000, 300);
            }

                        
            //echo "Le fichier a bien été uploadé";
            echo '<script type="text/javascript"> 
                    $("#hidden'.$fichier.'").val("'.$name_file.'");
                </script>';


    }else{
        return false;
    }


}




function uploadFichier2($fichier,$type=array(),$content_dir,$name=null){ 

    if( isset($_FILES[$fichier]) && is_uploaded_file($_FILES[$fichier]['tmp_name']) ) {     

            
            // On defini quelques
            if (!file_exists($content_dir)) {
              mkdir($content_dir,777);
            }
            //$content_dir = 'images/articles/'; // dossier où sera déplacé le fichier
            $tmp_file = $_FILES[$fichier]['tmp_name'];

            $info = explode('.', $_FILES[$fichier]['name']);
            $ext = end($info);

            // On génère un nouveau nom aleatoire et on le complète evec l'extension du fichier
            $lettres = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $new_name = (!is_null($name) ? $name : substr(str_shuffle($lettres), 0, 15)).'.'.$ext;

            // On l'assigne au nom du fichier recupéré 
            $_FILES[$fichier]['name'] = $new_name ;         
            $name_file = $_FILES[$fichier]['name'];
                if( !is_uploaded_file($tmp_file) ){
                //exit("Le fichier est introuvable");
             }
         
            if( !in_array(strtolower($ext),$type)){
            $type = implode(', ',$type);
                /*$msg = "<span class ='noir'>Erreur :</span> le fichier n\'est pas de type <span class ='noir'>$type</span>";
                flash($msg,"error",true,8);*/
                return "Le fichier n'est pas de type correct";
             }
            // on fait un test de sécurité
            if( preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name_file) ) {
                $msg = "<span class ='noir'>Erreur :</span> le nom du fichier n\'est pas <span class ='noir'>Valide</span>";
                flash($msg,"error",true,8);
                exit("Nom de fichier non valide");
            }

            // on copie le fichier dans le dossier de destination
            if( !move_uploaded_file($tmp_file, $content_dir.$name_file) ) {
                $msg = "<span class ='noir'>Erreur :</span> impossible de copier le fichier dans <span class ='noir'>$content_dir</span>";
                flash($msg,"error",true,8);                
                exit;//("Impossible de copier le fichier dans $content_dir");
            }

            $_POST[$fichier] = $name_file;
            return true;
            
    }else{
        return false;
    }


}

function fileUpload($fichier,$content_dir){ 

    if(isset($_FILES[$fichier])){
        $name_array = $_FILES[$fichier]['name'];
        $tmp_name_array = $_FILES[$fichier]['tmp_name'];
        $type_array = $_FILES[$fichier]['type'];
        $size_array = $_FILES[$fichier]['size'];
        $error_array = $_FILES[$fichier]['error'];

        $images_uploaded = array();
        for($i = 0; $i < count($tmp_name_array); $i++){

            $info = explode('.', $name_array[$i]);
            $ext = end($info);
            // On génère un nouveau nom aleatoire et on le complète evec l'extension du fichier
            $lettres = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $new_name = substr(str_shuffle($lettres), 0, 15).'.'.$ext;
            $name_array[$i] = $new_name;
            if(!move_uploaded_file($tmp_name_array[$i], $content_dir.$name_array[$i])){                
                echo("Impossible de copier le fichier dans $content_dir");

            }else{
                $images_uploaded[] = $name_array[$i];
            }
        }
        return($name_array);
    }

}


/* 
    * source : www.petitcode.com 
    * 
    * - $file_src : Le chemin de l'image source (), l'image qui va être redimensionnée
    * - $file_dest : Le chemin de la nouvelle image, qui va être créée. Si vous voulez écraser la première image, mettez le même chemin dans $file_src et $file_dest.
    * - $new_width : La nouvelle largeur en pixel
    * - $new_height : La nouvelle hauteur en pixel
    * - $proportional : Argument boolean optionnel, si égale à true alors les dimensions de l'image de destination seront proportionnelles à ceux de l'image source, et donc pas forcement $new_width x $new_height,
    *                         sinon les dimensions seront exactement $new_width x  $new_height
    */
    
  function resizeImage($file_src, $file_dest, $new_width, $new_height, $proportional=true) {   
    $attr=getimagesize($file_src);
    $fw=$attr[0]/$new_width;
    $fh=$attr[1]/$new_height;
    
    if($proportional)
      $f=$fw>$fh?$fw:$fh;
    else
      $f=$fw>$fh?$fh:$fw;

    $w=$attr[0]/$f;
    $h=$attr[1]/$f;
        
    $file_src_infos=pathinfo($file_src);
    
    $ext=strtolower($file_src_infos['extension']);
    if($ext=="jpg")
      $ext="jpeg";
    
    $func="imagecreatefrom".$ext;
    $src  = $func($file_src);
    
    // Création de l'image de destination. La taille de la miniature sera wxh 
    $x=0;
    $y=0;
    if($proportional)
      $dest = imagecreatetruecolor($w,$h);
    else
    {
      $dest = imagecreatetruecolor($new_width,$new_height);
      $x=($new_width-$w)/2;
      $y=($new_height-$h)/2;
    }

    // Configuration du canal alpha pour la transparence
    imagealphablending($dest,false);
    imagesavealpha($dest,true);

    // Redimensionnement de src sur dest 
    imagecopyresampled($dest,$src,$x,$y,0,0,$w,$h,$attr[0],$attr[1]);

    $func="image".$ext;
    $func($dest, $file_dest);
    imagedestroy($dest);
    
    return true;    
  }


/* 
    * source : www.petitcode.com 
    * 
    * - $file_src : Le chemin de l'image source, l'image qui va être recadrée
    * - $file_dest : Le chemin de la nouvelle image, qui va être créée. Si vous voulez écraser la première image, mettez le même chemin dans $file_src et $file_dest.
    * - $x : L'abscisse du coin haut gauche du cadre
    * - $y : L'ordonnée du coin haut gauche du cadre
    * - $width : La largeur du cadre
    * - $height : La hauteur du cadre
    */
    
  function cropImage($file_src, $file_dest, $x, $y, $width, $height)
  {
    //dest
    $dest=imagecreatetruecolor($width,$height);
    imagealphablending($dest,false);
    imagesavealpha($dest,true);
    
    //src
    $file_src_infos=pathinfo($file_src);
    $ext=strtolower($file_src_infos['extension']);
    if($ext=="jpg")
      $ext="jpeg";
    
    // Création de l'image de destination.
    $func="imagecreatefrom".$ext;
    $src  = $func($file_src);
    
    imagecopy($dest, $src, 0, 0, $x, $y, $width, $height);
    
    $func="image".$ext;
    $func($dest, $file_dest);
    imagedestroy($dest);
  }





























 