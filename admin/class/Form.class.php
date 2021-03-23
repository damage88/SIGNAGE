<?php 
class Form{

	public $data;


	public function set($data){
		$this->data = '';
		if (!empty($data)) { 
		$this->data = $data;
		}
		
	}

	/**
	* FONCTION POUR LES INPUTS CLASSIQUES ( text, textarea, checkbox, hidden, file, password)
	**/
	public function input($name,$options = array(),$datalist_array = array()){		
		if(!isset($this->data[$name])){
			$data[$name] = '';
		}else{
			$data[$name] = $this->data[$name];
		} 

		$datalist = '';
		if(isset($datalist_array) && !empty($datalist_array)){
			$datalist .= '<datalist id="liste'.$name.'">';
			foreach ($datalist_array as $k => $v) {
				$datalist .= '<option value="'.$v.'"></option>';
			}
			$datalist .= '</datalist>';
		}		
		
		$attr = '';
		foreach($options as $k=>$v){ if($k!='type'){ 
			if (empty($v)) {
				$attr .= " $k ";
			}else{
				$attr .= " $k=\"$v\"";	
			}
		}}
		if(!isset($options['type'])){
			$html  = '<input type="text" list="liste'.$name.'" id="input'.$name.'" name="'.$name.'" value="'.$data[$name].'" data-value="'.$data[$name].'" '.$attr.'>';
			$html .= $datalist;
		}elseif($options['type'] == 'textarea'){
			$html = '<textarea id="input'.$name.'" name="'.$name.'"'.$attr.'>'.$data[$name].'</textarea>';
		}elseif($options['type'] == 'checkbox'){
			$html = '<input type="hidden" name="'.$name.'" value="0"><input type="checkbox" id="'.$name.'" name="'.$name.'" value="1" '.(empty($data[$name])?'':'checked').'>';
		}elseif($options['type'] == 'file'){
			$html = '<input type="file" class="input-file" id="'.$name.'" name="'.$name.'" value=""'.$attr.'>';//'.$data[$name].'
		}elseif($options['type'] == 'password'){
			$html = '<input type="password" id="input'.$name.'" name="'.$name.'" value="'.$data[$name].'"'.$attr.'>';
		}elseif($options['type'] == 'hidden'){
			$html = '<input type="hidden" id="hidden'.$name.'" name="'.$name.'" value="'.$data[$name].'"'.$attr.'>';
		}elseif($options['type'] == 'search'){
			$html = '<input type="search" id="input'.$name.'" name="'.$name.'" value="'.$data[$name].'"'.$attr.'>';
		}elseif($options['type'] == 'color'){
			$html = '<input type="color" id="input'.$name.'" name="'.$name.'" value="'.$data[$name].'"'.$attr.'>';
		}elseif($options['type'] == 'number'){
			$html = '<input type="number" id="input'.$name.'" name="'.$name.'" value="'.$data[$name].'"'.$attr.'>';
		}elseif($options['type'] == 'tel'){
			$html = '<input type="tel" id="input'.$name.'" name="'.$name.'" value="'.$data[$name].'"'.$attr.'>';
		}elseif($options['type'] == 'email'){
			$html = '<input type="email" id="input'.$name.'" name="'.$name.'" value="'.$data[$name].'"'.$attr.'>';
		}elseif($options['type'] == 'date'){
			$html = '<input type="date" id="input'.$name.'" name="'.$name.'" value="'.$data[$name].'"'.$attr.'>';
		}elseif($options['type'] == 'month'){
			$html = '<input type="month" id="input'.$name.'" name="'.$name.'" value="'.$data[$name].'"'.$attr.'>';
		}elseif($options['type'] == 'time'){
			$html = '<input type="time" id="input'.$name.'" name="'.$name.'" value="'.$data[$name].'"'.$attr.'>';
		}							
		$html .= '';
		return $html;

	}


	public function isAssociative($array) {
    	return (array_keys($array) != array_keys(array_keys($array)));
	}


