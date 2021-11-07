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
 
class TextFileReadIterator implements \Iterator {

    private $line_no;
    private $fh;   
    private $current;  // current line of text

    private function close_()
    {
        fclose($this->fh);
    }    

    private function read_()
    {
       if (!feof($this->fh)) {

            $res = fgets($this->fh);

            if ($res !== false) {

                $this->current = $res;
                ++$this->line_no;
            }
       } 
    }

    public function __destruct() 
    {
         $this->close_();
    }

    public function __construct(string $filename) 
    {
       $this->line_no = 0;

       $this->fh = fopen($filename, "r"); 

       if ($this->fh === false) 
           throw new \ErrorException("fopen($filename, $mode, $use_include_path) Failed!");
        
       $this->read_(); 
    }

    public function current() : string
    {
      return $this->current_; 
    }

    public function rewind() 
    {
       fseek($this->fh, 0); 

       $this->line_no = 0;

       $this->read_(); // Is next() called after rewind()? 
    }

    public function valid() : int  
    {
        return feof($this->fh);
    }
 
    public function key() : int  
    {
        return $this->line_no;
    }

    public function next() 
    {
       $this->read_(); 
    }
}
