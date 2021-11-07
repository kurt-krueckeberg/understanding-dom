<?php
declare(strict_types = 1);
use App\File\TextFileReadIterator;

include 'boot-strap/boot-strap.php';
boot_strap();

  try {
     
     $iter = new TextFileReadIterator("text.txt");

     foreach($iter as $key => $line) {

        echo "Line $key: $line\n";
     } 

   } catch(\Exception $e)  {
     
        echo 'Caught Exception: ' . $e->getMessage() . ". Occurred at line: " . $e->getLine() . "\n";
  }
