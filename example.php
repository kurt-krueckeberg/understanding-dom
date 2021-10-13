<?php
declare(strict_types = 1);

use App\File\FileObject;

require_once "./boot-strap/boot-strap.php";

error_reporting(E_ALL ^ E_WARNING);  

$file = new FileObject("filename", "r");
