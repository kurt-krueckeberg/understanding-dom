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
/*
 * Recursively finds all files in a folder and its subfolders (and their subfolders, etc).
 */
function find_files_recursive($dir_path)
{
   $iter = new RecursiveIteratorIterator(RecursiveDirectoryIterator($dir_path));

   $files = array();
   
   foreach ($iter as $file) {
   
       if ($file->isDir()){ 
           continue;
       }
   
       $files[] = $file->getPathname(); 
   
   }
   
   var_dump($files);
}



