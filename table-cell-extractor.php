<?php
declare(strict_types=1);


function get_tableRows(string $file)
{
 // new dom object
  $dom = new DOMDocument();

  //load the html
  $rc = $dom->loadHTMLFile($file);
  
  $dom->strictErrorChecking = false;

  //discard white space 
  $dom->preserveWhiteSpace = false; 

  //the table by its tag name
  $tables = $dom->getElementsByTagName('table'); 

  //get all rows from the table
  foreach($tables as $table) {  // $rows = $tables->item(0)->getElementsByTagName('tr'); 
    
     echo "Table cell contents follow:\n\n";
 
     $rows = $table->getElementsByTagName('tr'); 

     // loop over the table rows
     foreach ($rows as $row)   { 
     
      // get each column by tag name
         $cols = $row->getElementsByTagName('td'); 
         foreach ($cols as $col) {

           echo strtolower($col->nodeValue) . " | "; 
         }            
      /* echo the values  
         echo strtolower($cols->item(0)->nodeValue) . "\n"; 
         echo $cols->item(1)->nodeValue . "\n"; 
         echo $cols->item(2)->nodeValue . "\n"; */
       }
       echo "\n"; 
    }
}

get_tableCells("html-with-table.html");
