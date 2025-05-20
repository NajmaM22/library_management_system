<?php
require_once 'src/FileBookManager.php';
$manager = new FileBookManager('bookManagement.txt');

$id = $_GET['ID'] ?? '';
if ($id) {
    $book = $manager->searchBook($id);
    if ($book) {
        echo "Book Found: Title: $book[0], ID: $book[1], Author: $book[2]";
    } else {
        echo "Book not found.";
    }
} else {
    echo "Please provide an ID.";
}
?>
