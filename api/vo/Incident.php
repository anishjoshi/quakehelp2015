<?php 

	class Incident {
		private $_incidentId;
		private $_incidentTitle;
		private $_incidentDescription;
		private $_incidentDate;
		private $_locationName;
		private $_locationlatitude;
		private $_locationlongitude;
		private $_category;
		private $_customfields;
		private $_district;

		
		public function Incident($id, $title, $description, $date, $location, $latitude, $longitude, $categories, $customfields){

			$this->incidentId = $id;
			$this->incidentTitle = $title;
			$this->incidentDescription = $description;
			$this->incidentDate = $date;
			$this->locationName = $location;
			$this->locationlatitude = $latitude;
			$this->locationlongitude = $longitude;
			$this->district = $this->getDistrict();
			$this->category = $categories;
			$this->customfields = $customfields;
			
		}

		public function getDistrict() {
			$district = array("Achham","Arghakhanchi","Baglung","Baitadi","Bajhang","Bajura","Banke","Bara","Bardiya","Bhaktapur","Bhojpur","Chitwan","Dadeldhura","Dailekh","Dang","Darchula","Dhading","Dhankuta","Dhanusa","Dholkha","Dolpa","Doti","Gorkha","Gulmi","Humla","Ilam","Jajarkot","Jhapa","Jumla","Kailali","Kalikot","Kanchanpur","Kapilvastu","Kaski","Kathmandu","Kavrepalanchok","Khotang","Lalitpur","Lamjung","Mahottari","Makwanpur","Manang","Morang","Mugu","Mustang","Myagdi","Nawalparasi","Nuwakot","Okhaldhunga","Palpa","Panchthar","Parbat","Parsa","Pyuthan","Ramechhap","Rasuwa","Rautahat","Rolpa","Rukum","Rupandehi","Salyan","Sankhuwasabha","Saptari","Sarlahi","Sindhuli","Sindhupalchok","Siraha","Solukhumbu","Sunsari","Surkhet","Syangja","Tanahu","Taplejung","Terhathum","Udayapur");
			foreach ($district as $dist) {
				if (strpos($this->locationName,$dist) !== false) {
    				return $dist;
				}
			}

		
		$placemark = array();
		$coordinatefile = fopen("../data/coordinates.xml", "r") or die("Unable to open file!");
		$data = fread($coordinatefile,filesize("../data/coordinates.xml"));
		$xmldata = simplexml_load_string($data);
		$placemark = $xmldata->Document;
		$shortdistance = 100000;
		$shortdistancedistrict = null; 

		foreach ($placemark->Placemark as $place) {
			$name = $place->name;
			$coordinates = explode("\n", $place->MultiGeometry->Polygon->outerBoundaryIs->LinearRing->coordinates);

			foreach ($coordinates as $coordinate) {
				$longlat = explode(",", $coordinate);
				$distance = $this->distance($this->locationlatitude,$this->locationlongitude,$longlat[1],$longlat[0],"K")."<br>";
				if($shortdistance>$distance){
					$shortdistance = $distance;
					$shortdistancedistrict = $name;

				}
			}

		}
		 
		fclose($coordinatefile);
		return $shortdistancedistrict;
		}

		public function distance($lat1, $lon1, $lat2, $lon2, $unit) {

		  $theta = $lon1 - $lon2;
		  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		  $dist = acos($dist);
		  $dist = rad2deg($dist);
		  $miles = $dist * 60 * 1.1515;
		  $unit = strtoupper($unit);

		  if ($unit == "K") {
		    return ($miles * 1.609344);
		  } else if ($unit == "N") {
		      return ($miles * 0.8684);
		    } else {
		        return $miles;
		      }
		}



	}