# PHP Data Structures Extension

## Introduction

The [PHP Data Structures Extension](https://www.php.net/manual/en/book.ds.php) for **PHP 7** provides the solutions and improved performance of classical data structures, and is an alternative to PHP's one-fize-fits-all ``array``.
The **Ds** classes&mdash;Vector, Deque, Map, Set, Stack, Queue, PriorityQueue and Pair&mdash;and their interfaces&mdash;Collection, Hashable and Sequence&mdash;are explained in [Efficient Data Structures for PHP](https://medium.com/@rtheunissen/efficient-data-structures-for-php-7-9dda7af674cd)
written by extension's author. They are also discussed in this [Reddit thread](https://www.reddit.com/r/PHP/comments/b6ffs5/who_here_uses_ds_data_structures_and_for_which/).

Answers to questions can be found at the end of the **Ds** github repository [README](https://github.com/php-ds/ext-ds).

There is also another&mdash;I believe&mdash;related extension, [polyfill](https://github.com/php-ds/polyfill). 

## Importanat Comment on Installation

If you are using **nginx**, you will need to restart the PHP Fascgi process: 

    sudo systemctl restart php7.4-fpm
