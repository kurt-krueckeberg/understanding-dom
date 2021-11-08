<?php
declare (strict_types=1);

namespace App\File;

class FileReadIterator implements \Iterator {

    private $lineno;
    private $fh;   
    private $current;  // current line of text

    private function close()
    {
        fclose($this->fh);
    }    

    private function read()
    {
       if (!feof($this->fh)) {

            $res = fgets($this->fh);

            if ($res !== false) {

                $this->current = trim($res);
                ++$this->lineno;
            }
       } 
    }

    public function __destruct() 
    {
         $this->close();
    }

    public function __construct(string $filename) 
    {
       $this->fh = fopen($filename, "r"); 

       if ($this->fh === false) 
           throw new \ErrorException("fopen($filename, 'r') Failed!");
       
       $this->lineno = 0;
    }

    public function current() : mixed
    {
      return $this->current; 
    }

    public function rewind() 
    {
       fseek($this->fh, 0); 

       $this->lineno = 0;

       $this->read(); 
    }

    public function valid() : bool  
    {
        return !feof($this->fh);
    }
 
    public function key() : int  
    {
        return $this->lineno;
    }

    public function next() 
    {
       $this->read(); 
    }
}
