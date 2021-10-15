<?php
declare(strict_types=1);

// require_once "util.php"; // We need the transform_files (in current directory)

/*
 * Loops invoking the function object on the derefereced FilterIterator
 */ 
function transform_files(\FilterIterator $filter_iter, callable $func_object)
{         
   foreach($filter_iter as $x) {
      $func_object($x);
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
class FileTransforms {

  public function __invoke(\DirectoryIterator $file_info)
  {

     $fname_html = $file_info->getFilename();

     $fname_html_noext = $file_info->getBasename(".html"); 

     exec("dos2unix " . $fname_html);

     // Change encoding of .htmml file and save it with entension of .utf-8 
     $convert_cmd = "iconv -f ISO-8859-1 -t UTF-8 " . $fname_html .  " -o " . "$fname_html_noext.utf-8";

     exec($convert_cmd);
   
     $cmd = "mv $fname_html_noext" . ".utf-8 $fname_html_noext" . '.html';
          
     exec($cmd);  
  }
} 

$dir = dirname(__FILE__);

$dir_iter = new DirectoryIterator($dir);
    
$files_only_iter = new \CallbackFilterIterator($dir_iter, function(\SplFileInfo $file_info) {
                 return $file_info->isFile();
             });
             
$regex = '/\.html$/i';

$filter_iter = new \RegexIterator($files_only_iter, $regex);

transform_files($filter_iter, new FileTransForms());
