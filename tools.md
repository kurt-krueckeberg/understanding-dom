# php-util

## DOM and XPath

https://www.the-art-of-web.com/php/html-xpath-query/
https://www.phpdocx.com/documentation/introduction/docxpath

## class FileReadIterator

FileReadIterator allows a file, whose name is passed in the constructor, to be used in foreach loops by implementing the \Iterator interface (and nothing else). It's only
"advantagge" over, say, \SplFileObject is that it is strictly an \Iterator, which in PHP means a read-only, forward iterator (that can be dereferenced...), and nothing more. 

## PHP Data Structures Extension

* [Efficient Data Structures for PHP](https://medium.com/@rtheunissen/efficient-data-structures-for-php-7-9dda7af674cd)

## Polyfill Extension

See it on [github](https://github.com/php-ds/polyfill)

[Github Repository](https://github.com/php-ds/ext-ds)

Note: To restart the PHP Fascgi process, do: 

    sudo systemctl restart php8.0-fpm

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
It does this:

* Doing: `$line = preg\_replace('/(charset=)(?:iso|ISO)-8859-1/', '$1UTF-8', $line);`
* Replacing selected German menu text with English

## TODO

* Merge replace-menus.php code into html2utf?
* Add algorithms.php and other relevant code from the 501 Verbs repository to this repository.
* See also: https://github.com/php-ds/ext-ds
