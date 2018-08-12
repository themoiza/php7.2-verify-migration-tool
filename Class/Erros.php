<?php

/*{
"VERSION": 1.13,
"AUTHOR": "MOISES DE LIMA",
"UPDATE": "12/08/2018"
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

						$this->report($string);

						$howtosolve = 'Rename your class name ou funcion name to fix it.';

						print $this->colors->getColoredString('ERROR', 'white', 'red').' '.$string.PHP_EOL;
						print $this->colors->getColoredString('HOW TO FIX: ', "white", "blue").' '.$howtosolve.PHP_EOL.PHP_EOL;

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

					$string = 'LINE: '.($ct + 1).' - __autoload IS DEPRECATED IN '.$currentFile;

					$this->report($string);

					$howtosolve = 'You can use spl_autoload_register() to fix it.';

					print $this->colors->getColoredString('ERROR', 'white', 'red').' '.$string.PHP_EOL;
					print $this->colors->getColoredString('HOW TO FIX: ', "white", "blue").' '.$howtosolve.PHP_EOL.PHP_EOL;

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

					$howtosolve = 'You can use foreach() to fix it.';

					$this->report($string);

					$howtosolve = 'I don\'t know.';

					print $this->colors->getColoredString('ERROR', 'white', 'red').' '.$string.PHP_EOL;
					print $this->colors->getColoredString('HOW TO FIX: ', "white", "blue").' '.$howtosolve.PHP_EOL.PHP_EOL;

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

				preg_match('/png2wbmp[\s\t\n]?\(/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;

					$string = 'LINE: '.($ct + 1).' - png2wbmp() IS DEPRECATED IN '.$currentFile;

					$this->report($string);

					$howtosolve = 'I don\'t know.';

					print $this->colors->getColoredString('ERROR', 'white', 'red').' '.$string.PHP_EOL;
					print $this->colors->getColoredString('HOW TO FIX: ', "white", "blue").' '.$howtosolve.PHP_EOL.PHP_EOL;

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

				preg_match('/jpeg2wbmp[\s\t\n]?\(/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;

					$string = 'LINE: '.($ct + 1).' - jpeg2wbmp() IS DEPRECATED IN '.$currentFile;

					$this->report($string);

					$howtosolve = 'I don\'t know.';

					print $this->colors->getColoredString('ERROR', 'white', 'red').' '.$string.PHP_EOL;
					print $this->colors->getColoredString('HOW TO FIX: ', "white", "blue").' '.$howtosolve.PHP_EOL.PHP_EOL;

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

				preg_match('/create_function[\s\t\n]?\(/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;

					$string = 'LINE: '.($ct + 1).' - create_function() FUNCTION IS DEPRECATED IN '.$currentFile;

					$this->report($string);

					$howtosolve = 'I don\'t know.';

					print $this->colors->getColoredString('ERROR', 'white', 'red').' '.$string.PHP_EOL;
					print $this->colors->getColoredString('HOW TO FIX: ', "white", "blue").' '.$howtosolve.PHP_EOL.PHP_EOL;
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

				preg_match('/fn_gmp_random[\s\t\n]?\(/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;

					$string = 'LINE: '.($ct + 1).' - gmp_random() FUNCTION IS DEPRECATED IN '.$currentFile;

					$this->report($string);

					$howtosolve = 'I don\'t know.';

					print $this->colors->getColoredString('ERROR', 'white', 'red').' '.$string.PHP_EOL;
					print $this->colors->getColoredString('HOW TO FIX: ', "white", "blue").' '.$howtosolve.PHP_EOL.PHP_EOL;

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

				preg_match('/read_exif_data[\s\t\n]?\(/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;
					$string = 'LINE: '.($ct + 1).' - read_exif_data() FUNCTION IS DEPRECATED IN '.$currentFile;

					$this->report($string);

					$howtosolve = 'I don\'t know.';

					print $this->colors->getColoredString('ERROR', 'white', 'red').' '.$string.PHP_EOL;
					print $this->colors->getColoredString('HOW TO FIX: ', "white", "blue").' '.$howtosolve.PHP_EOL.PHP_EOL;

				}
			}
		}

		return $count;
	}

	function fn_mysql_select_db($currentFile, $count){

		if(is_file($currentFile)){

			$php = file_get_contents($currentFile);

			$lines = $this->__getLines($php);

			foreach ($lines as $ct => $line){

				preg_match('/mysql_select_db[\s\t\n]?\(/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;
					$string = 'LINE: '.($ct + 1).' - mysql_select_db() FUNCTION IS DEPRECATED IN '.$currentFile;

					$this->report($string);

					$howtosolve = 'Change to PDO';

					print $this->colors->getColoredString('ERROR', 'white', 'red').' '.$string.PHP_EOL;
					print $this->colors->getColoredString('HOW TO FIX: ', "white", "blue").' '.$howtosolve.PHP_EOL.PHP_EOL;

				}
			}
		}

		return $count;
	}

	function fn_mysql_connect($currentFile, $count){

		if(is_file($currentFile)){

			$php = file_get_contents($currentFile);

			$lines = $this->__getLines($php);

			foreach ($lines as $ct => $line){

				preg_match('/mysql_connect[\s\t\n]?\(/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;
					$string = 'LINE: '.($ct + 1).' - mysql_connect() FUNCTION IS DEPRECATED IN '.$currentFile;

					$this->report($string);

					$howtosolve = 'Change to PDO';

					print $this->colors->getColoredString('ERROR', 'white', 'red').' '.$string.PHP_EOL;
					print $this->colors->getColoredString('HOW TO FIX: ', "white", "blue").' '.$howtosolve.PHP_EOL.PHP_EOL;

				}
			}
		}

		return $count;
	}

	function fn_mysql_query($currentFile, $count){

		if(is_file($currentFile)){

			$php = file_get_contents($currentFile);

			$lines = $this->__getLines($php);

			foreach ($lines as $ct => $line){

				preg_match('/mysql_query[\s\t\n]?\(/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;
					$string = 'LINE: '.($ct + 1).' - mysql_query() FUNCTION IS DEPRECATED IN '.$currentFile;

					$this->report($string);

					$howtosolve = 'Change to PDO';

					print $this->colors->getColoredString('ERROR', 'white', 'red').' '.$string.PHP_EOL;
					print $this->colors->getColoredString('HOW TO FIX: ', "white", "blue").' '.$howtosolve.PHP_EOL.PHP_EOL;

				}
			}
		}

		return $count;
	}

	function fn_mysql_num_rows($currentFile, $count){

		if(is_file($currentFile)){

			$php = file_get_contents($currentFile);

			$lines = $this->__getLines($php);

			foreach ($lines as $ct => $line){

				preg_match('/mysql_num_rows[\s\t\n]?\(/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;
					$string = 'LINE: '.($ct + 1).' - mysql_num_rows() FUNCTION IS DEPRECATED IN '.$currentFile;

					$this->report($string);

					$howtosolve = 'Change to PDO';

					print $this->colors->getColoredString('ERROR', 'white', 'red').' '.$string.PHP_EOL;
					print $this->colors->getColoredString('HOW TO FIX: ', "white", "blue").' '.$howtosolve.PHP_EOL.PHP_EOL;

				}
			}
		}

		return $count;
	}

	function fn_mysql_result($currentFile, $count){

		if(is_file($currentFile)){

			$php = file_get_contents($currentFile);

			$lines = $this->__getLines($php);

			foreach ($lines as $ct => $line){

				preg_match('/mysql_result[\s\t\n]?\(/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;
					$string = 'LINE: '.($ct + 1).' - mysql_result() FUNCTION IS DEPRECATED IN '.$currentFile;

					$this->report($string);

					$howtosolve = 'Change to PDO';

					print $this->colors->getColoredString('ERROR', 'white', 'red').' '.$string.PHP_EOL;
					print $this->colors->getColoredString('HOW TO FIX: ', "white", "blue").' '.$howtosolve.PHP_EOL.PHP_EOL;

				}
			}
		}

		return $count;
	}
}