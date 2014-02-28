<?php

class Filestore {

	public $filename = '';

	public function __construct($filename = '') {
		if(!empty($filename)) {
			$this->filename = $filename;
		}
	}
	// Save a text file, imploding on newlines
	public function write_lines($contents) {
		if(is_array($contents)) {
			$contents = implode("\n", $contents);
		}
		$handle = fopen($this->filename, "w");
		fwrite($handle, trim($contents));
		fclose($handle);
	}
	// Return file contents with option to return as an array on newlines
	public function read_lines($return_array = FALSE) {
		$handle = fopen($this->filename, "r");
		$contents = fread($handle, filesize($this->filename));
		fclose($handle);
		if($return_array) {
			return explode("\n", $contents);
		} else {
			return $contents;
		}
	}
	// Save a csv file
	public function write_csv($contents) {
		$handle = fopen($this->filename, "w");
        foreach($contents as $fields) {
        	fputcsv($handle, $fields);
        }
        fclose($handle);
    }
    // Return the contents of a csv file
    public function read_csv() {
    	$contents = [];
        $handle = fopen($this->filename, "r");
        while(($data = fgetcsv($handle)) !== FALSE) {
        	$contents[] = $data;
        }
        fclose($handle);
        return $contents;
    }
}


?>