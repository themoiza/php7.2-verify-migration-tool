#!/usr/bin/php -q
<?php

/*{
"VERSION": 1.16,
"AUTHOR": "MOISES DE LIMA",
"UPDATE": "05/01/2024"
"GITHUB" : "https://github.com/themoiza/php7.2-verify-migration-tool"
}*/


$open = '/home/php72tool/php7.2-verify-migration-tool/oldphpexamples';

/**
* PARAMETERS PASS BY SHELL
*/
$parameters = $argv;

include 'Class/Erros.php';

class Scan extends Erros{

	public $colors;

	public $reportErrors = array();

	public $reportWarnings = array();

	public $parameters = array();

	function __construct($parameters){

		include 'Class/Colors.php';

		$this->parameters = $parameters;

		$this->colors = new Colors;
	}

	protected function  __getLines($str){

		return explode(PHP_EOL, $str);

	}

	protected function _findParam($param){

		if(is_array($this->parameters) and count($this->parameters) > 0){

			foreach ($this->parameters as $p){
				if(str_replace('"', '', $p) == $param){
					return true;
				}
			}
		}

		return false;
	}

	function findDir(){

		if(is_array($this->parameters) and count($this->parameters) > 0){

			if(isset($this->parameters[1]) and !empty($this->parameters) and preg_match('/\//', $this->parameters[1])){

				$dir = str_replace('"', '', trim($this->parameters[1]));
				$dir = preg_replace('/\/$/', '', $dir);

				return $dir;
			}
		}

		return false;
	}

	// ADD LINE TO ARRAY
	function reportErrors($newlog, $solve, $open){

		$key = count($this->reportErrors);

		$this->reportErrors[$key]['error'] = $newlog;
		$this->reportErrors[$key]['solve'] = $solve;
		$this->reportErrors[$key]['open'] = $open;

	}

	// ADD LINE TO ARRAY
	function reportWarnings($newlog, $solve, $open){

		$key = count($this->reportWarnings);

		$this->reportWarnings[$key]['error'] = $newlog;
		$this->reportWarnings[$key]['solve'] = $solve;
		$this->reportWarnings[$key]['open'] = $open;

	}

	// SAVE JSON TO FILE
	function reportsave(){

		$date = date('Y-m-d H:i:s');

		$report = json_encode(array_merge($this->reportErrors, $this->reportWarnings));

		file_put_contents('report.md', $report);

		$linesErros = '';
		foreach ($this->reportErrors as $arr){

			$linesErros .= <<<lines
				<div class="line">
					<div class="line-left"><span class="error">ERROR</span></div><div class="line-right"><a href="file://{$arr['open']}">{$arr['error']}</a></div>
					<div class="line-left"><span class="fix">HOW TO FIX</span></div><div class="line-right">{$arr['solve']}</div>
				</div>
lines;

		}

		$linesWarnings = '';
		foreach ($this->reportWarnings as $arr){

			$linesWarnings .= <<<lines
		<div class="line">
			<div class="line-left"><span class="warning">WARNING</span></div><div class="line-right"><a href="file://{$arr['open']}">{$arr['error']}</a></div>
			<div class="line-left"><span class="fix">HOW TO FIX</span></div><div class="line-right">{$arr['solve']}</div>
		</div>
lines;

		}

		$html = <<<html
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, height=device-height, user-scalable=no, initial-scale=1, shrink-to-fit=no" />
	<link rel="stylesheet" media="all" type="text/css" href="site.css" />
	<title>SCAN REPORT</title>
</head>
<body>
	<div class="content content_h content_v">		
		<h1>PHP 7.2 Migration tool</h1>
		<p>Report errors in {$date}</p>

		{$linesErros}
		{$linesWarnings}

	</div>
</body>
</html>
html;
		file_put_contents('index.html', $html);

	}

	function scanphp($open, $count){

		$list = scandir($open);

		$cleanPath = rtrim($open, '/').'/';

		foreach($list as $files){

			if($files != '.' and $files != '..'){

				$currentFile = $cleanPath.$files;

				if(preg_match('/\.php/', $files)){

					// ERRORS
					if($this->_findParam('all') === true or ($this->_findParam('dir') === false and $this->_findParam('w') === false)){

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
					if($this->_findParam('all') === true or $this->_findParam('w') === true){

						$count = $this->fn_md5($currentFile, $count);
						$count = $this->fn_strip_tags($currentFile, $count);
						$count = $this->fn_endphptag($currentFile, $count);
						$count = $this->fn_mb_strings($currentFile, $count);

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

		$all = count($this->reportErrors).' errors, '.count($this->reportWarnings).' warnings';

		print $this->colors->getColoredString('END: ', "white", "blue").' '.$all.PHP_EOL.PHP_EOL;
	}
}

// TOUCH FILE IF NOT EXISTS
$reportFile = 'report.md';
if(!is_file($reportFile)){
	touch($reportFile);
}

// TOUCH FILE IF NOT EXISTS
$htmlFile = 'index.html';
if(!is_file($htmlFile)){
	touch($htmlFile);
}

$scan = new Scan($parameters);

$findDir = $scan->findDir();
if($findDir !== false){
	$open = $findDir;
}

$count = $scan->scanphp($open, 0);

$scan->reportsave();
$scan->ending();