<?php

/*{
"VERSION": 1.11,
"AUTHOR": "MOISES DE LIMA",
"UPDATE": "24/07/2018"
}*/

include 'Warnings.php';

class Erros extends Warnings{

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

						$string = 'LINE: '.($ct + 1).' - METHODS WITH SAME NAME OF YOUR CLASS IN '.$currentFile;

						print $this->colors->getColoredString($string, "black", "magenta").PHP_EOL;

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

					$string = 'LINE: '.($ct + 1).' - __autoload IS DEPRECATED IN'.$currentFile;

					print $this->colors->getColoredString($string, "black", "magenta").PHP_EOL;
				}
			}
		}

		return $count;
	}

	function fn_png2wbmp($currentFile, $count){

		if(is_file($currentFile)){

			$php = file_get_contents($currentFile);

			$lines = $this->__getLines($php);

			foreach ($lines as $ct => $line){

				preg_match('/[\s\t]+?png2wbmp[\s\t\n]?\(/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;

					$string = 'LINE: '.($ct + 1).' - png2wbmp() IS DEPRECATED IN '.$currentFile;

					print $this->colors->getColoredString($string, "black", "magenta").PHP_EOL;

				}
			}
		}

		return $count;
	}

	function fn_jpeg2wbmp($currentFile, $count){

		if(is_file($currentFile)){

			$php = file_get_contents($currentFile);

			$lines = $this->__getLines($php);

			foreach ($lines as $ct => $line){

				preg_match('/[\s\t]+?jpeg2wbmp[\s\t\n]?\(/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;

					$string = 'LINE: '.($ct + 1).' - jpeg2wbmp() IS DEPRECATED IN '.$currentFile;

					print $this->colors->getColoredString($string, "black", "magenta").PHP_EOL;

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

					$string = 'LINE: '.($ct + 1).' - each() FUNCTION IS DEPRECATED IN '.$currentFile;

					print $this->colors->getColoredString($string, "black", "magenta").PHP_EOL;
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

					$string = 'LINE: '.($ct + 1).' - create_function() FUNCTION IS DEPRECATED IN '.$currentFile;

					print $this->colors->getColoredString($string, "black", "magenta").PHP_EOL;
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

					$string = 'LINE: '.($ct + 1).' - gmp_random() FUNCTION IS DEPRECATED IN '.$currentFile;

					print $this->colors->getColoredString($string, "black", "magenta").PHP_EOL;

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
					$string = 'LINE: '.($ct + 1).' - fn_read_exif_data() FUNCTION IS DEPRECATED IN '.$currentFile;

					print $this->colors->getColoredString($string, "black", "magenta").PHP_EOL;

				}
			}
		}

		return $count;
	}
}