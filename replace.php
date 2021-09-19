<?php

use App\File\SplFileObjectExtended;

require_once "./boot-strap/boot-strap.php";

error_reporting(E_ALL ^ E_WARNING);  

boot_strap();

$ifile = new SplFileObjectExtended($file_name, "r");

$ofile = new  SplFileObjectExtended($ofile_name, "w");

foreach ($ifile as $data) {

  $line = trim($data);

  if ($line === false)
      break;

   if (:wq

   $output = str_replace($german_menu, $english_menu, $line);

   $ofile->fwrite($output . "\n");
} 
