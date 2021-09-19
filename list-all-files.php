<?php
/*
 * Recursively finds all files in a folder and its subfolders (and their subfolders, etc).
 */
function find_file_recursive($dir_path)
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
