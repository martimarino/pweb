<?php
    require_once "supernovaDbManager.php"; //includes Database Class

	function recoverInformations($field, $table, $username) {

		global $supernovaDb;
		$query = "select " . $field . " from " . $table . " where email='" . $username . "'";
		$result = $supernovaDb->performQuery($query);
		$elem = "";
		$row = $result->fetch_row();
		$elem = $row[0];
		
		return $elem;
	}

?>