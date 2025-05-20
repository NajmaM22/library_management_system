<?php
require_once 'src/FileBookManager.php';
$manager = new FileBookManager('bookManagement.txt');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['ID','Title'] ?? '';
    if ($id) {
        $manager->deleteBook($id,$title);
        echo "Book with ID $id and Title $Title deleted successfully.";
    } else {
        echo "ID  and title is required.";
    }
}
?>
