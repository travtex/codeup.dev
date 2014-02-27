  
<? 

// loads a text file and returns as an array        
function import_data($filename) {
    if (filesize($filename) == 0) {
        return FALSE;
    }
    else {
        $handle = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));
        $content_array = explode("\n", $contents);
        fclose($handle);
        return $content_array;
    }
}

// saves to a text file as a string
function save_file($filename, $items) {
    $handle = fopen($filename, "w");
    $contents = implode("\n", $items);
    fwrite($handle, $contents);
    fclose($handle);
}

function add_item(&$items) {
    $items[] = $_POST['add'];
}

function archive_item($item) {
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

$items = [];
$file_items = [];
$items = import_data("data/todo-list.txt");

if(isset($_POST['add']) && !empty($_POST['add'])) {
    add_item($items);
    save_file("data/todo-list.txt", $items);
}

$archived_items = null;

if(isset($_GET['remove'])) {
     $archived_items = $items[$_GET['remove']];
     archive_item($archived_items);

    unset($items[$_GET['remove']]);
    save_file("data/todo-list.txt", $items);
    header("Location: todo-list.php");
    exit(0);
}

if (count($_FILES) > 0 && $_FILES['file001']['error'] == 0) {
    if($_FILES['file001']['type'] == 'text/plain') {
        // Set the destination directory for uploads
        $upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
        // Grab the filename from the uploaded file by using basename
        $filename = basename($_FILES['file001']['name']);
        // Create the saved filename using the file's original name and our upload directory
        $saved_filename = $upload_dir . $filename;
        // Move the file from the temp location to our uploads directory
        move_uploaded_file($_FILES['file001']['tmp_name'], $saved_filename);
        $file_items = import_data("uploads/" . $filename);
        if(isset($_POST['overwrite']) && $_POST['overwrite'] == 'on') {
            $items = $file_items;
            save_file("data/todo-list.txt", $items);
        } else {
            $items = array_merge($items, $file_items);
            save_file("data/todo-list.txt", $items);
        }
    } 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TODO List</title>
    <link rel="stylesheet" href="css/default.css" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script>
      $(function() {
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
      });
    </script>
</head>
<body>

    <div id="main" >
        <h2>This is the TODO List</h2>

        <ul id="sortable">
            <?  if($items) :

                foreach($items as $key => $item) : ?>
                    <li><?= htmlspecialchars(strip_tags($item)); ?> <small>(<a href="?remove=<?= $key; ?>">Remove Item</a>)</small></li>
                <? endforeach;
                else : ?>
                    <li>No Available Items!</li>
                    <? endif; ?>
        </ul>
        <p><mark>Total Items: <?= count($items); ?></mark></p>

    <hr />

        <form method="POST" enctype="multipart/form-data" action="" name="form1">
            <div class="form-group">
            <p>
                <label for="add">Enter a new list item: </label>
            </p>
            <input id="add" class="form-control" name="add" autofocus="autofocus" type="text" placeholder="Enter New List Item.">
            <p>
                <br /><button type="submit" class="btn btn-primary">Add New Item</button>
                
            </p>
            <p>
                <? if(count($_FILES) > 0 && $_FILES['file001']['name'] != "" && $_FILES['file001']['type'] !== 'text/plain') :
                    echo "<p><mark>Uploaded files must be plain text.</mark></p>";
                endif; ?>
                <label for="file001">Add a .txt file of TODO items: </label>
                <input type="file" id="file001" name="file001" />
            </p>
            <p>
                <label for="overwrite"><input id= "overwrite" type="checkbox" name="overwrite" /> Overwrite all items with file items.</label>
        
            </div>
        </form>
    </div>
</body>
</html>