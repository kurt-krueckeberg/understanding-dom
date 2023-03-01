# DOM Introduction

The Document Object Model (DOM) API began as object model of HTML documents and documents represented by XML files. The API allows one to
temporarily manipulate the HTML or XML document in memory, adding, deleting or altering the document and thereby what the user sees. Using the DOM API you can
traverse the tree of the document, and it also supports query features: allowing you to locate and return at particular document element or elements. 

While the Document Object Model (DOM) API began as an in-memory object model of HTML documents and documents represented by XML documents used to
temporarily manipulate the HTML or XML, the latest standard has been extending to other document types.

DOM interfaces are defined in programming language-independent manner using Object Management Group's Interface Description Lnaguage (IDL). All
doument objects implement the DOM `NodeInterface`. A node tree represents the entire in-memory document. The root of the tree has the sole Document object, which
contains zero or more Element nodes, which in turn may contain oother nodes. Some nodes are always leave nodes that never can have children.

Using the DOM interfaces the node tree can be quered, traversed and its parent-child aggregation relationships altered.

## DOM Interfaces

This is a summary of some of the more specific DOM objects:

* Objects that implement Node also implement an inherited interface: Document, DocumentType, DocumentFragment, Element, CharacterData, or Attr.

* Objects that implement Element also typically implement an inherited interface, such as HTMLAnchorElement.

* Objects that implement CharacterData also implement an inherited interface: Text, ProcessingInstruction, or Comment.

* Objects that implement Text sometimes implement CDATASection.

## HTML DOM Links

Spec: <https://dom.spec.whatwg.org/#introduction-to-the-dom>

Developer links:

* [Mozilla Developer](https://developer.mozilla.org/en-US/docs/Web/API/Document_Object_Model)
* [Chrome Developer the DOM](https://developer.chrome.com/docs/devtools/dom/)
* [W3Schools What is Html DOM](https://www.w3schools.com/whatis/whatis_htmldom.asp)

## PHP DOM Classes and Interfaces

### Base Classes and Interface

![](/assets/images/base.png)

### DOMNodeList

![](/assets/images/nodelist.png)

### DOMNode 

![](/assets/images/node.png)

### DOMAttr and DOMEntry

![](/assets/images/attr-entry.png)
 
### DOMElement

![](/assets/images/element.png)
 
### DOMDocument

![](/assets/images/document.png)

### DOMDocumentFragment

![](/assets/images/docfragment.png)

## PHP DOMDocument and DOMXPath API

* [How to Parse HTML using PHP Native Classes](https://codingreflections.com/blog/php-parse-html)
* [Using PHP DOMDocument: Code Examples Explained](https://www.bitdegree.org/learn/php-domdocument)
