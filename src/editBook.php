<?php
require_once 'src/FileBookManager.php';
$manager = new FileBookManager('bookManagement.txt');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['ID'] ?? '';
    $title = $_POST['Title'] ?? '';
    $author = $_POST['Author'] ?? '';

    if ($id && $title && $author) {
        $manager->editBook($id, $title, $author);
        echo "Book with ID $id updated successfully.";
    } else {
        echo "All fields are required.";
    }
}
?>
