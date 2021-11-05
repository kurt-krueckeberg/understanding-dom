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
 
class FileIterator implements \Iterator {

    private $line_no;
    private $fh;   // generalize to a bool called is_valid?
    private $current;  // current line of text

    private function close_()
    {
      if ($this->fh !== false);
         fclose($this->fh);
    }    

    private function read_()
    {
       if ($this->fh !== false && !feof($this->fh)) {

            $res = fgets($this->fh);

            if ($res !== false) {

                $this->current = $res;
                ++$this->line_no;
            }
       } 
    }

    public function __construct(string $filename, string $mode, bool $use_include_path = false) 
    {
       $this->line_no = 0;

       $this->fh = fopen($filename, $mode, $use_include_path);

       if ($this->fh === false) 
           return; 
        
       $this->read_(); 
    }

   public function get_lineno() : int
   {
        return $this->line_no;
   }
   
    public function current() : string
    {
      return $this->current_; 
    }

    public function rewind() 
    {
       if ($this->fh === false) return;
         
       fseek($this->fh); 

       $this->line_no = 0;

       $this->read_(); // Is next() called after rewind()? 
    }

    public function valid() : bool
    {
        if ($this>fh === false)
           return false;
        else  
           return !feof($this->fh);
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
