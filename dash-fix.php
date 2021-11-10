<?php
declare(strict_types = 1);
use \SplFileObject as File;

/*
 *  Rewriter breaks lines with two dashes into two lines before writing them to the file, whose name was passed on the ctor.
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
    
    echo "Enter the names of subtitles file.";
    return;
}

  try {
     
     $dfile = new File($argv[1] , "r");

     $dfile->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);
          
     $rewrite = new Rewriter("./new-" . $argv[1]);
     
     foreach($dfile as $line) $rewrite($line);

   } catch(\Exception $e)  {
     
        echo 'Caught Exception: ' . $e->getMessage() . ". Occurred at line: " . $e->getLine() . "\n";
  }
