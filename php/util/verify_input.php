<?php

	$errorMessage = "";
	$errorMessage = verifyInsertNewGarmentInput($model, $color, $category, $genre, $collection, $price, $image);

	if($errorMessage != ""){
		$response = setEmptyResponse();
		header('Location: ./../admin_profile.php?errorMessage=' . $errorMessage);
		return;
	}

	function verifyInsertNewGarmentInput($model, $color, $category, $genre, $collection, $price, $image)
	{
		if (($model == "") || ($model == "undefined") || ($color == "") || ($color == "undefined") || ($category == "") || ($category == "undefined") || ($genre == "") || ($genre == "undefined") || ($collection == "") || ($collection == "undefined") || ($price == "") || ($price == "undefined") || ($image == "") || ($image == "indefined"))
			return 'Some fields are empty';

		if(!preg_match("/^[a-zA-Z]+$/", $model))
			return 'Model input should be aphabetical';

		if(!preg_match("/^[a-zA-Z]+$/", $color))
			return 'Color input should be aphabetical';

		if(($collection != "A/I") && ($collection != "P/E"))
			return 'Collections available are A/I and P/E';

		if(($genre != "male") && ($collection != "female") && ($genre != "unisex"))
			return 'Genre options are: male, female, unisex';

		if(!preg_match("/^[0-9]+\.+[0-9]{2}$/", $price))
			return "Price invalid (insert decimal)";

		if(!preg_match("/^garment+[0-9]+\.jpg$/", $image))
			return 'Insert image as garment**.jpg without path (substitute ** with a number)';

	}

?>