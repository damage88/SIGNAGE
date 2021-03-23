<?php


/*
* CLASS D'INTERACTION AVEC MA BASE DE DONNEES (UTILISATION DE PDO)
* Elle est chargée d'effectuer tout ce qui est CRUD au niveau de ma base de données.
*/
class Model {

	

	private $BDD 		= null;
	private $__PARAMS__ = array();
	private $HOSTNAME 	= "localhost";
	private $DBNAME 	= "okiosk";
	private $USERNAME 	= "root";
	private $PASSWORD 	= "";
	private $PORT 		= "";

	public function __construct(){
		try{
			$params = file_get_contents(RACINE.'/env');
			$params = preg_replace("#\n|\t|\r#","",$params);
			$params = explode(';', $params);
			if(!empty($params)){
				foreach ($params as $key => $value) {
					$line = explode('=', $value);					
					$this->__PARAMS__[trimUltime($line[0])] = isset($line[1]) ? trim($line[1]) : null;
				}
			}
			//$__PARAMS__ = baseParams();
			//$this->BDD = new PDO('mysql:host='.$this->HOSTNAME.';dbname='.$this->DBNAME.'', ''.$this->USERNAME.'', ''.$this->PASSWORD.'',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$this->BDD = new PDO('mysql:host='.$this->__PARAMS__['HOSTNAME'].';dbname='.$this->__PARAMS__['DBNAME'].'', ''.$this->__PARAMS__['USERNAME'].'', ''.$this->__PARAMS__['PASSWORD'].'',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		}catch(Exception $err){
			exit($err->getMessage());
		}
	}	

	public function getDbObjet(){
		return $this->BDD;
	}
	
	public function loadOne($id,$table){
		$load_q = $this->BDD->prepare("SELECT * FROM {$table}  WHERE id = :id AND valid = 1");
		$load_q->execute(array('id' => $id));
		$load = $load_q->fetch(PDO::FETCH_ASSOC);
		return $load;
	}


	/*
	*	Verifie les champs de la table passé en parametre par rapport aux données présentent dans le 
	*	tableau à inserer. affiche les champs manquants et retourne le tableau nettoyé!
	*	@data = tableau à verifier 
	*	@table = table mysql ;
	*/
	public function checkTableFields($data,$table){
		$sql = "SHOW COLUMNS FROM $table";
		$requete = $this->BDD->prepare($sql);
		$requete->execute();
		$colones_tab = $requete->fetchAll();
		foreach ($colones_tab as $colone) {
			$colones[] = $colone['Field'];	
		}

		foreach ($data as $key => $value) {
			if(!in_array($key, $colones)){
				$missing_fields[] = $key;
				unset($data[$key]); 
			}
		}

		if(isset($missing_fields)){
			$pluriel = count($missing_fields) > 1 ? true : false;
			$msg = "Il manque le".($pluriel ? 's': null)." champ".($pluriel ? 's': null)." <font color='#000'>".implode(' <font color="#fff">|</font> ',$missing_fields)."</font> dans la table <font color='#000'>$table</font>";
			alertMsg($msg,'warning');
			//echo 'ces champs sont manquants:'. implode(' | ',$missing_fields);
		}

		return $data;

	}

	/*
	*	Permet d'extraire la valeur d'un champs dans une table en fonction de la valeur du champ condition
	*/

	public function extraireChamp($champ, $table, $condition, $orderby = '',$debug = null,$fetch_mode = PDO::FETCH_ASSOC){
		//if(isset($champ) && isset($table) && isset($condition) && isset($valeur)){
			$sql = 	"SELECT {$champ} FROM {$table} ";
			!empty($condition)? $sql .= "WHERE {$condition} " : null;
			!empty($orderby)? $sql .= "ORDER BY {$orderby} " : null;	 
			$select = $this->BDD->prepare($sql); # Selection de touts les formateurs valides
			$select->execute();
			$retour_tab = $select->fetch($fetch_mode);
			if($debug){
				echo $sql .'<br>';
				//var_dump($retour_tab);
			}			
			if($retour_tab){
				return $retour_tab;
			}else{
				return false;//echo  "resultat vide pour la requete : $sql";
			}
			
		//}
		
	}

