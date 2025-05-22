<?php

class FileBookManager {
    private $file;

    public function __construct($filePath = 'bookManagement.txt') {
        $this->file = $filePath;
    }

    public function addBook($title, $id, $author) {
    if (!is_writable($this->file)) return false;

    if ($title && $id && $author) {
        $lines = $this->getFileContents();
        foreach ($lines as $line) {
            if (explode(',', $line)[1] === $id) return false;
        }
        return file_put_contents($this->file, "$title,$id,$author\n", FILE_APPEND) !== false;
    }
    return false;
}



public function deleteBook($id) {
    $lines = $this->getFileContents();
    $updated = [];

    foreach ($lines as $line) {
        $parts = array_map('trim', explode(',', $line));
        if (count($parts) >= 2 && $parts[1] !== $id) {
            $updated[] = implode(',', $parts); // normalize format
        }
    }

    return file_put_contents($this->file, $updated ? implode(PHP_EOL, $updated) . PHP_EOL : '');

}


    public function searchBook($id) {
        $lines = file($this->file, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line) {
            $parts = explode(',', $line);
            if ($parts[1] === $id) {
                return $parts;
            }
        }
        return null;
    }

    public function editBook($id, $newTitle, $newAuthor) {
        $lines = file($this->file, FILE_IGNORE_NEW_LINES);
        foreach ($lines as &$line) {
            $parts = explode(',', $line);
            if ($parts[1] === $id) {
                $line = "$newTitle,$id,$newAuthor";
            }
        }
        return file_put_contents($this->file, implode(PHP_EOL, $lines) . PHP_EOL);
    }

    public function getFileContents() {
        return file_exists($this->file) ? file($this->file, FILE_IGNORE_NEW_LINES) : [];
    }

    public function clearFile() {
        file_put_contents($this->file, '');
    }
}
