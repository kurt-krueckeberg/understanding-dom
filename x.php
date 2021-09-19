<?php

$str = '<a href="some_file.html">Überblick</a>';

echo "Input is:\n $str \n"; 

$out = str_replace("Überblick", "Overview", $str);

echo "Output is: \n" . "$out\n";
  
