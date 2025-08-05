<?php
    if(isset($_GET['uploadsubmit'])) {
        $target_file = "./upload/"   .basename($_FILES["fileToUpload"]["name"]);
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
            echo "The file has been uploaded";
        } else {
            echo "There was an error while uploading the file";
        }
    }
    if(isset($_POST['deletefile'])) {
        unlink("upload/".basename($_FILES[""]));
        echo "File has been deleted";
    }
?>
