<?php

/*{
"VERSION": 1.14,
"AUTHOR": "MOISES DE LIMA",
"UPDATE": "15/08/2018"
}*/

class Warnings{

	function fn_md5($currentFile, $count){

		if(is_file($currentFile)){

			$php = file_get_contents($currentFile);

			$lines = $this->__getLines($php);

			foreach ($lines as $ct => $line){

				preg_match('/[\s\t]+?md5[\s\t\n]?\(/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;

					$string = 'LINE: '.($ct + 1).' - md5() FUNCTION CAN BE DEPRECATED IN 7.3 OR 8'.$currentFile;

					$howtosolve = 'Follow the news of PHP.';

					$this->reportWarnings($string, $howtosolve, $currentFile);

					if($this->_findParam('q') === false){

						print $this->colors->getColoredString('WARNING', 'black', 'yellow').' '.$string.PHP_EOL;
						print $this->colors->getColoredString('HOW TO FIX: ', "white", "blue").' '.$howtosolve.PHP_EOL.PHP_EOL;

					}
				}
			}
		}

		return $count;
	}

	function fn_strip_tags($currentFile, $count){

		if(is_file($currentFile)){

			$php = file_get_contents($currentFile);

			$lines = $this->__getLines($php);

			foreach ($lines as $ct => $line){

				preg_match('/strip_tags[\s\t\n]?\(/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;

					$string = 'LINE: '.($ct + 1).' - strip_tags() FUNCTION CAN BE DEPRECATED IN 7.3 OR 8'.$currentFile;

					$howtosolve = 'Follow the news of PHP.';

					$this->reportWarnings($string, $howtosolve, $currentFile);

					if($this->_findParam('q') === false){

						print $this->colors->getColoredString('WARNING', 'black', 'yellow').' '.$string.PHP_EOL;
						print $this->colors->getColoredString('HOW TO FIX: ', "white", "blue").' '.$howtosolve.PHP_EOL.PHP_EOL;

					}
				}
			}
		}

		return $count;
	}

	function fn_endphptag($currentFile, $count){

		if(is_file($currentFile)){

			$php = file_get_contents($currentFile);

			$lines = $this->__getLines($php);

			foreach ($lines as $ct => $line){

				preg_match('/\?>/', $line, $preg);

				if(!empty($preg)){

					$count = $count + 1;

					$string = 'LINE: '.($ct + 1).' - DO NOT END YOUR PHP 7.2 WITH ?> TAG '.$currentFile;

					$howtosolve = 'Stop merge html into PHP.';

					$this->reportWarnings($string, $howtosolve, $currentFile);

					if($this->_findParam('q') === false){

						print $this->colors->getColoredString('WARNING', 'black', 'yellow').' '.$string.PHP_EOL;
						print $this->colors->getColoredString('HOW TO FIX: ', "white", "blue").' '.$howtosolve.PHP_EOL.PHP_EOL;

					}
				}
			}
		}

		return $count;
	}
}