<?php

class AddressDataStore {
	public $filename='';

	function __construct($filename = '') {
		$this->filename = $filename;
	}

	function read_address_book() {
        $contents = [];
        $handle = fopen($this->filename, "r");
        while(($data = fgetcsv($handle)) !== FALSE) {
        	$contents[] = $data;
        }
        fclose($handle);
        return $contents;
    }

    function write_address_book($addresses_array) {
        $handle = fopen($this->filename, "w");
        foreach($addresses_array as $fields) {
        	fputcsv($handle, $fields);
        }
        fclose($handle);
    }

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