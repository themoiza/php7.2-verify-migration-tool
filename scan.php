#!/usr/bin/php -q
<?php

/*{
"VERSION": 1.11,
"AUTHOR": "MOISES DE LIMA",
"UPDATE": "24/07/2018"
}*/

$open = '/home/gestor';

/**
* FIND METHODS WITH SAME NAME OF YOUR CLASS
*/

include 'Class/Erros.php';

class Scan extends Erros{

	public $colors;

	function __construct(){

		include 'Class/Colors.php';

		$this->colors = new Colors;
	}

	protected function  __getLines($str){

		return explode(PHP_EOL, $str);

	}

	function scanphp($open, $count){

		$list = scandir($open);

		$cleanPath = rtrim($open, '/').'/';

		foreach($list as $files){

			if($files != '.' and $files != '..'){

				$currentFile = $cleanPath.$files;

				if(preg_match('/\.php/', $files)){

					// ERRORS
					$count = $this->auto_load($currentFile, $count);
					$count = $this->classnamemethod($currentFile, $count);
					$count = $this->fn_png2wbmp($currentFile, $count);
					$count = $this->fn_jpeg2wbmp($currentFile, $count);
					$count = $this->fn_each($currentFile, $count);
					$count = $this->fn_create_function($currentFile, $count);
					$count = $this->fn_gmp_random($currentFile, $count);
					$count = $this->fn_read_exif_data($currentFile, $count);

					// WARNINGS
					$count = $this->fn_md5($currentFile, $count);
					$count = $this->fn_strip_tags($currentFile, $count);
				}

				// SUBDIR
				if(is_dir($currentFile)){
					$count = $this->scanphp($currentFile, $count);
				}
			}
		}

		return $count;
	}
}

$report = 'report.md';
if(!is_file($report)){
	touch($report);
}

$scan = new Scan;
$count = $scan->scanphp($open, 0);