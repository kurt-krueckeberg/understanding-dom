# php-util

## html2utf.php

Converts all .html files in the current directory to unix unicode by:

* calling dos2unx
* call iconv to convert to utf

## replace-menus.php

This is a php script called from `find . -maxdepth1 -name "*.html" -exec ./replace-menu.php {} \;`
It does:

* Doing: `$line = preg\_replace('/(charset=)(?:iso|ISO)-8859-1/', '$1UTF-8', $line);`
* Replacing selected German menu text with English

## TODO

* Merge replace-menus.php code into html2utf?
