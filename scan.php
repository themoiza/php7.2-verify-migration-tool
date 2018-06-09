#!/usr/bin/php -q
<?php

/*{
"VERSION": 1.00,
"AUTHOR": "MOISES DE LIMA",
"UPDATE": "08/06/2018"
}*/

$count = 0;

$open = '/home/gestor';

/**
* FIND METHODS WITH SAME NAME OF YOUR CLASS 
*/
function classnamemethod($currentFile, $count){

	if(is_file($currentFile)){

		$php = file_get_contents($currentFile);

		preg_match('/class[\s]([a-zA-Z0-9_]+)[\{\s]?/', $php, $preg);

		if(isset($preg[1])){

			preg_match('/function[\s]('.$preg[1].')[\{\s\(]+?/i', $php, $preg);

			if(isset($preg[1])){
				$count = $count + 1;
				print $count.' - METHODS WITH SAME NAME OF YOUR CLASS :'.$currentFile.PHP_EOL;
			}
		}
	}

	return $count;
}

function auto_load($currentFile, $count){

	if(is_file($currentFile)){

		$php = file_get_contents($currentFile);

		preg_match('/__autoload/', $php, $preg);

		if(!empty($preg)){
			$count = $count + 1;
			print $count.' - __autoload IS DEPRECATED :'.$currentFile.PHP_EOL;
		}
	}

	return $count;
}

function fn_each($currentFile, $count){

	if(is_file($currentFile)){

		$php = file_get_contents($currentFile);

		preg_match('/[\n\s\t]+?each[\s\t\n]?\(/', $php, $preg);

		if(!empty($preg)){
			$count = $count + 1;
			print $count.' - each() FUNCTION IS DEPRECATED :'.$currentFile.PHP_EOL;
		}
	}

	return $count;
}

function fn_create_function($currentFile, $count){

	if(is_file($currentFile)){

		$php = file_get_contents($currentFile);

		preg_match('/[\s\t]+?create_function[\s\t\n]?\(/', $php, $preg);

		if(!empty($preg)){
			$count = $count + 1;
			print $count.' - create_function() FUNCTION IS DEPRECATED :'.$currentFile.PHP_EOL;
		}
	}

	return $count;
}

function fn_gmp_random($currentFile, $count){

	if(is_file($currentFile)){

		$php = file_get_contents($currentFile);

		preg_match('/[\s\t]+?create_function[\s\t\n]?\(/', $php, $preg);

		if(!empty($preg)){
			$count = $count + 1;
			print $count.' - gmp_random() FUNCTION IS DEPRECATED :'.$currentFile.PHP_EOL;
		}
	}

	return $count;
}

function fn_read_exif_data($currentFile, $count){

	if(is_file($currentFile)){

		$php = file_get_contents($currentFile);

		preg_match('/[\s\t]+?read_exif_data[\s\t\n]?\(/', $php, $preg);

		if(!empty($preg)){
			$count = $count + 1;
			print $count.' - fn_read_exif_data() FUNCTION IS DEPRECATED :'.$currentFile.PHP_EOL;
		}
	}

	return $count;
}

function scanphp($open, $count){

	$list = scandir($open);

	$cleanPath = rtrim($open, '/').'/';

	foreach($list as $files){

		if($files != '.' and $files != '..'){

			$currentFile = $cleanPath.$files;

			if(preg_match('/\.php/', $files)){

				$count = classnamemethod($currentFile, $count);
				$count = auto_load($currentFile, $count);
				$count = fn_each($currentFile, $count);
				$count = fn_create_function($currentFile, $count);
				$count = fn_gmp_random($currentFile, $count);
				$count = fn_read_exif_data($currentFile, $count);
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