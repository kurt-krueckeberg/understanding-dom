<?php
declare(strict_types = 1);

// Fix the problem of two dashes on a line by rewriting both the German and English files with the lines broken into two lines.
class ProcessLine {

 private static $regex = '/^(-[^-]+)(-[^-]+) : (-[^-]+)(-[^-]+)$/U';
 private $file;

 public function __construct(string $fname)
 {
     $this->file = new \SplFileObject($fname, "w");
 }

 public function __invoke(string $line)
 {
    if (preg_match($regex, $line, $matches) === 1) {

         $str = preg_replace($regex, $replacement, $line);

         $file->fwrite($str);
         ++$cnt;

    } else {
         
        $file->fwrite($line . "\n");
    }
 }
}

  try {
     
     $dfile = new \SplFileObject("./de-untertitel.txt" , "r");

     $dfile->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);
 
     $efile = new \SplFileObject("./en-untertitel.txt" , "r");

     $efile->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);


     $replacement = "$1 : $3\n$2 : $4\n";
     $cnt = 0;

     $process_de = Process("de-output.txt");
     $process_en = Process("en-output.txt");

     while(!$dfile->eof()) { 

         $process_de($dline);
         $process_en($eline);
     }

   } catch(\Exception $e)  {
     
        echo 'Caught Exception: ' . $e->getMessage() . ". Occurred at line: " . $e->getLine() . "\n";
  }
