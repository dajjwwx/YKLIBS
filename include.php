<?php
class CommonLoader{

	public $basedir  = null;

	public $includeDirs = array(
//			'Models',
//			'Libaray',
//			'Libaray/Util',
//			'Libaray/api',
//			'Libaray/Zend',
//			'Libaray/search/phpanalysis',
//			'Libaray/pear',
//			'Libaray/pear/Flickr',
//			'Libaray/pear/Http',
//			'Libaray/pear/Http/Request',
//			'Libaray/pear/Net',
//			'Libaray/pear/XML',
//			'Libaray/pear/XML/Tree',
			'API',
			'Tools',
			'Helper',
			'Libaray\\Zend',
			'Models',
			'Util'
	);
	
    public function __construct($basedir){
        $this->basedir = $basedir;
    }
    
	public function setBaseDir($dir){
		$this->basedir = $dir;
	}
	
	public function importDir($dir)
	{
	//	return dirname(dirname(__FILE__)).'/yuekegu-common/'.$dir;
		return $this->basedir.'/../Common/'.$dir;
	}
	
	public function import(){

		$includeDirs = array_map(array('CommonLoader','importDir'),$this->includeDirs);		
        
		
		set_include_path(get_include_path().PATH_SEPARATOR.implode(':', $includeDirs));	
	}
}




//class CommonLoader{
//
//	public $basedir  = null;
//
//	public $includeDirs = array(
//								'API',
//								'Tools',
//								'Helper',
//								'Libaray\\Zend',
//								'Models',
//								'Util'
//							);
//
//    public function __construct($basedir){
//        $this->basedir = $basedir;
//    }
//
//	public function setBaseDir($dir){
//		$this->basedir = $dir;
//	}
//
//	public function load($classname) {
//
//		$includeDirs = array_map(array('CommonLoader','importDir'),$this->includeDirs);
//		
//		foreach($includeDirs as $path){
//			$filename = $path.$classname.'.php';
//			
////			echo $filename;
//
//			if(is_file($filename))
//			{
////				echo $filename;
//				return require_once $filename;
//			}
//		}
//	}
//
//	public function importDir($dir)
//	{
//	//	return dirname(dirname(__FILE__)).'/Common/'.$dir;
//		return $this->basedir.'\\Common\\'.$dir;
//	}
//
//	public function import(){
//		$includeDirs = array_map(array('CommonLoader','importDir'),$this->includeDirs);	
//		
//		set_include_path(get_include_path().PATH_SEPARATOR.implode(';', $includeDirs));
//	}
//}

?>