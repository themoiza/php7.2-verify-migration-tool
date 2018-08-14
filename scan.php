#!/usr/bin/php -q
<?php

/*{
"VERSION": 1.14,
"AUTHOR": "MOISES DE LIMA",
"UPDATE": "14/08/2018"
}*/

// https://github.com/themoiza/php7.2-verify-migration-tool

$open = '/home/php72tool/php7.2-verify-migration-tool/olphpexamples';

/**
* FIND METHODS WITH SAME NAME OF YOUR CLASS
*/

$parameters = $argv;

include 'Class/Erros.php';

class Scan extends Erros{

	public $colors;

	public $report = array();

	public $parameters = array();

	function __construct($parameters){

		include 'Class/Colors.php';

		$this->parameters = $parameters;

		$this->colors = new Colors;
	}

	protected function  __getLines($str){

		return explode(PHP_EOL, $str);

	}

	// ADD LINE TO ARRAY
	function report($newlog){

		$this->report[] = $newlog;

	}

	// SAVE JSON TO FILE
	function reportsave(){

		$report = json_encode($this->report);

		file_put_contents('report.md', $report);

	}

	function scanphp($open, $count){

		$list = scandir($open);

		$cleanPath = rtrim($open, '/').'/';

		foreach($list as $files){

			if($files != '.' and $files != '..'){

				$currentFile = $cleanPath.$files;

				if(preg_match('/\.php/', $files)){

					// ERRORS
					if(!isset($this->parameters[1]) or ($this->parameters[1] == 'all' or $this->parameters[1] == 'e')){

						$count = $this->auto_load($currentFile, $count);
						$count = $this->classnamemethod($currentFile, $count);
						$count = $this->fn_png2wbmp($currentFile, $count);
						$count = $this->fn_jpeg2wbmp($currentFile, $count);
						$count = $this->fn_each($currentFile, $count);
						$count = $this->fn_create_function($currentFile, $count);
						$count = $this->fn_gmp_random($currentFile, $count);
						$count = $this->fn_read_exif_data($currentFile, $count);

						// NOT PDO FUNCTIONS
						$count = $this->fn_mysql_select_db($currentFile, $count);
						$count = $this->fn_mysql_select_db($currentFile, $count);
						$count = $this->fn_mysql_query($currentFile, $count);
						$count = $this->fn_mysql_num_rows($currentFile, $count);
						$count = $this->fn_mysql_result($currentFile, $count);

					}

					// WARNINGS
					if(isset($this->parameters[1]) and ($this->parameters[1] == 'all' or $this->parameters[1] == 'w')){

						$count = $this->fn_md5($currentFile, $count);
						$count = $this->fn_strip_tags($currentFile, $count);
						$count = $this->fn_endphptag($currentFile, $count);

					}
				}

				// SUBDIR RECURSIVE
				if(is_dir($currentFile)){
					$count = $this->scanphp($currentFile, $count);
				}
			}
		}

		return $count;
	}

	function ending(){

		$all = count($this->report).' errors or warnings';

		print $this->colors->getColoredString('END: ', "white", "blue").' '.$all.PHP_EOL.PHP_EOL;
	}
}

// TOUCH FILE IF NOT EXISTS
$report = 'report.md';
if(!is_file($report)){
	touch($report);
}

$scan = new Scan($parameters);
$count = $scan->scanphp($open, 0);

$scan->reportsave();
$scan->ending();