	/**
	* FONCTION POUR LES LISTES DEROULANTES
	**/
	public function listeItems($name, $label,$items = array(),$type = 0,$options = array(),$prefix = null,$multiple = false){

		if (!isset($prefix)) {
			$prefix = '';
		}

		if(!isset($this->data[$name])){
			$data[$name] = '';
		}else{
			$data[$name] = $this->data[$name];
		}

		$html = '<label for="select'.$name.'" ><b>'.$label.'</b></label>';//<div class="input">';
					
		if (isset($options)) {
			$attr='';
			foreach($options as $k=>$v){ 
			
				if (empty($v)) {
					$attr .= " $k ";
				}else{
					$attr .= " $k=\"$v\"";	
				}
			}
		}			
		
		

		$html .= '<select '.($multiple ? 'multiple' : null ).' name="'.$name.'" id="'.$name.'"';    

			if (isset($attr)) {
				$html .= ''.$attr.'>';					
			}else{
				$html .= '>';
			}

			if(!empty($items)){
				if($type == 1){
					foreach ($items as $k => $v) {
						if (isset($data[$name]) && ($data[$name] == $k)) {
							$html .= '<option value="'.$k.'"  selected="selected">'.$prefix.$v.'</option>';
						}else{
							//$data[$name] = $k;
							$html .= '<option value="'.$k.'" >'.$prefix.$v.'</option>';
						}
					}
				}else{
					foreach ($items as $k) {
						if (isset($data[$name]) && ($data[$name] == $k)) {
							$html .= '<option value="'.$k.'"  selected="selected">'.$prefix.$k.'</option>';
						}else{
							//$data[$name] = $k;
							$html .= '<option value="'.$k.'" >'.$prefix.$k.'</option>';
						}
					}
				}				
			
			}else{
				$html .= '<option disabled>Aucun choix disponible</option>';
			}
			

		$html .= '</select>';//</div>';
		return $html;

	}

	/**
	* FONCTION POUR LES RADIOS
	**/
	public function radio($name, $label,$items = array(),$options = array()){

		if(!isset($this->data[$name])){
			$data[$name] = '';
		}else{
			$data[$name] = $this->data[$name];
		}

		$html = '<label for="input'.$name.'" ><strong>'.$label.'</strong></label>'; 
					
		if (isset($options)) {
			$attr='';
			foreach($options as $k=>$v){ 
			
				if (empty($v)) {
					$attr .= " $k ";
				}else{
					$attr .= " $k=\"$v\" ";	
				}
			}
		}			
		
	
		foreach ($items as $k => $v){
			$html .= '<INPUT type= "radio" id="input'.$name.'" name="'.$name.'" value="'.$k.'"';			
			$html .= ''.(isset($attr)?$attr:"")." ".($k==$data[$name]?'checked':'').'> '.$v.' <br>  ';			
		}

		$html .= '<br>';
		return $html;

	}



