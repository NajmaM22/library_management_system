<?php 
if(isset($_POST['submit'])){
    $title = $_POST['Title'];
    $id = $_POST['ID'];
    $author = $_POST['Author'];

    if ($title && $id && $author) {
        $enter = "$title,$ID,$author\n";
        file_put_contents('bookManagement.txt', $enter, FILE_APPEND);
        echo 'Book has been added to the system';
    } else {
        echo 'Fill in the form fully please';
    }
}
?>
