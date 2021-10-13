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

            $text .= (' ' . trim($line));
            $file->next(); 

         default:
            break;
     }
   }
  
   return $text;
}

function add_start($file)
{
$header = <<<START
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title></title>
	<meta name="generator" content="LibreOffice 7.1.6.2 (Linux)"/>
	<meta name="created" content="00:00:00"/>
	<meta name="changed" content="2021-08-15T18:53:02.053049428"/>
	<style type="text/css">
                p { 
                   /* 
                   margin-right: auto;
                   margin-left: auto;
                   padding-left: 5em;
                   padding-right: 5em;
                   */
                   line-height: 140%;
                }
		table { 
		  border-collapse: collapse;
                  padding-left: 5em;
		  /* width: 100%; */
		}
                table td, table th {
                   padding-top: 4px;
                   padding-bottom: 4px;
                   padding-right: 8px; 
                }
                body {
                   padding-left: 5em;
                   font-family: 'Lato', Arial, sans-serif;
                }  
	</style>
</head>
<body>
<html>
<div id="container">
<table>
START;

   $start = $header . "\n";
   $file->fwrite($start);
}

function add_end($file)
{
$footer = <<<END
</div>
</table>
</body>
</html>
END;

   $end = $footer . "\n";
   $file->fwrite($end);
}

function process_par($text, $ofile)
{    
    //$regex_colon = "/^([^:]+?)\s:\s(.*)$/";
    $regex_colon = "/^(.*)\s:\s(.*)$/";
 
    $rc = preg_match($regex_colon, $text, $matches);
    
    //echo $matches[1] . "\n";
    //echo $matches[2] . "\n";
    
    if ($rc === 1) {
                         
          $ofile->fwrite("<tr>\n<td><p>$matches[1]</p></td><td><p>$matches[2]</p></td></tr>\n");
     
    } else {

         throw new \ErrorException("Colon not found in paragraph:\n$text\n");
    }
}

$ifile = new \SplFileObject("input-dialog.html", "r");

$ifile->setFlags(SplFileObject::SKIP_EMPTY);

$ofile = new \SplFileObject("dialog.html", "w");

add_start($ofile);

while (1) {

  try {

    $par = get_paragraph($ifile);

    if (empty($par))
          break;

    process_par($par, $ofile);

  } catch(\Exception $e)  {

        echo 'Caught Exception: ' . $e->getMessage() . "\n";
  }
}

add_end($ofile);

