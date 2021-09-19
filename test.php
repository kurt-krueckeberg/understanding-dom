<?php

require_once "util.php";

/*
 * Requires: 
 * 
 * 1. $regex - The file name must match the regular expression. Note %regex must include delimeters and flags; for example
 *
 *     '/\.html$/i'
 *
 * 2. $func_object must be a class that implements __invoke()
 * 
 */
 
transform_files('/\.html/i', new \NullFunctionObject());
