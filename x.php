<?php
declare(strict_types = 1);

require_once "./boot-strap/boot-strap.php";

error_reporting(E_ALL ^ E_WARNING);  

boot_strap();

function get_paragraph($file) 
{
   $text = '';

   /*
    Finite states:

    b -- before paragraph
    p -- paragraph found
    i -- in paragraph
    e -- end of paragraph

    */
   $state  = 'b';

   while (!$file->eof()) {
   
     $line = $file->current();
     
     if ($line === false)
         return $text;

     switch ($state) {

         case 'b':

             if (strpos($line, "<p>") === 0) { // Continue until <p> found or eof 
                 
                 $state = 'i'; 
             } 

             $file->next();
             break;

         case 'i':
  
            if (strpos($line, "</p>") === 0) { // done

                $file->next();        
                return $text; 
            } 

            $text .= trim($line);
            $file->next(); 

         default:
            break;
     }
   }
  
   return $text;
}

function process_par($text, $dfile, $efile)
{
    $regex_colon = "/^([^:]+):(.*)$/";
 
    $rc = preg_match($regex_colon, $text, $matches);
    
    if ($rc === 1) {
          
         $dfile->fwrite("<p>\n$matches[1]\n</p>\n");     
         $efile->fwrite("<p>\n$matches[2]\n</p>\n");     

    } else {

         throw new \ErrorException("Colon not found in paragraph:\n$text\n");
    }
}

$ifile = new \SplFileObject("wunder-dialog.html", "r");

$ifile->setFlags(SplFileObject::SKIP_EMPTY);

$dfile = new \SplFileObject("german.html", "w");

$efile = new \SplFileObject("english.html", "w");

while (1) {

  try {

    $par = get_paragraph($ifile);

    if (empty($par))
          break;

    process_par($par, $dfile, $efile);

  } catch(\Exception $e)  {

        echo 'Caught Exception: ' . $e->getMessage() . "\n";
  }
}
