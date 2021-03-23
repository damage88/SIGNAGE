<?php 


require_once 'class/PHPExcel.class.php';
//var_dump($Phpexcel);
$masque =array(0 => 'numero',1 => 'prenom',2 => 'nom');

$objPHPExcel = PHPExcel_IOFactory::load($dossier_fich.'test.xlsx');
 
/**
* récupération de la première feuille du fichier Excel
* @var PHPExcel_Worksheet $sheet
*/
$sheet = $objPHPExcel->getSheet(0);

$contacts = array(); 
 
// On boucle sur les lignes
$i = 0;
$head = array();
foreach($sheet->getRowIterator() as $row) { 



		// On boucle sur les cellule de la ligne
	   $k = 0;
	   foreach ($row->getCellIterator() as $cell) {
	   		if($i == 0 && !is_null($cell->getValue())){
				$head[] = $cell->getValue();
			}
	   		echo ($cell->getValue());
		   	/*if($k <= (count($masque) - 1) ){
		   		//$contacts[$i][$masque[$k]] = !is_null($cell->getValue()) ? $cell->getValue() : '' ;
		   		$contacts[$i]['id'] = '';
		   		$contacts[$i]['id_user'] = $_SESSION['auth']['id'];
		   		$contacts[$i]['date_enreg'] = gmdate('Y-m-d H:i:s');
		   		$contacts[$i]['id_repertoire'] = $id_repertoire;
		   		if($masque[$k] == 'numero'){
		   			$contacts[$i][$masque[$k]] = !is_null($cell->getValue()) ? trimUltime($cell->getValue()) : '' ;
		   		}else{
		   			$contacts[$i][$masque[$k]] = !is_null($cell->getValue()) ? ucfirst($cell->getValue()) : '' ;
		   		}
		   		
		   	}
	      	$k ++;*/


	   }


 
   $i++;
   echo '<br>';
}

			
var_dump($head);			