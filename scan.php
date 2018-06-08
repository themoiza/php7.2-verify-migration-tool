#!/usr/bin/php -q
<?php

/*{
"VERSAO": 1.00,
"AUTHOR": "MOISES DE LIMA",
"UPDATE": "08/06/2018"
}*/

$count = 0;

$open = '/home/myproject';

/**
* FIND METHODS WITH SAME NAME OF OWN CLASS 
*/
function classnamemethod($currentFile){

	if(is_file($currentFile)){

		$php = file_get_contents($currentFile);

		preg_match('/class[\s]([a-zA-Z0-9_]+)[\{\s]?/', $php, $preg);

		if(isset($preg[1])){

			preg_match('/function[\s]('.$preg[1].')[\{\s\(]+?/i', $php, $preg);

			if(isset($preg[1])){
				print $currentFile.PHP_EOL;
			}
		}
	}
}

function scanphp($open, $count){

	$list = scandir($open);

	$cleanPath = rtrim($open, '/').'/';

	foreach($list as $files){

		if($files != '.' and $files != '..'){

			$currentFile = $cleanPath.$files;

			if(preg_match('/\.php/', $files)){

				$count = $count + 1;
				classnamemethod($currentFile);
			}

			// SUBDIR
			if(is_dir($currentFile)){
				$count = scanphp($currentFile, $count);
			}
		}
	}

	return $count;
}

$count = scanphp($open, $count);