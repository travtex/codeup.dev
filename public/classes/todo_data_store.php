<?php

require_once('filestore.php');

class TodoDataStore extends Filestore {

	public function archive_item($item) {
    if (filesize("data/todo-archive.txt") == 0) {
        $handle = fopen("data/todo-archive.txt", "a+");
        fwrite($handle, $item);
        fclose($handle);
    } else {
        $handle = fopen("data/todo-archive.txt", "a");
        fwrite($handle, "\n" . $item);
        fclose($handle);
    }
}

}

?>