<?php 
require_once 'config.php';
$cluster = 1;
$sql = "SELECT * FROM queue_sms WHERE queue_sms.valid=1 AND queue_sms.statut=1 AND queue_sms.date_envoi <= '".gmdate('Y-m-d H:i:s')."' ORDER BY RAND()";
$requete = $DB->prepare($sql);
$requete->execute();
$sms_in_queue = $requete->fetchAll(PDO::FETCH_ASSOC);

//var_dump($sms_in_queue);

if(!empty($sms_in_queue)){

	//temps de début
	$start_time = time();

	foreach($sms_in_queue as $k => $sms){
		if(getBalance($sms['id_user']) >= $sms['nbre_sms'] ){

			if(isset($sms['numero']) && isset($sms['id_sender']) && isset($sms['message'])){			
				$statut = $__GATEWAYS__[$__route__]($sms['id_sender'], $sms['numero'], $sms['message']);									
			}

			//$statut = 'ok - 123456789';
			
			if(isset($statut)){
				$sms_report['id'] = '';
				$sms_report['id_user'] = $sms['id_user'];
				$sms_report['id_campagne'] = $sms['id_campagne'];
				$sms_report['id_sender'] = $sms['id_sender'];
				$sms_report['message'] = $sms['message'];
				$sms_report['numero'] = $sms['numero'];				
				$sms_report['reference'] = $statut;
				$sms_report['date_enreg'] = date('Y-m-d H:i:s');
				$sms_report['date_envoi'] = $sms['date_envoi'];
				$sms_report['gateway'] = $__route__;
				$sms_report['api'] = $sms['api'];

				if(strlen($statut) > 7){
					$sms_report['report'] = 'Envoyé';
					$Model->insert($sms_report,'reports');					
					updateBalance($sms['id_user'],(int)('-'.$sms['nbre_sms']));
					$Model->delete2($sms['id'], 'queue_sms');
				}else{
					$sms_report['report'] = 'Echec';
					$Model->insert($sms_report,'reports');	
					$Model->delete2($sms['id'], 'queue_sms');
				}						
			}
		}

		//var_dump($statut);
		// temps de fin
		$end_time = time();

		//duree execution >= 45 secondes alors on annule
		if( ($end_time - $start_time) >= 45 ){
			break;
		}
	}
}

