#!/usr/bin/env php
<?php
declare(strict_types = 1);

use \SplFileObject as File;

if ($argc != 3) {
   echo "Enter the name of subtitle files: first the German file name, then the English.\n";
   return;
}

$dfile = $argv[1];
$efile = $argv[2];

  try {
     
     $dfile = new File($argv[1] , "r");

     $dfile->setFlags(File::READ_AHEAD | File::SKIP_EMPTY | File::DROP_NEW_LINE);
   
     $efile = new File($argv[2] , "r");

     $efile->setFlags(File::READ_AHEAD | File::SKIP_EMPTY | File::DROP_NEW_LINE);

     $ofile =  new File("merged-output.txt" , "w"); 

     while(!$dfile->eof()) {

         $dline = $dfile->fgets();
         $eline = $efile->fgets();

         $ofile->fwrite($dline . " # "  . $eline . "\n");
     }

   } catch(\Exception $e)  {
     
        echo 'Caught Exception: ' . $e->getMessage() . ". Occurred at line: " . $e->getLine() . "\n";
  }

// exec("cp ./text.txt ./*wunder.html /home/kurt/php-util/"); 
// exec("mv ./*wunder.html ../");
