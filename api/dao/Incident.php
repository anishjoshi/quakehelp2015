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

			$this->_incidentId = $id;
			$this->_incidentTitle = $title;
			$this->_incidentDescription = $description;
			$this->_incidentDate = $date;
			$this->_locationName = $location;
			$this->_locationlatitude = $latitude;
			$this->_locationlongitude = $longitude;
			$this->_category = $categories;
			$this->_customfields = $customfields;
			$this->_district = "kathmandu";

		}



	}