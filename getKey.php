<?php
include "CKeyGenerator.php";

if (isset($_GET["format"])) {
	$temp_format = $_GET["format"];
	if ($temp_format == "json") {
		$format = "json";
	} else if ($temp_format == "xml") {
		$format = "xml";
	} else {
		$format = "json";
	}
} else {
	$format = "json"; 
}

$generator = new CKeyGenerator();

if ($format == "xml") {
	header("Content-type:application/xml");
	$generator->asXML();
} else {
	header("Content-type:application/json");
	$generator->asJSON();
}
?>