<?php

class Filestore {

	public $filename = '';
	private $is_csv = FALSE;

	public function __construct($filename = '') {
		if(!empty($filename)) {
			$this->filename = $filename;
		}
		if (substr($filename, -3) == 'csv') {
			$this->is_csv = TRUE;
		}
	}

	public function read($return_array = FALSE) {
		return ($this->is_csv == TRUE) ? $this->read_csv() : $this->read_lines($return_array);
	}

	public function write($array) {
		return ($this->is_csv == TRUE) ? $this->write_csv($array) : $this->write_lines($array);
	} 

	// Save a text file, imploding on newlines
	private function write_lines($contents) {
		if(is_array($contents)) {
			$contents = implode("\n", $contents);
		}
		$handle = fopen($this->filename, "w");
		fwrite($handle, trim($contents));
		fclose($handle);
	}
	// Return file contents with option to return as an array on newlines
	private function read_lines($return_array = FALSE) {
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
	private function write_csv($contents) {
		$handle = fopen($this->filename, "w");
        foreach($contents as $fields) {
        	fputcsv($handle, $fields);
        }
        fclose($handle);
    }
    // Return the contents of a csv file
    private function read_csv() {
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