#!/usr/bin/php -q
<?php

/*{
"VERSION": 1.10,
"AUTHOR": "MOISES DE LIMA",
"UPDATE": "17/06/2018"
}*/

$open = '/home/yourproject';

/**
* FIND METHODS WITH SAME NAME OF YOUR CLASS
*/

class Scan{

	private function  __getLines($str){

		return explode(PHP_EOL, $str);

	}

	function classnamemethod($currentFile, $count){

		if(is_file($currentFile)){

			$php = file_get_contents($currentFile);

			$lines = $this->__getLines($php);

			foreach ($lines as $ct => $line){

				preg_match('/class[\s]([a-zA-Z0-9_]+)[\{\s]?/', $line, $preg);

				if(isset($preg[1])){

					preg_match('/function[\s]('.$preg[1].')[\{\s\(]+?/i', $line, $preg);

					if(isset($preg[1])){

						$count = $count + 1;

						print 'LINE: '.($ct + 1).' - METHODS WITH SAME NAME OF YOUR CLASS IN '.$currentFile.PHP_EOL;
					}
				}
			}
		}

		return $count;
	}

	function auto_load($currentFile, $count){

		if(is_file($currentFile)){

			$php = file_get_contents($currentFile);

			$lines = $this->__getLines($php);

			foreach ($lines as $ct => $line){

				preg_match('/__autoload/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;

					print 'LINE: '.($ct + 1).' - __autoload IS DEPRECATED IN '.$currentFile.PHP_EOL;
				}
			}
		}

		return $count;
	}

	function fn_each($currentFile, $count){

		if(is_file($currentFile)){

			$php = file_get_contents($currentFile);

			$lines = $this->__getLines($php);

			foreach ($lines as $ct => $line){

				preg_match('/[\n\s\t]+?each[\s\t\n]?\(/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;

					print 'LINE: '.($ct + 1).' - each() FUNCTION IS DEPRECATED IN '.$currentFile.PHP_EOL;
				}
			}
		}

		return $count;
	}

	function fn_create_function($currentFile, $count){

		if(is_file($currentFile)){

			$php = file_get_contents($currentFile);

			$lines = $this->__getLines($php);

			foreach ($lines as $ct => $line){

				preg_match('/[\s\t]+?create_function[\s\t\n]?\(/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;

					print 'LINE: '.($ct + 1).' - create_function() FUNCTION IS DEPRECATED IN '.$currentFile.PHP_EOL;
				}
			}
		}

		return $count;
	}

	function fn_gmp_random($currentFile, $count){

		if(is_file($currentFile)){

			$php = file_get_contents($currentFile);

			$lines = $this->__getLines($php);

			foreach ($lines as $ct => $line){

				preg_match('/[\s\t]+?create_function[\s\t\n]?\(/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;

					print 'LINE: '.($ct + 1).' - gmp_random() FUNCTION IS DEPRECATED IN '.$currentFile.PHP_EOL;
				}
			}
		}

		return $count;
	}

	function fn_read_exif_data($currentFile, $count){

		if(is_file($currentFile)){

			$php = file_get_contents($currentFile);

			$lines = $this->__getLines($php);

			foreach ($lines as $ct => $line){

				preg_match('/[\s\t]+?read_exif_data[\s\t\n]?\(/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;

					print 'LINE: '.($ct + 1).' - fn_read_exif_data() FUNCTION IS DEPRECATED IN '.$currentFile.PHP_EOL;
				}
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

					$count = $this->auto_load($currentFile, $count);
					$count = $this->classnamemethod($currentFile, $count);
					$count = $this->fn_each($currentFile, $count);
					$count = $this->fn_create_function($currentFile, $count);
					$count = $this->fn_gmp_random($currentFile, $count);
					$count = $this->fn_read_exif_data($currentFile, $count);
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