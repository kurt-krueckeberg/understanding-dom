# DOM Introduction

The Document Object Model (DOM) API began as object model of HTML documents and documents represented by XML files. The API allowed you to temporarily manipulate the
HTML or XML document in memory, adding, deleting or altering elements of the document and thereby what the user sees, for example, on a web page. It also supports query features, allowing you to locate and return a particular document element or elements.

While the Document Object Model (DOM) API began as an in-memory object model of HTML documents and documents represented by XML documents, the latest standard has
been extended to support other document types.

DOM interfaces are defined in programming language-independent manner using the Object Management Group's Interface Description Lnaguage (IDL). All doument objects 
implement the DOM `NodeInterface`. 

A document is represented as a node tree whose root is the sole `Document` object. The `Document` object contains a `documentElement` property that is an
`Element` node, which may be null. The `documentElement` in turn may contain child nodes (or it may be null). These in turn may contain other child nodes. Some tree
nodes are always leave nodes that never can have children.

Using the DOM interfaces node contents can be altered, the node tree traversed,  elements queried for location or existence, the parent-child aggregation relationships
between nodes altered (with nodes being added, deleted or inserted).
        
## DOM Interfaces

This is a summary of the DOM node tree objects:

* Objects that implement `Node` also implement an inherited interface: either `Document`, `DocumentType`, `DocumentFragment`, `Element`, `CharacterData`, or `Attr`.

* Objects that implement `Element` also typically implement an inherited interface, such as HTMLAnchor`Element`.

* Objects that implement `CharacterData` also implement an inherited interface: either `Text`, `ProcessingInstruction`, or `Comment`.

* Objects that implement `Text` sometimes implement `CDATASection`.

##  Node and NodeList Interfaces

todo.

## HTML DOM Links

* [DOM Living Standard](https://dom.spec.whatwg.org/#introduction-to-the-dom)
* [DOM Explanation](https://www.w3schools.com/whatis/whatis_htmldom.asp)
* [DOM Interfaces](https://www.brainbell.com/tutorials/XML/DOM_Interfaces.htm)

## DOM XPath
* [XPath Cheatsheet](https://devhints.io/xpath)
* [Most Exhaustive XPath Locators Cheat Sheet](https://www.lambdatest.com/blog/most-exhaustive-xpath-locators-cheat-sheet/)

Developer links:

* [Univ of Iowa](https://homepage.cs.uiowa.edu/~slonnegr/xml/03.DOM.pdf)

PHP Links:

* [PHP DOM Classes Overview](https://www.php.net/manual/en/book.dom.php)
* [DOM Parsing](https://www.tutorialspoint.com/php/php_dom_parser_example.htm)
* [Dynamically Create DOM](https://css-tricks.com/building-a-form-in-php-using-domdocument/)
* [XPath](https://www.sitepoint.com/php-dom-using-xpath/)

References:
* [Chrome Developer the DOM](https://developer.chrome.com/docs/devtools/dom/)
* [Mozilla Developer](https://developer.mozilla.org/en-US/docs/Web/API/Document_Object_Model)

## PHP DOM Classes and Interfaces

PHP DOM clases and interfaces UML [diagrams](php-dom-diagrams.md).

## PHP DOMDocument and DOMXPath API

* [How to Parse HTML using PHP Native Classes](https://codingreflections.com/blog/php-parse-html)
* [Using PHP DOMDocument: Code Examples Explained](https://www.bitdegree.org/learn/php-domdocument)
