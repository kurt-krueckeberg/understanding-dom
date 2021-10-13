<?php
declare(strict_types = 1);

use App\File\FileObject;

require_once "./boot-strap/boot-strap.php";

error_reporting(E_ALL ^ E_WARNING);  

$ifile = new FileObject("filename", "r");
$ofile = new FileObject("filename", "w");

foreach($ifile as $input_line) {
      
    $line = trim($input_line);

    // TODO: Alter $line as desired


    $ofile->fwrite($line);
}
