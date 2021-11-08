<?php
declare(strict_types = 1);

  try {
     
     $ifile = new \SplFileObject("./untertitel.txt" , "r");

     $ifile->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

     $ofile = new \SplFileObject("output.txt", "w");

     $regex = '/^(-[^-]+)(-[^-]+) : (-[^-]+)(-[^-]+)$/U';

     $replacement = "$1 : $3\n$2 : $4\n";
     $cnt = 0;

     foreach ($ifile as $line) {

          if (preg_match($regex, $line, $matches) === 1) {

               $str = preg_replace($regex, $replacement, $line);
               $ofile->fwrite($str);
               ++$cnt;

          } else {
               
              $ofile->fwrite($line . "\n");
          }
         
     }
     echo $cnt . " matched lines written.\n";

   } catch(\Exception $e)  {
     
        echo 'Caught Exception: ' . $e->getMessage() . ". Occurred at line: " . $e->getLine() . "\n";
  }
