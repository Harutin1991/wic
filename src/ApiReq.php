<?php
namespace App;
class ApiReq {
	
	public static function getRequest($country,$zip){
		$response = [];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, 'http://api.zippopotam.us/'.$country.'/'.$zip);
		$content = curl_exec($ch);
		$place = json_decode($content);
		if(!empty((array)$place)){
			foreach($place->places as $value){
				$response[] = array_values((array)$value);
			}
			foreach($response as $key=>$value){
				$response[$key]['name'] = $value[0];
				$response[$key]['longitude'] = $value[1];
				$response[$key]['latitude'] = $value[4];
			}
		}
		return $response;
	}
}
