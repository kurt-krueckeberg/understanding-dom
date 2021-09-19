<?php

require_once "util.php";

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
class FileConvertions {
  public function __invoke(\SplFileInfo $file_info)
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

transform_files('/\.html/i', new FileConvertions());
