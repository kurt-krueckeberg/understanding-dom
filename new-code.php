<?php
declare(strict_types = 1);
use App\File\TextFileReadIterator;

include 'boot-strap/boot-strap.php';
boot_strap();

require_once "./headers.php";

class Writer {

   private $ofile;
   private $defile;
   private $enfile;
   private static $regex = "/^(.+)\s:\s(.*)$/U"; // With the non-ngreedy modifier U, the first  " : " will match. 

   private static $header;
   private static $footer;

   public function __invoke(string $text)
   {
   }

   public function __construct($outfile)
   { 
     $this->ofile  = fopen($outfile, "w");
     $this->deFile = fopen('de-' . $outfile, "w");
     $this->enFile = fopen('en-'.  $outfile, "w");
   } 

   public function __destruct()
   {   

  $ofile->write($footer . "\n");
  $deFile->write($footer . "\n");
  $enFile->write($footer . "\n");

   }
 
   public function write(string $text)
   {
      
   }

}

function write_paragraphs(string $text, File $ofile,  File $deFile,  File $enFile)
{    
    $regex = "/^(.+)\s:\s(.*)$/U"; // With the non-ngreedy modifier U, the first  " : " will match. 

    $rc = preg_match($regex, $text, $matches);

    if ($rc === 1) {
        
        if ($matches[1][0] == '-') {
             
            $par = "<p class='new-speaker'>"; 
            $matches[1] = substr($matches[1], 2);

            if ($matches[2][0] == '-') // When the German string starts with a dash followed by a blank ("- "), the English sometimes doesn't so check.
                $matches[2] = substr($matches[2], 2); 
            
        } else 

           $par = '<p>';
         
        $ofile->fwrite("{$par}$matches[1]</p>{$par}$matches[2]</p>\n");                

        $deFile->fwrite("{$par}$matches[1]</p>\n");                

        $enFile->fwrite("{$par}$matches[2]</p>\n");                
     
    } else

        throw new \ErrorException("Fatal Error: Colon not found in paragraph with text of:\n$text\n");
}

if ($argc != 3) {
   echo "Enter both the name of input file followed by the name of the output file.\n";
   return;
}

$infile = $argv[1];
$outfile = $argv[2];

  try {
     
     $ifile = new TextFileReadIterator($infile, "r");
     $writer = new Writer($outfile);

     $writer->write($two_cols_header);

     foreach($ifile as $text) 

        $writer->write($text);

   } catch(\Exception $e)  {
     
        echo 'Caught Exception: ' . $e->getMessage() . ". Occurred at line: " . $e->getLine() . "\n";
  }
  
