# php-util

## html2utf.php

Converts all .html files in the current directory to unix unicode by:

* calling dos2unx
* calling `iconv` to convert from ISO-8859-1 to UTF-8.

If you want to recurse the subdirectories, change DirectoryIterator to RecursiveDirectoryIterator:

    $dir_recurse_iter = new \RecursiveIteratorIterator(RecursiveDirectoryIterator($dir_path));

    $files_only_iter = new \CallbackFilterIterator($dir_recurse_iter, function(\SplFileInfo $file_info) {
                    return $file_info->isFile();
                });
                
    $filter_iter = new \RegexIterator($files_only_iter, $regex);

Note: A foreach loop returns a \DirectoryIterator, which extends SplFileInfo:

    // class DirectoryIterator extends SplFileInfo implements SeekableIterator {...}

    foreach($filter_iter as $dir_iter) 
          FunctionObject($dir_iter); 


Google for further help.

## replace-menus.php

This is a php script called from `find . -maxdepth1 -name "*.html" -exec ./replace-menu.php {} \;`
It does:

* Doing: `$line = preg\_replace('/(charset=)(?:iso|ISO)-8859-1/', '$1UTF-8', $line);`
* Replacing selected German menu text with English

## TODO

* Merge replace-menus.php code into html2utf?
