<?php

	function checkEmptyResult($result){
		if ($result === null || !$result)
			return true;
	}

	function setEmptyResponse(){
		$message = "Nothing to load";
		return new AjaxResponse("-1", $message);
	}

	function setResponse($result, $message){
		$response = new AjaxResponse("0", $message);
		$response->data = $result;
		return $response;
	}

?>