<?php

$two_cols_header = <<<TWOCOLSSTART
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title></title>
	<meta name="generator" content="LibreOffice 7.1.6.2 (Linux)"/>
	<meta name="created" content="00:00:00"/>
	<meta name="changed" content="2021-08-15T18:53:02.053049428"/>
<style>
#container {
   display: grid; 
   grid-template-columns: 40% 40%; 
   padding-left: 2em;
}

p { 
  padding-top: 3px;
  padding-bottom: 3px;
  padding-right: 6px;
  margin: 0px;
}

p.new-speaker {
  font-weight: 600;
  /*font-style: italic;*/
}

body {
  font-family: 'Lato Medium', Arial, sans-serif;
  margin-left: 3em;
 /*
  background-color: #333;
  color: #f2f2f2;
 */
  background-color: #171421
  color: #D0CFCC;
}
</style>
</head>
<body>
<div id="container">
TWOCOLSSTART;

$one_col_header = <<<ONECOLSTART
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title></title>
	<meta name="generator" content="LibreOffice 7.1.6.2 (Linux)"/>
	<meta name="created" content="00:00:00"/>
	<meta name="changed" content="2021-08-15T18:53:02.053049428"/>
<style>
body {
  font-family: 'Lato Medium', Arial, sans-serif;
  margin-left: 2em;
}

#container {
}

p { 
  padding-top: 3px;
  padding-bottom: 3px;
  padding-right: 6px;
  margin: 0px;
}

p.new-speaker {
  font-weight: 600;
  font-style: italic;
}
body {

  font-family: 'Lato Medium', Arial, sans-serif;
  margin-left: 3em;
 /*
  background-color: #333;
  color: #f2f2f2;
 */
  background-color: #171421
  color: #D0CFCC;
}
</style>
</head>
<body>
<div id="grid-col">

ONECOLSTART;

$footer = <<<END
</div>
</body>
</html>
END;