	public function listeDate($name, $label=null,$type,$options = array()){

		$days_letters = array('Lundi', 'Mardi', 'Mercredi','Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
		$months_letters = array('Janvier', 'Fevrier', 'Mars','Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');


		if($this->data[$name] == 0){
			switch ($type) {
				case 'days_numbers':
					$data[$name] = date('d');
					break;
				case 'months_letters':
					$data[$name] = date('m');
					break;
				case 'years':
					$data[$name] = date('Y');
					break;
				
				default:
					$data[$name] = '';
					break;
			}
			
		}else{
			$data[$name] = $this->data[$name];
		}

		if ($label) {
			$html = '<label for="select'.$name.'" class="date">'.$label.'</label>';
		}else{
			$html = '';
		}
					
		if (isset($options)) {
			$attr='';
			foreach($options as $k=>$v){ 
			
				if (empty($v)) {
					$attr .= " $k ";
				}else{
					$attr .= " $k=\"$v\"";	
				}
			}
		}			
			

		$html .= '<select  name="'.$name.'" id="'.$name.'"';    

			if (isset($attr)) {
				$html .= ''.$attr.'>';					
			}else{
				$html .= '>';
			}	

		switch ($type) {
			case 'days_numbers':
								for ($i = 1; $i < 32; $i++) {
									if (isset($data[$name]) && ($data[$name] == $i)) {
										$html .= '<option value="'.$i.'"  selected="selected">'.$i.'</option>';
									}else{
										//$data[$name] = $k;
										$html .= '<option value="'.$i.'" >'.$i.'</option>';
									} 								
								}
				break;

			case 'days_letters':
								for ($i = 0; $i < 7; $i++) {
									if (isset($data[$name]) && ($data[$name] == $i)) {
										$html .= '<option value="'.$i.'"  selected="selected">'.$days_letters[$i].'</option>';
									}else{
										//$data[$name] = $k;
										$html .= '<option value="'.$i.'" >'.$days_letters[$i].'</option>';
									} 					
								}

				break;

			case 'months_letters':
								  for ($i = 0; $i < 12; $i++) {
									  if (isset($data[$name]) && ($data[$name] == ($i+1))) {
										 $html .= '<option value="'.($i+1).'"  selected="selected">'.$months_letters[$i].'</option>';
								  	  }else{
								          //$data[$name] = $k;
									      $html .= '<option value="'.($i+1).'" >'.$months_letters[$i].'</option>';
								  	  } 					
				                  }
				break;

			case 'years':
						$an = date('Y');
						for ($i = 1970; $i <= 2030/*$an*/ ; $i++) {
							if (isset($data[$name]) && ($data[$name] == $i)) {

								$html .= '<option value="'.$i.'"  selected="selected">'.$i.'</option>';
							}else{
								//$data[$name] = $k;
								$html .= '<option value="'.$i.'" >'.$i.'</option>';
							} 					
				        }

			default:
				# code...
				break;
		}


		$html .= '</select>';

return $html;


}

/**
	* FONCTION POUR LES LISTES DEROULANTES II
	**/
	public function liste($name, $label,$items = array(),$options = array(),$prefix = null){

		if (!isset($prefix)) {
			$prefix = '';
		}

		if(!isset($this->data[$name])){
			$data[$name] = '';
		}else{
			$data[$name] = $this->data[$name];
		}

		$html = '<label for="select'.$name.'" ><strong>'.$label.'</strong></label><div class="input">';
					
		if (isset($options)) {
			$attr='';
			foreach($options as $k=>$v){ 
			
				if (empty($v)) {
					$attr .= " $k ";
				}else{
					$attr .= " $k=\"$v\"";	
				}
			}
		}			
		
		

		$html .= '<select  name="'.$name.'" id="'.$name.'"';    

			if (isset($attr)) {
				$html .= ''.$attr.'>';					
			}else{
				$html .= '>';
			}
			
			if($items[0] < $items[1]){
				for ($i=$items[0]; $i <= $items[1] ; $i++) { 
					if (($i<10) && ($i>0)) {
						$i = '0'.$i;
					}
					if (isset($data[$name]) && ($data[$name] == $i)) {					
						$html .= '<option value="'.$i.'"  selected="selected">'.$prefix.$i.'</option>';
					}else{
						//$data[$name] = $k;
						$html .= '<option value="'.$i.'" >'.$prefix.$i.'</option>';
					}
				}
			}else{
				for ($i=$items[0]; $i >= $items[1] ; $i--) { 
					if (($i<10) && ($i>0)) {
						$i = '0'.$i;
					}
					if (isset($data[$name]) && ($data[$name] == $i)) {					
						$html .= '<option value="'.$i.'"  selected="selected">'.$prefix.$i.'</option>';
					}else{
						//$data[$name] = $k;
						$html .= '<option value="'.$i.'" >'.$prefix.$i.'</option>';
					}
				}
			}

			
												
			

		$html .= '</select></div>';
		return $html;

	}















}
