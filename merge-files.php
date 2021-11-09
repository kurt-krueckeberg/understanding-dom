#!/usr/bin/env php
<?php
declare(strict_types = 1);

if ($argc != 3) {
   echo "Enter the name of subtitle files: first the German file name, then the English.\n";
   return;
}

$dfile = $argv[1];
$efile = $argv[2];

  try {
     
     $dfile = new \SplFileObject($argv[1] , "r");

     $dfile->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);
   
     $efile = new \SplFileObject($argv[2] , "r");

     $efile->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

     $ofile =  new \SplFileObject("merged-output.txt" , "w"); 

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
