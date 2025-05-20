<?php
require_once 'src/FileBookManager.php';
$manager = new FileBookManager('bookManagement.txt');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['ID'] ?? '';
    if ($id) {
        $manager->deleteBook($id);
        echo "Book with ID $id deleted successfully.";
    } else {
        echo "ID is required.";
    }
}
?>
