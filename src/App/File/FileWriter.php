<?php
declare (strict_types=1);

namespace App\File;
/*
 File is a simply file class for reading and writing file that can used in foreach-loops just like SplFileObject. The Iterator interface is required to support
 "foreach($fileObject as $line)" syntax, and Traversable's abstract method must be declared and implemented within File itself: you cannot automatically forward the implmentation
 using the magic method __call() to $this->file.

 You can call all the methods of \SplFileInfo; however, unlike \SplFileObject that implements the \SeekableIterator and \RecusriveIterator interfaces, you cannot call seek() method or
 the \RecursiveIterator methods getChildren() or hasChildren(). The RecursiveIterator methods are called implicitly by the PHP engine--but I don't know when that is, what the use-case is.
 */ 
 
class FileWriter {

    private $line_no;
    private $fh;   

    private function close_()
    {
        fclose($this->fh);
    }    

    public function write(string $text) : 
    {
       $res = fwrite($this->fh, "$text\n");

       if ($res === false)
            throw \ErrorExcpetion("Could not write: $text");
       
       ++$this->line_no;
    }

    public function __destruct() 
    {
         $this->close_();
    }

    public function __construct(string $filename) 
    {
       $this->fh = fopen($filename, "w"); 

       if ($this->fh === false) 
           throw new \ErrorException("fopen($filename, 'w') Failed!");
       
       $this->line_no = 0;
    }

    public function get_line_no() : int  
    {
        return $this->line_no;
    }
}
