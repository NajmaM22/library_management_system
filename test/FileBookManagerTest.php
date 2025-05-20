<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/FileBookManager.php';

class FileBookManagerTest extends TestCase {
    private $testFile = 'test_bookManagement.txt';
    private $manager;

    protected function setUp(): void {
        $this->manager = new FileBookManager($this->testFile);
        $this->manager->clearFile();
    }

    public function testAddBookSuccess() {
        $result = $this->manager->addBook("Test Title", "123", "Author Name");
        $this->assertTrue($result);
        $contents = $this->manager->getFileContents();
        $this->assertEquals("Test Title,123,Author Name", $contents[0]);
    }

    public function testAddBookFailsWithMissingFields() {
        $result = $this->manager->addBook("", "123", "");
        $this->assertFalse($result);
        $this->assertCount(0, $this->manager->getFileContents());
    }

   // public function testAddBookFailsOnWrongFormat() {
       // $this->manager->addBook("Book C", "003", "Author C");
       // $contents = $this->manager->getFileContents();
       // $this->assertEquals("Wrong Data Format", $contents[0]); // ❌ Intentionally fails
   // }

    protected function tearDown(): void {
        if (file_exists($this->testFile)) {
            unlink($this->testFile);
        }
    }
}
