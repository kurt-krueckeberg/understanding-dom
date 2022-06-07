<?php
declare(strict_types=1);
/*
  argv[1] == start direcory
  argv[2] = regex for match file names
 */ 
$start_dir = $argv[1]; // Get start directory 

$file_name_regex = isset($argv[2]) ?  $argv[2] : '.*'; // Get regex

$file_name_regex = "%$file_name_regex" . ".md%i";

$start_dir = "/some_dir";

$file_name_regex = "curriculum.*\.md"; // Example regex to match

$file_name_regex = "%$file_name_regex" . ".md%i";

$iter = new RecursiveIteratorIterator(  new RecursiveDirectoryIterator($start_dir) );

/*
 * The anonymous function ensure file name matches the regex 
*/
$md_filter_iter = new \CallbackFilterIterator($iter, function(\SplFileInfo $info) use ($file_name_regex) { 

                                                      return $info->isfile()  && (1 == preg_match($file_name_regex, $info->getfilename()) ) ? true : false;
                                                  });

/* 
 * Next we create a closure that (in this example code) calls
  pandoc to convert the markdown files, .md, to .html file using the
  pandoc html template below.
 */
$template_name = '/usr/local/bin/pandoc-dark-template';

$md2html = function(\SplFileInfo $info) use ($template_name) 
{
   $base_name = $info->getBasename('.md');

   $output = $base_name . '.html'; 
   
   $cmd =  'pandoc ' . $info->getPathname() . ' --template ' . $template_name . ' -t html --metadata title=$base_name -s -o ' . $output;

   system( $cmd );

   fix_td_tags($base_name);
};


/*
  Finally, we invoke the cloosure for each file matching the regex.
 */
foreach ($md_filter_iter as $info) $md2html($info);

    © 2022 GitHub, Inc.

    Terms
    Privacy
    Security
    Status
    Docs
    Contact GitHub
    Pricing
    API
    Training
    Blog
    About