	public function extraireTableau($champ,$table,$condition,$orderby='',$fetch_mode = PDO::FETCH_ASSOC){
		//if(isset($champ) && isset($table) && isset($condition) && isset($valeur)){
			$sql = 	"SELECT {$champ} FROM {$table} ";
			!empty($condition)? $sql .= "WHERE {$condition} " : null;
			!empty($orderby)? $sql .= "ORDER BY {$orderby} " : null;	 
			//echo $sql;
			$select = $this->BDD->prepare($sql); # Selection de touts les formateurs valides
			$select->execute();
			$retour_tab = $select->fetchAll($fetch_mode);
			//echo $sql.'<br>';
			//var_dump($retour_tab);
			if($retour_tab){
				return $retour_tab;
			}else{
				return false;//echo  "resultat vide pour la requete : $sql";
			}
			
		//}
		
	}


	/*
	* CHARGEMENT DE TOUT LES ELEMENTS VALIDES
	*/
	public function loadAll($table){
		//require 'config.php';

		$data = array();
		$sql = 	"SELECT * FROM {$table} WHERE valid = '1' AND statut = '1'";	 
		$selectAll_q = $this->BDD->prepare($sql); # Selection de touts les formateurs valides
		$selectAll_q->execute();

		while($result = $selectAll_q->fetch(PDO::FETCH_ASSOC)){
		 	$data[] = $result; # Replissage du tableau avec ces valeurs
		}

		return $data;
	}	

	public function loadAllOrder($table,$champ,$type){
		//require 'config.php';

		$data = array();
		$sql = "SELECT * FROM {$table} WHERE valid = '1' ORDER BY {$champ} {$type} ";		 
		$selectAll_q = $this->BDD->prepare($sql); # Selection de touts les formateurs valides
		$selectAll_q->execute();

		while($result = $selectAll_q->fetch(PDO::FETCH_ASSOC)){
		 	$data[] = $result; # Replissage du tableau avec ces valeurs
		}

		return $data;
	}

	/*
	*Permet de tester des valeurs avant un ajout ou une mise à jour dans notre table
	*@param $fields 	= tableau de champs sur lesquels on veut effectuer le test (Ex: array('libelle','description') )
	*@param $table  	= table dans laquelle on fait notre verification
	*@param $data 	 	= tableaux de données à tester (Ex: $_POST)
	*@param $discrim	= champs clé sur lequel se baser pour la verification (Ex: 'id') 
	*/
	public function verifDoublon($fields,$table,$data,$discrim = null){
		$return = false;
	    foreach ($fields as $k => $v) {
	      	$data2[$v.'='] = $data[$v];	      	
	    }
	    $data2['valid='] = 1;
	    !is_null($discrim) ? $data2[$discrim.'<>'] = $data[$discrim] : '';

	    $test_doublon = $this->get($fields, $table, $data2, $concats = "AND");
	    $return = $test_doublon['total']>0? true:false;
	    return $return;
	}

	/*
	* AJOUT D'UN ELEMENT
	*/		

	public function insert($data,$table){
		
		if (count($data) == count($data, COUNT_RECURSIVE)) {
		  	// le cas d'un ajout simple
		  	array_shift($data);
			foreach ($data as $key => $value){
				$fields_tab[] = $key;
				$values_tab[] = $this->BDD->quote($value);
			}

			$fields = implode(', ',$fields_tab);
			$values = '('.implode(', ',$values_tab).')';
		}else{
			// le cas d'un ajout multiple
			$i = 0;		  	
			foreach ($data as $key => $value){

				array_shift($data[$key]);
				
				$temp = array();
				foreach($data[$key] as $k => $v){					
					$temp[] = $this->BDD->quote($v);
				}

				$values_tab[$i] = '('.implode(', ',$temp).')';
				$i++;				
			}

			$first = array_shift($data);

			foreach ($first as $key => $value){
				$fields_tab[] = $key;
			}

			$fields = implode(', ',$fields_tab);
			$values = implode(', ',$values_tab);
			//var_dump($values_tab);
		}

		$req = "INSERT INTO {$table} ( $fields ) VALUES  $values ";
		//var_dump($data);
		//echo $req;
		//exit;
		$update_q = $this->BDD->prepare($req);
		//$update_q->execute($data);
		if($update_q->execute()){
			
			return $this->BDD->lastInsertId();
		}else{
			
			return false;
		}

	}


