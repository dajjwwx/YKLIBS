<?php

class CommonLoader {

	static function load($classname) {

		$dirs = array('API','API/books','Helper','Models','Util','Libaray/Zend','Helper/Search/Analyzer');

		foreach($dirs as $dir){
			
			$directories = explode('_', $classname);
			
			$filename = array_pop($directories);//获取类文件名
			
			$filepath = $filename.'.php';
			
			if (is_array($directories) && (count($directories)>0)){
				
				$dirpath = '';
				
				foreach ($directories as $direcotry){
					if ($direcotry){
						$dirpath .= $direcotry.'/';
					}
					
				}
				
				$filepath = $dirpath.$filename.'.php';
				
			}

			$filepath =dirname(__FILE__).'/'.$dir.'/'.$filepath;

			if(is_file($filepath)){
// 				echo $filepath;
				return require_once $filepath;
			}

		}
	}

}
spl_autoload_register(array('CommonLoader','load'));

?>