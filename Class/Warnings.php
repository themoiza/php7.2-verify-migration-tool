<?php

/*{
"VERSION": 1.12,
"AUTHOR": "MOISES DE LIMA",
"UPDATE": "11/08/2018"
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

					$this->report($string);

					print $this->colors->getColoredString($string, "black", "yellow").PHP_EOL;

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

					$this->report($string);

					print $this->colors->getColoredString($string, "black", "yellow").PHP_EOL;

				}
			}
		}

		return $count;
	}
}