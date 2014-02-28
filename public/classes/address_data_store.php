<?php

require_once('filestore.php');

class AddressDataStore extends Filestore {

	function set_entry($array) {
		$entry = [
			htmlspecialchars(strip_tags($array['name'])),
			htmlspecialchars(strip_tags($array['address'])),
			htmlspecialchars(strip_tags($array['city'])),
			htmlspecialchars(strip_tags($array['state'])),
			htmlspecialchars(strip_tags($array['zip'])),
			htmlspecialchars(strip_tags($array['phone']))
			];
		return $entry;
	}
}

?>