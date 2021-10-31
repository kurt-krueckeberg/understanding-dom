<?php
use App\File\FileObject;

/*
 Extracts the paragraph text from input-dialog.html and writes each as a single line in 'text.txt'.
 */

require_once "./boot-strap/boot-strap.php";
boot_strap();
 
$dom = new DomDocument();

@$dom->loadHTMLFile("./input-dialog.html");
/*
 * Alternative code:
 * 
$nodes = array();

$xpath = new DOMXPath($dom);

// select THE TEXT NODES of all p elements,
$found = $xpath->query('//p/text()');

$ofile1 = new FileObject("./p1.txt", "w");

foreach($found as $textNode) {

    $new = preg_replace('/(\n)/', ' ', $textNode->nodeValue);

    $ofile1->fwrite($new . "\n");
}
 *
 * 
 */
$paragraphs = $dom->getElementsByTagName('p');
$cnt = 0;

$ofile2 = new FileObject("./text.txt", "w");

foreach ($paragraphs as $p) {

    $text = $p->textContent;

    $new = preg_replace('/(\n)/', ' ', $text);

    //echo $new . "\n";
    $ofile2->fwrite($new . "\n");

    ++$cnt;
}

//echo "First paragraphs count is: ".  $cnt . "\n";
return;
