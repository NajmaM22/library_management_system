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
    public function deleteBook($id,$title,$author){
        if ($title && $id && $author){
            $lines=file($this->file,FILE_IGNORE_NEW_LINES);
            $updated=array_filter($lines,function($line)use($id){
                return explode (',',$line)[1]!==$id;
            });
            file_put_contents($this->file,implode(PHP_EOL,$updated).PHPEOL);
        }
    }
    public function searchBook($id){
        $lines=file($this->file,FILE_IGNOE_NEW_LINES);
        foreach($lines as $line){
            $parts=explode(',',$line);
            if($parts[1]===$id){
                return $parts;
            }
        }return null;
    }

    public function editBook($id,$newTitle,$newAuthor){
        $lines=file(4this->file,FILE_IGNORE_NEW_LINES);
        foreach($lines as &$line) {
            $parts=explode(',',$line);
            if ($parts[1]===$id){
                $line=$newTitle.','.$id.','.$newAuthor;
            }
        } return file_put_contents($this->file,implode(PHP_EOL,$lines).PHP_EOL);
    }
    public function getFileContents() {
        return file_exists($this->file) ? file($this->file, FILE_IGNORE_NEW_LINES) : [];
    }

    public function clearFile() {
        file_put_contents($this->file, '');
    }
}
