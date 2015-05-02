<?php
	
	//include library
	include 'lib/lib.php';

	// include value objects
	include 'vo/vo.php';

	include 'dao/dao.php';

	$incidents = new Incidents();


	echo json_encode($incidents->getAll());

