<?php

require_once('filestore.php');

class AddressDataStore extends Filestore {

	function set_entry($array) {
		$entry = [];

		foreach($array as $item) {
			$entry[] = htmlspecialchars(strip_tags($item));
		}
		return $entry;
	}
}

?>