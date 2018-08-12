<?php

__autoload($file){

	$file = str_replace('_', '/', $file).'.php';

	$file = str_replace('\\', '/', $file);

	require_once $file;
	
}