<?php
declare(strict_types=1);

class NullFunctionObject  {

   public function __construct()
   {
       // whatever
   }

   public function __invoke(\SplFileInfo $file_info)
   {
       echo "Doing Nothing to file " . $file_info->getBasename() . "\n";
       return;
   }
}

/*
 * Requires: 
 * 
 * 1. $regex - The file name must match the regular expression. Note %regex must include delimeters and flags; for example
 *
 *     '/\.html$/i'
 *
 * 2. $func_object must be a class that implements __invoke()
 * 
 */
 
function transform_files(string $regex, callable $func_object)
{
   $dir = dirname(__FILE__);

   $dir_iter = new DirectoryIterator($dir);
       
   $files_only_iter = new \CallbackFilterIterator($dir_iter, function(\SplFileInfo $file_info) {
                    return $file_info->isFile();
                });
                
   $filter_iter = new \RegexIterator($files_only_iter, $regex);
         
   foreach($filter_iter as $x)
        $func_object($x);
}

/*
 * Recursively finds all files in a folder and its subfolders (and their subfolders, etc).
 */
function find_files_recursive($dir_path)
{
   $iter = new \RecursiveIteratorIterator(RecursiveDirectoryIterator($dir_path));

   $files = array();
   
   foreach ($iter as $file) {
   
       if ($file->isDir()){ 
           continue;
       }
   
       $files[] = $file->getPathname(); 
   
   }
   
   var_dump($files);
}
