<?php 
/*$zp = zip_open($dossier_img.'test.zip');
$img_tab = array();
while ($file = zip_read($zp)) {
	var_dump($file);
    //echo  zip_entry_name($file).PHP_EOL;
    //$img_tab[] = zip_entry_name($file);
}*/


$img_tab = array();
if(isset($article['photos-zip']) && file_exists($dossier_img.$article['photos-zip'])){

	$current_archive = $article['photos-zip'];
	$current_dossier = $article['slug_fr'];


	if(!file_exists($dossier_img.$current_dossier) ){
		$zip = new ZipArchive;
		$openned = $zip->open($dossier_img.$current_archive);
		if ($openned === TRUE) {
			if(!file_exists($dossier_img.$current_dossier)){
				$zip->extractTo($dossier_img.$current_dossier);
		  		$zip->close();
			}
		  
		}
	}

	if(file_exists($dossier_img.$current_dossier) && $dossier = opendir($dossier_img.$current_dossier)){
		while(false !== ($fichier = readdir($dossier))){
			if($fichier != '.' && $fichier != '..' && $fichier != 'index.php'){
				$img_tab[] = $current_dossier.'/'.$fichier;
			}		
		}
	}

}

