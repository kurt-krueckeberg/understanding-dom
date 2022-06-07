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
 *  Example usaage:

   $dir = dirname(__FILE__);

   $dir_iter = new DirectoryIterator($dir);

   // Note: $file_info->isDir() checks if it is a directory       

   $files_only_iter = new \CallbackFilterIterator($dir_iter, function(\SplFileInfo $file_info) {
                    return $file_info->isFile();
                });
                
   $filter_iter = new \RegexIterator($files_only_iter, $regex);

   transform_files($filter_iter, new FunctionObject());
 */
 
function transform_files(\Iterator $iter, callable $func_object)
{
         
   foreach($iter as $x)
        $func_object($x);
}
 
/*
 * Recursively finds all files in a folder and its subfolders (and their subfolders, etc).
 */
function recursive_file_find($dir_path)
{
   $iter = new \RecursiveIteratorIterator(RecursiveDirectoryIterator($dir_path));

   foreach ($iter as $file) {
   
       if (!$file->isFile())
           continue;
   
       echo $file->getPathname() . "\n"; 
   }
}

/*
 * Formats html input, so new tags start on a new line and they are indepnt from
 * their parent
 */ 
function pretty_html(string $html) : string
{
  $dom = new DOMDocument();

  $dom->preserveWhiteSpace = false;
  
  @$dom->loadHTML($h,LIBXML_HTML_NOIMPLIED);
  
  $dom->formatOutput = true;

  return $dom->saveXML($dom->documentElement);
}   
