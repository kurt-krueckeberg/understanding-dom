#!/usr/bin/env php
<?php
declare(strict_types = 1);

require_once "./headers.php";

error_reporting(E_ALL ^ E_WARNING);  

/*
 Assumes paragraphs are in the form
 <p> With no text at all on the line with the <p> tag
 text...text..
 text...text..
 </p>
 Finite states:
 b -- before paragraph text
 p -- paragraph found -- not used
 i -- in paragraph -- not used
 e -- end of paragraph
 */
function get_paragraph($file)  // class ParagraphParser { ... }
{
   $text = '';

   $state  = 'b';
   $exit = false;

   while ($state != 'e' && !$file->eof()) {
   
     $line = $file->current();
     
     if ($line === false)
         return $text;

     switch ($state) {

         case 'b':

             if (strpos($line, "<p>") === 0) 
                 
                 $state = 'i'; 

             $file->next();
             break;

         case 'i':
  
            if (strpos($line, "</p>") === 0) { // Done

                $state = 'e'; 
                $file->next();        
                break; 
            } 

            $text .= (trim($line) . ' ');
            $file->next(); 
            break;
         default:
            break;
     }
   }
   return preg_replace('(\s\s)', ' ', $text);
}

/*
 Input: text to write followed by three columns:
   1. The first file has two columns: German and English
   2. 2nd file onely one column in German
   2. 3nd file onely one column in English
*/
function write_paragraphs(string $text, \SplFileObject $ofile,  \SplFileObject $deFile,  \SplFileObject $enFile)
{    
    $regex = "/^(.+)\s:\s(.*)$/U"; // Note: U is the ungreedy modifier. This ensure finding only the first  " : " sub-string,
                                   // if there happen such sub-strings.
    
    $rc = preg_match($regex, $text, $matches);
  
    if ($rc === 1) {
        
        if ($matches[1][0] == '-') {
             
            $par_prefix = "<p class='new-speaker'>"; 
            $matches[1] = substr($matches[1], 2);

            if ($matches[2][0] == '-') // When the German string starts with a dash followed by a blank ("- "), the English sometimes doesn't.

                $matches[2] = substr($matches[2], 2); 
            
        } else 

           $par_prefix = '<p>';
         
        $ofile->fwrite("{$par_prefix}$matches[1]</p>{$par_prefix}$matches[2]</p>\n");                

        $deFile->fwrite("{$par_prefix}$matches[1]</p>\n");                

        $enFile->fwrite("{$par_prefix}$matches[2]</p>\n");                
     
    } else

        throw new \ErrorException("Colon not found in paragraph:\n$text\n");
}

if ($argc != 3) {
   echo "Enter both the name of input file followed by the name of the output file.\n";
   return;
}

$infile = $argv[1];
$outfile = $argv[2];

  try {

     $ifile = new \SplFileObject($infile, "r");
     
     $ifile->setFlags(SplFileObject::SKIP_EMPTY);
     
     $ofile = new \SplFileObject($outfile, "w");

     $ofile->fwrite($two_cols_header);

     $deFile = new \SplFileObject('de-' . $outfile, "w");
     $enFile = new \SplFileObject('en-'.  $outfile, "w");
     
     $deFile->fwrite($one_col_header);

     $enFile->fwrite($one_col_header);
     
     while (1) {
       
        $par = get_paragraph($ifile);
       
        if (empty($par)) 
            break;
                      
        write_paragraphs($par, $ofile, $deFile, $enFile);
    } 

  } catch(\Exception $e)  {
     
             echo 'Caught Exception: ' . $e->getMessage() . "\n";
  }
     
  $ofile->fwrite($footer . "\n");
  $deFile->fwrite($footer . "\n");
  $enFile->fwrite($footer . "\n");
