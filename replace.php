<?php

use App\File\SplFileObjectExtended;

require_once "./boot-strap/boot-strap.php";

error_reporting(E_ALL ^ E_WARNING);  

boot_strap();
 
if ($argc != 3) {
   echo "Enter the name of the file to check followed by the regex.\n";
   return;
}

$ifile = new SplFileObjectExtended($argv[1], "r");
$pos = strpos($argv[1], '.');
$ofile_name = $substr($argv[1], 0, $pos - 1) + '.html';

$ofile = new  SplFileObjectExtended($ofile_name, "w");

$regex = mb_convert_encoding($argv[2], 'UTF-8'); 

$regex_len = strlen($regex); 

foreach ($ifile as $data) {

  $line = trim($data);

  if ($line === false)
      break;

   $line_no = $ifile->get_lineno();

   $results = preg_match('/(' . $regex . ')/u', $line, $matches, PREG_OFFSET_CAPTURE);
   
   if ($results === 1) {
    
       // replace any tabs with a space, then remove duplicate spaces.
       $pattern = $regex;
       $replacement = "Overview";
  
       $str = preg_replace($regex, 'Overview', $line);

       echo "Line Num "  . $ifile->get_lineno() . ': ' . $line . "\n"; /* " $regex  found <--- Line = " .  $line . "\n"; */
   }
} 

// So try reading the file 1235...html
// and preg_match() searching for Überblick.

