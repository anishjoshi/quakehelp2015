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

		
		public function Incident($id, $title, $description, $date, $location, $latitude, $longitude, $categories, $customfields){

			$this->incidentId = $id;
			$this->incidentTitle = $title;
			$this->incidentDescription = $description;
			$this->incidentDate = $date;
			$this->locationName = $location;
			$this->locationlatitude = $latitude;
			$this->locationlongitude = $longitude;
			$this->category = $categories;
			$this->customfields = $customfields;

		}

	}