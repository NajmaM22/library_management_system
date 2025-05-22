<?php 
require_once'src/FileBookManager.php';


if(isset($_POST['submit'])){
    $title = $_POST['Title'];
    $id = $_POST['ID'];
    $author = $_POST['Author'];

    $manager=new FileBookManager();
    
 if ($manager->addBook($title, $id, $author)) {
        echo 'Book has been added to the system';
    } else {
        echo 'Failed to add book. Please check for missing fields or duplicate ID.';
    }
}
?>
