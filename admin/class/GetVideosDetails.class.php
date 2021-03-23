<?php

class GetVideosDetails{

	public 		$videoUrl;
	private 	$videoDetails = null;

	private function getVideoCode($videoUrl){
		if(isset($videoUrl)){
			$this->videoUrl = $videoUrl;
						
			if(preg_match('#http://www.dailymotion.com/swf/video/([A-Za-z0-9]+)#s',$this->videoUrl, $videoid)){
				$this->videoDetails['type'] = 'dailymotion';
				$this->videoDetails['code'] =  $videoid[1];
			}elseif(preg_match('#http://www.dailymotion.com/video/([A-Za-z0-9]+)#s',$this->videoUrl, $videoid)){
		    	$this->videoDetails['type'] = 'dailymotion';
		    	$this->videoDetails['code'] =  $videoid[1];
		    }elseif(preg_match('#http://www.dailymotion.com/embed/video/([A-Za-z0-9]+)#s',$this->videoUrl, $videoid)){
	        	$this->videoDetails['type'] = 'dailymotion';
	        	$this->videoDetails['code'] =  $videoid[1];
	        }elseif(preg_match('#(?<=(?:v|i)=)[a-zA-Z0-9-]+(?=&)|(?<=(?:v|i)\/)[^&\n]+|(?<=embed\/)[^"&\n]+|(?<=(?:v|i)=)[^&\n]+|(?<=youtu.be\/)[^&\n]+#',$this->videoUrl, $videoid)){
			    $this->videoDetails['code'] = $videoid[0];
			    $this->videoDetails['type'] = 'youtube';
			}elseif(preg_match('#(https?://)?(www.)?(player.)?vimeo.com/([a-z]*/)*([0-9]{6,11})[?]?.*#', $this->videoUrl,  $videoid)){
				$this->videoDetails['code'] =  $videoid[5];
			    $this->videoDetails['type'] = 'vimeo';				
			}

			return $this->videoDetails;


		}else{
			return false;
		}
	}

	public function getVideoInfos($videoUrl){
		$details = $this->getVideoCode($videoUrl);
		
		switch(strtolower($details['type'])){
			case 'youtube':
				for($i=0;$i<4;$i++){
					$details['thumbs'][$i] = 'http://img.youtube.com/vi/'.$details['code'].'/'.$i.'.jpg';
				}
			case 'vimeo':
				$url = 'http://vimeo.com/api/v2/video/'.$details['code'].'.php';
				$headers = get_headers($url);
				$status = substr($headers[0], 9, 3);
				if($status != "404"){
					$details['hash'] = unserialize(file_get_contents('http://vimeo.com/api/v2/video/'.$details['code'].'.php'));
				}
			case 'dailymotion':
				//$details['thumbs'][0] = 'https://api.dailymotion.com/video/'.$details['code'].'?fields=thumbnail_large_url';
				//$details['thumbs'][1] = 'https://api.dailymotion.com/video/'.$details['code'].'?fields=thumbnail_medium_url';
				//$details['thumbs'][2] = 'https://api.dailymotion.com/video/'.$details['code'].'?fields=thumbnail_small_url';
			
				/*$details['thumbs'][0] = 'http://www.dailymotion.com/thumbnail/video/'.$details['code'];
				$details['thumbs'][1] = 'http://www.dailymotion.com/thumbnail/video/'.$details['code'];
				$details['thumbs'][2] = 'http://www.dailymotion.com/thumbnail/video/'.$details['code'];	*/
		}
		return $details;
	}

}