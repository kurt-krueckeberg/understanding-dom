<?php
declare(strict_types=1);
/*
 *
 * Note: FilterIterator extends IteratorIterator implements OutIterator {
 *
 */
class FileFilterIterator extends \FilterIterator { 

    private $regex;

    public function __construct(\Iterator $iterator, string $regex)
    {
        parent::__construct($iterator);

        $this->regex = '/' . $regex . "/i";
    }

    public function accept() : bool
    {
        return $this->current()->isFile() && preg_match($this->regex, $this->getFilename());
    }

    public function __toString() : string
    {
        return $this->current()->getFilename();
    }
} 
 
function find_files(string $regex)
{
   $dir = dirname(__FILE__);

   $iter = new DirectoryIterator($dir);

   $filter = new FileFilterIterator($iter, $regex);
   
   foreach($it as $file) {
   
     $file . "\n";
   }
}

find_files("\.php$");
