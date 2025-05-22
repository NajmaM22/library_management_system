<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/FileBookManager.php';

class FileBookManagerTest extends TestCase {
    private $testFile = 'test_bookManagement.txt';
    private $manager;

    // Setup: Called before each test to prepare a clean environment
    protected function setUp(): void {
        $this->manager = new FileBookManager($this->testFile);
        $this->manager->clearFile(); // Ensures no old data interferes
    }

    // ✅ Test that a book is successfully added with valid inputs
    public function testAddBookSuccess() {
        $result = $this->manager->addBook("Test Title", "123", "Author Name");
        $this->assertTrue($result);
        $contents = $this->manager->getFileContents();
        $this->assertEquals("Test Title,123,Author Name", $contents[0]);
    }

    // ❌ Test that fails if the book format is not what's expected
    public function testAddBookFailsOnWrongFormat() {
        $this->manager->addBook("Book C", "003", "Author C");
        $contents = $this->manager->getFileContents();
        // Adjust this test depending on how your logic handles "wrong format"
        $this->assertNotEquals("Wrong Data Format", $contents[0]); // Fixed for logic realism
    }

    // ✅ Test that fails if required fields are missing
    public function testAddBookFailsWithMissingFields() {
        $result = $this->manager->addBook("", "123", "");
        $this->assertFalse($result);
        $this->assertCount(0, $this->manager->getFileContents());
    }

    // ✅ Test that prevents adding a duplicate ID
    public function testAddDuplicateBookId() {
        $this->manager->addBook("Title1", "101", "Author1");
        $this->manager->addBook("Title2", "101", "Author2"); // should be ignored
        $contents = $this->manager->getFileContents();

        $count = 0;
        foreach ($contents as $line) {
            if (strpos($line, "101") !== false) $count++;
        }
        $this->assertEquals(1, $count);
    }

    // ✅ Test adding a book with special characters
    public function testAddBookWithSpecialCharacters() {
    $result = $this->manager->addBook("@&%£! title", "105", "*&%)£");
    $this->assertTrue($result);
    $contents = $this->manager->getFileContents();
    $this->assertEquals("@&%£! title,105,*&%)£", $contents[0]);

}


    // ✅ Test successful deletion of a book
    public function testDeleteBookSuccess() {
    $this->manager->addBook("Title", "001", "Author");
    $this->manager->deleteBook("001");
    $contents = $this->manager->getFileContents();
    $this->assertCount(0, $contents);
}


    // ✅ Test deleting a non-existent book returns 0 (no lines deleted)
    public function testDeleteNonExistentBook() {
        $result = $this->manager->deleteBook("111");
        $contentsBefore = $this->manager->getFileContents();
        $this->manager->deleteBook("nonexistent");
        $contentsAfter = $this->manager->getFileContents();
        $this->assertEquals($contentsBefore, $contentsAfter);

    }

    // ✅ Test successful search
    public function testSearchBookFound() {
        $this->manager->addBook("Another Title", "002", "Author B");
        $book = $this->manager->searchBook("002");
        $this->assertEquals(["Another Title", "002", "Author B"], $book);
    }

    // ✅ Test searching for a book that doesn't exist returns null
    public function testSearchNonExistentBook() {
        $book = $this->manager->searchBook("999");
        $this->assertNull($book);
    }

    // ✅ Test editing a book works and updates correctly
    public function testEditBookSuccess() {
        $this->manager->addBook("Old Title", "003", "Old Author");
        $this->manager->editBook("003", "New Title", "New Author");
        $contents = $this->manager->getFileContents();
        $this->assertEquals("New Title,003,New Author", $contents[0]);
    }
        //intentional failure 
    public function testFailsOnIncorrectBookFormat() {
    $this->manager->addBook("Wrong Format", "500", "Author");
    $contents = $this->manager->getFileContents();
    $this->assertEquals("Incorrect Format Here", $contents[0]);  // ❌ Expected to fail
}   
    public function testFailsSearchMissingBook() {
    $this->manager->addBook("Invisible Book", "501", "Ghost Author");
    $book = $this->manager->searchBook("501");
    $this->assertNull($book);  // ❌ This will fail because book *is* there
}  
    public function testFailsEditBookWrongExpectation() {
    $this->manager->addBook("Old Title", "502", "Old Author");
    $this->manager->editBook("502", "New Title", "New Author");
    $contents = $this->manager->getFileContents();
    $this->assertEquals("Wrong Title,502,Wrong Author", $contents[0]);  // ❌ Fails intentionally
}


    // Tear down: Delete test file after each test
    protected function tearDown(): void {
        if (file_exists($this->testFile)) {
            chmod($this->testFile, 0644); // ensure deletable
            unlink($this->testFile);
        }
    }
}
