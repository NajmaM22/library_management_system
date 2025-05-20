<?php

class FileBookManager {
    private $file;

    public function __construct($filePath = 'bookManagement.txt') {
        $this->file = $filePath;
    }

    public function addBook($title, $id, $author) {
        if ($title && $id && $author) {
            $line = "$title,$id,$author\n";
            file_put_contents($this->file, $line, FILE_APPEND);
            return true;
        }
        return false;
    }

    public function getFileContents() {
        return file_exists($this->file) ? file($this->file, FILE_IGNORE_NEW_LINES) : [];
    }

    public function clearFile() {
        file_put_contents($this->file, '');
    }
}
