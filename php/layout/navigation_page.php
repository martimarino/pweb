<?php
	echo '<nav class="page_navigation">';
	echo '<input type="button" value=" " class="previous" disabled ';
	echo 'onClick="GarmentLoader.previous(' . $searchType . ')">'; 
	echo '<input type="button" value=" " class="next" disabled ';
	echo 'onClick="GarmentLoader.next(' . $searchType . ')">';
	echo '<div class="currentPage">Page 1</div>';
	echo '</nav>';
?>