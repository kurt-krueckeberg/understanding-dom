#!/usr/bin/php
<?php
if ($argc == 1) {

   echo "Missing search parameter.\n";
   echo "These supplied: \n";
   print_r($argv);
   return;
}

$param1 = ($argc == 3) ? $argv[1] : "*";  // if only two arguments, use "*".

if ($argc == 2) { 

  $str = 'find . -type f -name "*" -exec grep -nH "' . $argv[1] . '" {} \;';

} else {

  $str = 'find . -type f -name "*.' . $argv[1] . '" -exec grep -nH "' . $argv[2] . '" {} \;';
}

echo $str . "\n\n";

system($str);
