<?php

class Incidents {
	private $_incidents;
	public function Incidents(){
		$this->_incidents = array();
		$apicall = new ApiCurl();
	 	$response = $apicall->getRequest('http://parakhi.com.np/api?task=incidents');
	 	$jsonresponse = json_decode($response);
	 	$incidents = $jsonresponse->payload->incidents;
	 	foreach ($incidents as $inc) {
	 		$incidentObj = new Incident($inc->incident->incidentid, $inc->incident->incidenttitle, $inc->incident->incidentdescription, $inc->incident->incidentdate, $inc->incident->locationname, $inc->incident->locationlatitude, $inc->incident->locationlongitude,  $inc->categories, $inc->customfields);
	 		array_push($this->_incidents,$incidentObj);
	 	}
	}

	public function getAll(){
		return $this->_incidents;
	}
}