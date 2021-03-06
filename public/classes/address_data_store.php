<?php

require_once('filestore.php');

class AddressDataStore extends Filestore {

	public function __construct($filename= '') {
		parent::__construct($filename);
		$this->$filename = strtolower($filename);
	}

	public function set_entry($array) {
		$entry = [];
		foreach($array as $item) {
			$entry[] = htmlspecialchars(strip_tags($item));
		}
		return $entry;
	}
}

?>