<?php

require_once('filestore.php');

class TodoDataStore extends Filestore {

	public function archive_item($item) {
    if (filesize($this->filename) == 0) {
        $handle = fopen($this->filename, "a+");
        fwrite($handle, $item);
        fclose($handle);
    } else {
        $handle = fopen($this->filename, "a");
        fwrite($handle, "\n" . $item);
        fclose($handle);
    }
}

}

?>