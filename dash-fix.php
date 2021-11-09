<?php
declare(strict_types = 1);

/*
 *  Rewriter breaks lines with two dashes into two lines before writing it to the file.on a line by rewriting both the German and English files with the lines broken into two lines.
 */
class Rewriter {

  private static $regex = '/^(-[^-]+)(-.+)$/U';
  private static $replacement = "$1\n$2\n";
  private $file;

  public function __construct(string $fname)
  {
     $this->file = new \SplFileObject($fname, "w");
  }

  public function __invoke(string $line)
  {
   
    $str = preg_replace(self::$regex, self::$replacement, $line);
    
    $this->file->fwrite(trim($str) . "\n");
  }
}

if ($argc != 2) {
    
    echo "Enter the names of German subtitles file.";
    return;
}

  try {
     
     $dfile = new \SplFileObject($argv[1] , "r");

     $dfile->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);
          
     $process_de = new Rewriter("./new-" . $argv[1]);
     
     while(!$dfile->eof()) { 
         
         $dline = $dfile->fgets();
         $process_de($dline);
     }

   } catch(\Exception $e)  {
     
        echo 'Caught Exception: ' . $e->getMessage() . ". Occurred at line: " . $e->getLine() . "\n";
  }
