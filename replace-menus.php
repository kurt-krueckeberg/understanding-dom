#!/usr/bin/env php

// BUG: Function below only takes two arrays.
/*

Fix:
*/
<?php
use App\File\FileObject;


function replace_text(string $file_name, array $replace) // <--- NEW code.
{
   $ifile = new FileObject($file_name, "r");

   // Temporary outfile has the same name with extra .new extension.
   $ofile = new  FileObject($file_name . '.new', "w");
   
   $b_menu_y = $b_menu_x = 'false';

   // Note: You can't have an inner foreach identical to this one.
   foreach ($ifile as $line) {
       
     $output = $line; 
     //$line = trim($data);
   
     if ($line === false)
         break;
   
     // Change 'charset=iso-8859-1' to 'charset=UTF-8'
     if (strpos($line, '<meta http-equiv=') !== false) 
   
         $line = preg_replace('/(charset=)(?:iso|ISO)-8859-1/', '$1UTF-8', $line);
   
     else if (strpos($line, '<div id="menue">') !== false)
            $b_menu_x = true;
   
     else if ($b_menu_x && strpos($line, "</div>") !== false) 
            $b_menu_x = false;
  
     else if ($b_menu_y && strpos($line, '</div>') !== false)
            $b_menu_y = false;   
  
     else if (strpos($line, '<div id="headline_container_content">') !== false)
            $b_menu_y = true;

     if ($b_menu_x === true)
         $line = str_replace($replace['x'][0], $replace['x'][1], $line); 
     else if ($b_menu_y === true)
         $line = str_replace($replace['y'][0], $replace['y'][1], $line); 
   
     $ofile->fwrite($line . "\n");
   }

   $ifile = null; // Closes the files
   $ofile = null;

   // Move the temporary file over the original.
   $cmd = "mv $file_name.new $file_name";

   exec($cmd); 
}

if ($argc != 2) {
  echo "You must enter the file name.\n";
  return;
}
 
require_once "./boot-strap/boot-strap.php";

error_reporting(E_ALL ^ E_WARNING);  

boot_strap();

$german_menu_x = array(
    '>Überblick',
   '>Schaumburg im Mittelalter',
   '>Schaumburg im 16. und 17. Jahrhundert',
   '>Nach 1647: Grafschaft Schaumburg hessischen Anteils',
   '>Nach 1647: Grafschaft Schaumburg lippischen Anteils / Schaumburg-Lippe',
   '>Wiedervereinigung im Landkreis Schaumburg 1977',
   '>Schaumburgische Genealogie',
   '>Schaumburg-Lippische Genealogie',
   '>Historische Karten und Ansichten',
   '>Schaumburger Auswanderer',
   '>Schaumburgische Bibliographie',
   '>Suche');

$english_menu_x = array( '>Overview',
   '>Schaumburg in the Middle Ages',
   '>Schaumburg in the 16th and 17th Century',
   '>After 1647: Grafschaft Schaumburg, Hessish Section',
   '>After 1647: Grafschaft Schaumburg, Lippe Section / Schaumburg-Lippe',
   '>Reunification in the county of Schaumburg 1977',
   '>Schaumburg Genealogy',
   '>Schaumburg-Lippe Genealogy',
   '>Historical Maps and Views',
   '>Schaumburger Emigrants',
   '>Schaumburg Bibliography',
   '>Search');

$german_menu_y = array(">Publikationen<",
">Aktuelles<",
">Geschichte Schaumburgs<");

$english_menu_y = array(
">Publications<",
">Latest<",
">Schaumburg&#39;s History<");

$replacements['x'] = array($german_menu_x, $english_menu_x);
$replacements['y'] = array($german_menu_y, $english_menu_y);

replace_text($argv[1], $replacements);