	public function insert___($data,$table){
		
		array_shift($data);
		foreach ($data as $key => $value){
			$fields_tab[] = $key;
			$values_tab[] = $this->BDD->quote($value);
		}

		$fields = implode(', ',$fields_tab);
		$values = implode(', ',$values_tab);
		
		$req = "INSERT INTO {$table} ( $fields ) VALUES ( $values )";
		//var_dump($data);
		//echo $req;
		$update_q = $this->BDD->prepare($req);
		//$update_q->execute($data);
		if($update_q->execute()){
			
			return $this->BDD->lastInsertId();
		}else{
			
			return false;
		}
		
		if (count($data) == count($data, COUNT_RECURSIVE)) {
		  	echo 'array is not multidimensional';
		}else{
		  	echo 'array is multidimensional';
		}

	}



	public function _insert($data,$table){
		//require '../fonction/fonction.php';
		
		array_shift($data);
		foreach ($data as $key => $value){
			$fields[] = $key;
		}

		$fields = implode(', ',$fields);
		//var_dump($fields);
		//$fields = implode(', ', $element);
		foreach ($data as $key => $value){
			$element[] = ':'.$key;//$this->BDD->quote($value);
		}
		$elmt_ligne = implode(', ', $element);		

			if (isset($element)) {
			$req = "INSERT INTO {$table} ( $fields ) VALUES ( $elmt_ligne )";
			//var_dump($data);
			//echo $req;
			$update_q = $this->BDD->prepare($req);
			//$update_q->execute($data);
			if($update_q->execute($data)){				
				
				return $this->BDD->lastInsertId();
			}else{
				
				return false;
			}
			
		}
	}
	
	/*
	* EDITION D'UN ELEMENT
	*/
	public function update($data,$table){		
		foreach ($data as $key => $value){
			$element[] = $key.' = :'.$key;
			$element2[] = $key.' = '.$this->BDD->quote($value);

			
		}
			if (isset($element)) {
				//array_shift($element);
				$elmt_ligne = implode(', ', $element);				
				$elmt_ligne2 = implode(', ', $element2);				
				$req = "UPDATE {$table} SET {$elmt_ligne},valid = 1 WHERE id = :id";
				$req2 = "UPDATE {$table} SET {$elmt_ligne2},valid = 1 WHERE id = :id";
				//echo $req2;
				//exit;
				$update_q = $this->BDD->prepare($req);
				if($update_q->execute($data)){
				
				
				return true;
			}else{
				
				return false;
			}
			
		}
	}

	public function maj($data,$table,$condition){		
		foreach ($data as $key => $value){
			$element[] = $key.' = :'.$key;
			$element2[] = $key.' = '.$this->BDD->quote($value);
		}
			if (isset($element)) {
				//array_shift($element);
				$elmt_ligne = implode(', ', $element);				
				$elmt_ligne2 = implode(', ', $element2);				
				$req = "UPDATE {$table} SET {$elmt_ligne},valid = 1 WHERE {$condition}";
				$req2 = "UPDATE {$table} SET {$elmt_ligne2},valid = 1 WHERE {$condition}";
				//echo $req2;
				//var_dump($data);
				$update_q = $this->BDD->prepare($req);
				if($update_q->execute($data)){
				
				
				return true;
			}else{
				
				return false;
			}
			
		}
	}					 
	
	/*
	* SUPPRESSION D'UN ELEMENT
	*/
	public function delete($id,$table){
		//require 'config.php';
		$req = "UPDATE {$table} SET valid = 0 WHERE id = :id";
		$delete_q = $this->BDD->prepare($req);
 		if($delete_q->execute(array('id' => $id	))){

			
			return true;
 		}else{
 			
			
			return false;
 		}
	} 

	public function deleteCustom($table,$condition){
		//require 'config.php';
		$req = "UPDATE {$table} SET valid = 0 WHERE {$condition}";
		$delete_q = $this->BDD->prepare($req);
		//echo $req;
 		if($delete_q->execute()){
			
			return true;
 		}else{ 			
			
			return false;
 		}
	} 


