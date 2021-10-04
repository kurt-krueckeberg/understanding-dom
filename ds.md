# PHP Data Structures Extension

## Introduction

The [PHP Data Structures Extension](https://www.php.net/manual/en/book.ds.php) provides a set of classical data structures&mdash;Vector, Stack, Deque, Map, Queue, PriorityQueue, Pair and Set&mdash;as an alternative to the PHP's one-size-fits-all ``array`` data structure. You thereby get design flexibilty and improved performance.
The collection classes and the three interface&mdash;Collection, Hashable and Sequence&mdash;are described in the article [Efficient Data Structures for PHP](https://medium.com/@rtheunissen/efficient-data-structures-for-php-7-9dda7af674cd) written by the extension's author. It is also discussed in this
[Reddit thread](https://www.reddit.com/r/PHP/comments/b6ffs5/who_here_uses_ds_data_structures_and_for_which/).

The github repository for the Ds extneions has answers to user's questions at the end of its [README](https://github.com/php-ds/ext-ds).

There is also another&mdash;I believe&mdash;related extension by the ``Ds`` authors called [polyfill](https://github.com/php-ds/polyfill). 

## Note on Installation

If you are using **nginx**, you will need to restart the PHP Fascgi process by, for example, doing: 

    sudo systemctl restart php7.4-fpm
