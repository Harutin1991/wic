<?php
namespace App\Home;
use App\Controller;
use App\ApiReq;
use App\Home\Model\Country_Model;
use App\Home\Model\Places_Model;
use App\Home\Model\Zip_Model;

class AjaxController extends Controller {

	public function search(){
		$country = trim($_POST['country']);
		$zip = trim($_POST['zip']);
		if(!$this->checkPost()){
			echo json_encode(['success'=>false,'list'=>'']);exit();
		}
		$response = [];
		$placesModel = new Places_Model();
		$zipModel = new Zip_Model();
		$countryModel = new Country_Model();
		$zip_id = $zipModel->getZipIdByCode($zip);
		if(!$zip_id){
			$response = ApiReq::getRequest($country,$zip);
			if(!empty($response)){
				$zip_id = $zipModel->save(['zip_code'=>$zip]);
				$countryModel->setAbbreviation($country);
				$country_id = $countryModel->getCountryByAbbreviation();
				foreach($response as $value){
					$placesModel->save([
						'name'=>$value[0],
						'longitude'=>$value[1],
						'latitude'=>$value[4],
						'zip_id'=>$zip_id,
						'country_id'=>$country_id[0]['id']
					]);
				}
				$list = $this->view->renderPartial('index/list',['places'=>$response,'country'=>$country_id[0]['name']]);
				echo json_encode(['success'=>true,'list'=>$list]);exit();
			}else{
				echo json_encode(['success'=>false,'list'=>'']);exit();
			}
		}elseif(!empty($zip_id) && !$placesModel->getCount(['zip_id'=>$zip_id[0]['id']])){
			$response = ApiReq::getRequest($country,$zip);
			if(!empty($response)){
				$zip_id = $zipModel->save(['zip_code'=>$zip]);
				$countryModel->setAbbreviation($country);
				$country_id = $countryModel->getCountryByAbbreviation();
				$list = $this->view->renderPartial('index/list',['places'=>$response,'country'=>$country_id[0]['name']]);
				foreach($response as $value){
					$placesModel->save([
						'name'=>$value[0],
						'longitude'=>$value[1],
						'latitude'=>$value[4],
						'zip_id'=>$zip_id,
						'country_id'=>$country_id[0]['id']
					]);
				}
				echo json_encode(['success'=>true,'list'=>$list]);exit();
			}else{
				echo json_encode(['success'=>false,'list'=>'']);exit();
			}
			
		}elseif(!empty($zip_id) && $placesModel->getCount(['zip_id'=>$zip_id[0]['id']])){
			$countryModel->setAbbreviation($country);
			$country = $countryModel->getCountryByAbbreviation();
			$places = $placesModel->getPlace($zip_id[0]['id']);
			$response = [];
			foreach($places as $key=>$value){
				$response[$key]['name'] = $value['name'];
				$response[$key]['latitude'] = $value['latitude'];
				$response[$key]['longitude'] = $value['longitude'];
			}
			$list = $this->view->renderPartial('index/list',['places'=>$response,'country'=>$country[0]['name']]);
			echo json_encode(['success'=>true,'list'=>$list]);exit();
		}
	}
	
	private function checkPost(){
		if(empty($_POST) || !isset($_POST['country']) || !isset($_POST['zip'])){
			return false;
		}
		$countryModel = new Country_Model();
		$countryCount = $countryModel->getCount(['abbreviation'=>trim($_POST['country'])]);
		if(!$countryCount){
			return false;
		}
		return true;
	}
}