	/*
	*	PAGINATION
	*/
	public function pagination($cpage,$perpage,$table){
		//require 'config.php';

		$nbrNews = count($this->loadAll('$table')); 
		$nbrPage = ceil($nbrNews/$perPage);					

		$data = array();		 
		$selectAll_q = $this->BDD->prepare("SELECT * FROM {$table} WHERE valid = '1' LIMIT ".(($cPage-1)*$perPage).",".$perPage."");
		$selectAll_q->execute();

		while($result = $selectAll_q->fetch(PDO::FETCH_ASSOC)){
		 	$data[] = $result; # Replissage du tableau avec ces valeurs
		}

		return $data;
		
	}


/***
 *	insert des données dans la table en paramètre
 *	@param $datas	=	tableau des données à insérer dont la clé et le nom du champs dans la table
 *	@param $table	=	table dans laquelle insérer les données
 */
function add($datas, $table){
	$bdd = $this->BDD; //on ouvre la connexion à la base de données

	foreach($datas as $key => $value){
		$keys[] = $key;
		$values[] = $value;
	}

	$strSQL = "INSERT INTO ".$table." (";
	foreach($keys as $ky => $k){ $strSQL .= $k . ","; }

	$strSQL = substr($strSQL,0,-1) . ") VALUES(";
	foreach($values as $vl => $v){ $strSQL .= "?,"; }

	$strSQL = substr($strSQL,0,-1) . ")";

	$query = $bdd->prepare($strSQL);
	if($query->execute($values)){
		$msg = "Enregistrement effectué avec <span class ='noir'>Success</span> ! ";
		flash($msg,"success",true,10);
		return $bdd->lastInsertId();
	}else{
		$msg = "<span class ='noir'>Erreur</span> survenue lors de la l\'Insertion :<span class ='noir'>".$req."</span>";
		flash($msg,"success",true,10);
		return false;
	}
}

/***
 *	met à jour les données de l'ID dans la table en paramètre
 *	@param $id		=	identifiant de la ligne à modifier
 *	@param $datas 	=	tableau des données à insérer dont la clé et le nom du champs dans la table
 *	@param $table 	=	table dans laquelle insérer les données
 */
function update2($id, $datas, $table){
	foreach($datas as $key => $value){
		$keys[] = $key;
		$values[] = $value;
	}

	$strSQL = "UPDATE ".$table." SET ";
	foreach($datas as $key => $value){
		$strSQL .= $key . " = ?,";
	} $strSQL = substr($strSQL,0,-1) . " WHERE id = ?";
	$values[] = $id;
	$query = $this->BDD->prepare($strSQL);
	if($query->execute($values)) return true;
	else return false;
}

/***
 *	supprime les données correspondant à l'ID dans la table en paramètre
 *	@id		identifiant de la ligne à supprimer
 *	@table	table sur laquelle on applique la suppression
 */
function delete2($id, $table){
	$strSQL = "DELETE FROM ".$table." WHERE id = ?";
	$query = $this->BDD->prepare($strSQL);
	//print_r(array($id));

	if($query->execute(array($id))) return true;
	else return false;
}


/***
 * 	retourne le resultat d'un select
 *	@columns 	colonnes à selectionner pour la requête (ex: array('champ1','champ2') ou '*')
 *	@table 		nom de la table sur laquelle faire la requête
 *	@where 		champs sur lequels appliquer des conditions ( ex: array( 'champ1 =' => 'valeur', 'champ2 LIKE' => 'valeur%') )
 *	@concats 	[ AND | OR ]
 *	@order 		champs sur lequels appliquer le tri, et l'ordre pour chaque champs (ex: array('champ1' => 'ASC','champ2' => 'DESC') )
 *	@limit 		limit[0] => debut de la liste, limit[1] => nombre d'éléments dans la liste retournée (ex: array('0','20') )
 *
 *	return @retour	: tableau contenant la requête executée, les éventuelles erreurs et le resultat de la requête
 */
	public function get($columns = null, $table = null, $where = null, $concats = "AND", $order = null, $limit = null){
		$bdd = $this->BDD;
		$retour = array(); //variable de type tableau, retournée par la fonction
		$rows = "";
		$clause = "";
		$sort = "";
		$limitStr = "";

		if(!is_null($columns) && !is_null($table)){

			// si $rows est un tableau ou égale à * tout va bien.
			if(is_array($columns)){
				foreach($columns as $column) { $rows .= $column .', '; }
				$rows = substr($rows,0,-2);
			} elseif($columns == '*'){
				$rows = '*';
			} else {
				$retour['erreur'] = "Les champs selectionné doivent être appelé depuis une variable Tableau";
				$msg = 'Erreur : <span class="noir">'.$retour['erreur'].'</span>';
				flash($msg,"success",true,10);
			}

			if(!in_array(strtolower($concats),array('and','or'))){
				$retour['erreur'] = "<strong>".$concats."</strong> n'est pas une valeur autorisée pour concaténer des conditions. Utilisez 'OR' ou 'AND'.";
				$msg = 'Erreur : <span class="noir">'.$retour['erreur'].'</span>';
				flash($msg,"success",true,10);
			}

			/*
			si @where est renseigné, on filtre les résultats grâce au tableau @where construit comme suit :
				array ('colname operateur' => 'valeur');
				ex: array('page_id =' => 5);
			sinon, on ne filtre pas les résultats
			*/
			if(!is_null($where) && is_array($where)){
				foreach($where as $k => $v){
					$clause .= $k." ? ".$concats." ";
					$values[] = $v;
					
				}

				$clause = " WHERE ".substr($clause,0,(-(strlen($concats)+2)));
			} elseif(!is_null($where) && !is_array($where)){
				$retour['erreur'] = "La clause WHERE doit être construite via une variable Tableau";
				$msg = 'Erreur : <span class="noir">'.$retour['erreur'].'</span>';
				flash($msg,"success",true,10);
			} else {
				$clause = "";
			}

			//si $order est un tableau et n'est pas null
			if(!is_null($order) && is_array($order)){
				foreach($order as $k => $v){ $sort .= $k." ".$v.", "; }
				$sort = " ORDER BY ".substr($sort,0,-2);
			} elseif(!is_null($order) && !is_array($order)) {
				$retour['erreur'] = "ORDER BY doit être construit via une variable Tableau";
				$msg = 'Erreur : <span class="noir">'.$retour['erreur'].'</span>';
				flash($msg,"success",true,10);
			} else {
				$sort = "";
			}

			if(!is_null($limit) && is_array($limit) && is_numeric($limit[0]) && is_numeric($limit[1])){
				$debut = $limit[0];
				$nbRows = $limit[1];
				$limitStr = " LIMIT " . $debut . "," . $nbRows;
			} elseif(!is_null($limit) && !is_array($limit)){
				$retour['erreur'] = "LIMIT doit être construit via un tableau de deux entiers";
				$msg = 'Erreur : <span class="noir">'.$retour['erreur'].'</span>';
				flash($msg,"success",true,10);
			} else {
				$limitStr = "";
			}

			// on construit la requête
			$strSQL = "SELECT ".$rows." FROM ".$table.$clause.$sort.$limitStr;

			if(empty($retour['erreur'])){
				$query = $bdd->prepare($strSQL);
				$query->execute(@$values);
				$retour['requete'] = $strSQL;
				$retour['valeurs'] = $values;
				$retour['reponse'] = $query->fetchAll(PDO::FETCH_ASSOC);

				$sqlTotal = "SELECT COUNT(*) as total FROM ".$table.$clause.$sort;
				$q = $bdd->prepare($sqlTotal);
				$q->execute(@$values);
				$tot = $q->fetchAll(PDO::FETCH_ASSOC);				
				$retour['total'] = count($retour['reponse']);//$tot[0]['total'];
				//debug($retour);
			}

		} else {
			$retour['erreur'] = "Impossible de créer la requete, les champs à selectionner et la table sont vide";
			$msg = 'Erreur : <span class="noir">'.$retour['erreur'].'</span>';
			flash($msg,"success",true,10);
		}
		//print_r($retour['reponse']);
		return $retour;
	}


























































}







































