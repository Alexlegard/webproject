<!--
My Zamato API key: a320bb8bf44e39927b15ff6510601376

Request URLs:
Search: https://developers.zomato.com/api/v2.1/search
Toronto entity id: 89
(How do I dynamically get the entity id for any city?)
-->

<?php
class Restaurants
{
	//Search and location data are set as json
	private $apikey;
	private $url;
	
	public function __construct() {
		$this->apikey = 'a320bb8bf44e39927b15ff6510601376';
		$this->url = 'https://developers.zomato.com/api/v2.1/categories';
		$this->numresults = 10;
		
	}
	
	public function getData() {
		return $this->data;
	}
	
	public function getApiKey(){
		return $this->apikey;
	}
	
	public function getEntityId(){
		return $this->entityid;
	}
	
	public function getNumResults(){
		return $this->numresults;
	}
	
	public function setEntityId($id){
		$this->entityid = $id;
	}
	
	public function setNumResults($n){
		$this->numresults = $n;
	}
	
	public function setPage($p){
		$this->page = $p;
	}
	
	public function getDebugSearchQuery($entid, $nr, $pg){
		$offset = $pg-1;
		$offset = $offset * $nr;
		
		$query = "https://developers.zomato.com/api/v2.1/search?" .
		"entity_id=" . $entid .
		"&entity_type-city" .
		"&start=" . $offset .
		"&count=" . $nr;
		
		return $query;
	}
	
	public function getDebugLocationQuery($c){
		//$query = 'https://developers.zomato.com/api/v2.1/locations?query='.$c;
		
		$query = 'https://developers.zomato.com/api/v2.1/locations?query='.$c;
	}
	
	public function getSearchData($entid, $nr, $pg){
		//need entity id
		//numresults
		//page
		
		$curl = curl_init();
		
		//Set request URL
		$offset = $pg - 1;
		$offset = $offset * $nr;
		curl_setopt($curl, CURLOPT_URL, "https://developers.zomato.com/api/v2.1/search?" .
		"entity_id=" . $entid .
		"&entity_type=city" .
		"&start=" . $offset .
		"&count=" . $nr);
		
		//Credit to user trueicecold
		//https://stackoverflow.com/questions/26495065/php-using-api-key-in-curl-get-call
		//This sets the API key.
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('user-key: ' . $this->apikey));
		//curl_setopt($curl, CURLOPT_POSTFIELDS, 'q=Brampton&count=1');
		
		//Set return transfer to 1
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		
		//echo '<br>' . curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
		
		$output = CURL_EXEC($curl);
		
		//Close connection to save system resources
		curl_close($curl);
		
		return $output;
	}
	
	public function getLocationData($c){
		//Example string:
		//https://developers.zomato.com/api/v2.1/locations?query=Toronto
		$query = 'https://developers.zomato.com/api/v2.1/locations?query='.$c;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $query);
		//Set API key
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('user-key: ' . $this->apikey));
		
		//Set return transfer to 1
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		
		$output = CURL_EXEC($curl);
		
		curl_close($curl);
		
		return $output;
		$this->locationdata = $output;
	}
	
	public function getRestaurantById($id){
		//https://developers.zomato.com/api/v2.1/restaurant?res_id=8906757
		$query = 'https://developers.zomato.com/api/v2.1/restaurant?res_id=' . $id;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $query);
		//Set API key
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('user-key: ' . $this->apikey));
		
		//Set return transfer to 1
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		
		$output = CURL_EXEC($curl);
		
		curl_close($curl);
		
		return $output;
	}
}?>