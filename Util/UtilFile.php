<?php
/**
* 操纵文件类
* 
* 例子：
* UtilFile::createDir('a/1/2/3');                    测试建立文件夹 建一个a/1/2/3文件夹
* UtilFile::createFile('b/1/2/3');                    测试建立文件        在b/1/2/文件夹下面建一个3文件
* UtilFile::createFile('b/1/2/3.exe');             测试建立文件        在b/1/2/文件夹下面建一个3.exe文件
* UtilFile::copyDir('b','d/e');                    测试复制文件夹 建立一个d/e文件夹，把b文件夹下的内容复制进去
* UtilFile::copyFile('b/1/2/3.exe','b/b/3.exe'); 测试复制文件        建立一个b/b文件夹，并把b/1/2文件夹中的3.exe文件复制进去
* UtilFile::moveDir('a/','b/c');                    测试移动文件夹 建立一个b/c文件夹,并把a文件夹下的内容移动进去，并删除a文件夹
* UtilFile::moveFile('b/1/2/3.exe','b/d/3.exe'); 测试移动文件        建立一个b/d文件夹，并把b/1/2中的3.exe移动进去                   
* UtilFile::unlinkFile('b/d/3.exe');             测试删除文件        删除b/d/3.exe文件
* UtilFile::unlinkDir('d');                      测试删除文件夹 删除d文件夹
*/
class UtilFile {
	
	
	public static function previewDir($dir)
	{
		$basepath = $_SERVER['DOCUMENT_ROOT'];
		
		if(strpos(strrev($dir), strrev($basepath)))
		{
			$dirs = explode('/', $dir);		
			array_pop($dirs);		
			return implode('/', $dirs);
		}
		else 
		{
			return $basepath;
		}
		
// 		echo strstr($dir, $basepath);
		

		
	}
	
	/**
	 * ************************************************************************
	 * 以图标形式返回文件名
	 * ************************************************************************
	 * @param unknown $file
	 * @return string
	 */
	public static function showFileIco($file)
	{
		if ($file['type'] == 'folder') {
			$filename = '/public/image/dir.png';
		}elseif ($file['type'] == 'file'){
			$ext = pathinfo($file['path'],PATHINFO_EXTENSION);
			
			$filename = '/public/image/'.$ext.'.png';
			
// 			echo $filename;
			
			if (!file_exists('.'.$filename)) {
				$filename = '/public/image/file.png';				
			}			
		}
		return CHtml::image($filename,$file['filename'],array('style'=>'width:18px;')).'  '.CHtml::link($file['filename'],'?dir='.$file['path']);
	}
	
	/**
	 * ***********************************************************************
	 * 显示$aimDir下的所有文件及文件夹
	 * *************************************************************************
	 * @param string $aimDir
	 * @return multitype:
	 */
	public static function showFiles($aimDir)
	{
		$files = $left = $right = array();
		
		$dirHandle = opendir($aimDir);
		
		while(false !== ($file = readdir($dirHandle))) {
			if ($file == '.' || $file == '..') {
				continue;
			}			
			
			$path = $aimDir.'/'.$file;				
			
			if (is_dir($path)) {
				$left[]=array('type'=>'folder','filename'=>$file,'path'=>$path,'filesize'=>UtilHelper::formatSize(UtilHelper::getDirectorySize($path)['size']));
			}elseif (is_file($path)){
				$right[]=array('type'=>'file', 'filename'=>$file,'path'=>$path,'filectime'=>filectime($path),'filesize'=>UtilHelper::formatSize(filesize($path)));
			}	

			unset($path);
		}
		
		krsort($left);
		krsort($right);
		
		$files = array_merge($left,$right);
		
		return $files;
	}
	
	function my_sort($a, $b)
	{
		if ($a == $b) return 0;
		return ($a > $b) ? -1 : 1;
	}
    /**
    * 建立文件夹
    *
    * @param string $aimUrl
    * @return viod
    */
    public static function createDir($aimUrl) {
           $aimUrl = str_replace('', '/', $aimUrl);
           $aimDir = '';
           $arr = explode('/', $aimUrl);
           foreach ($arr as $str) {
             $aimDir .= $str . '/';
             if (!file_exists($aimDir)) {
                mkdir($aimDir);
             }
           }
    }
    /**
    * 建立文件
    *
    * @param string $aimUrl 
    * @param boolean $overWrite 该参数控制是否覆盖原文件
    * @return boolean
    */
    public static function createFile($aimUrl, $overWrite = false) {
           if (file_exists($aimUrl) && $overWrite == false) {
             return false;
           } elseif (file_exists($aimUrl) && $overWrite == true) {
             UtilFile::unlinkFile($aimUrl);
           }
           $aimDir = dirname($aimUrl);
           UtilFile::createDir($aimDir);
           touch($aimUrl);
           return true;
    }
    /**
    * 移动文件夹
    *
    * @param string $oldDir
    * @param string $aimDir
    * @param boolean $overWrite 该参数控制是否覆盖原文件
    * @return boolean
    */
    public static function moveDir($oldDir, $aimDir, $overWrite = false) {
           $aimDir = str_replace('', '/', $aimDir);
           $aimDir = substr($aimDir, -1) == '/' ? $aimDir : $aimDir . '/';
           $oldDir = str_replace('', '/', $oldDir);
           $oldDir = substr($oldDir, -1) == '/' ? $oldDir : $oldDir . '/';
           if (!is_dir($oldDir)) {
             return false;
           }
           if (!file_exists($aimDir)) {
             UtilFile::createDir($aimDir);
           }
           @$dirHandle = opendir($oldDir);
           if (!$dirHandle) {
             return false;
           }
           while(false !== ($file = readdir($dirHandle))) {
             if ($file == '.' || $file == '..') {
                continue;
             }
             if (!is_dir($oldDir.$file)) {
                UtilFile::moveFile($oldDir . $file, $aimDir . $file, $overWrite);
             } else {
                UtilFile::moveDir($oldDir . $file, $aimDir . $file, $overWrite);
             }
           }
           closedir($dirHandle);
           return rmdir($oldDir);
    }
    /**
    * 移动文件
    *
    * @param string $fileUrl
    * @param string $aimUrl
    * @param boolean $overWrite 该参数控制是否覆盖原文件
    * @return boolean
    */
    public static function moveFile($fileUrl, $aimUrl, $overWrite = false) {
           if (!file_exists($fileUrl)) {
             return false;
           }
           if (file_exists($aimUrl) && $overWrite = false) {
             return false;
           } elseif (file_exists($aimUrl) && $overWrite = true) {
             UtilFile::unlinkFile($aimUrl);
           }
           $aimDir = dirname($aimUrl);
           UtilFile::createDir($aimDir);
           rename($fileUrl, $aimUrl);
           return true;
    }
    /**
    * 删除文件夹
    *
    * @param string $aimDir
    * @return boolean
    */
    public static function unlinkDir($aimDir) {
           $aimDir = str_replace('', '/', $aimDir);
           $aimDir = substr($aimDir, -1) == '/' ? $aimDir : $aimDir.'/';
           if (!is_dir($aimDir)) {
             return false;
           }
           $dirHandle = opendir($aimDir);
           while(false !== ($file = readdir($dirHandle))) {
             if ($file == '.' || $file == '..') {
                continue;
             }
             if (!is_dir($aimDir.$file)) {
                UtilFile::unlinkFile($aimDir . $file);
             } else {
                UtilFile::unlinkDir($aimDir . $file);
             }
           }
           closedir($dirHandle);
           return rmdir($aimDir);
    }
    /**
    * 删除文件
    *
    * @param string $aimUrl
    * @return boolean
    */
    public static function unlinkFile($aimUrl) {
           if (file_exists($aimUrl)) {
             unlink($aimUrl);
             return true;
           } else {
             return false;
           }
    }
    /**
    * 复制文件夹
    *
    * @param string $oldDir
    * @param string $aimDir
    * @param boolean $overWrite 该参数控制是否覆盖原文件
    * @return boolean
    */
    public static function copyDir($oldDir, $aimDir, $overWrite = false) {
           $aimDir = str_replace('', '/', $aimDir);
           $aimDir = substr($aimDir, -1) == '/' ? $aimDir : $aimDir.'/';
           $oldDir = str_replace('', '/', $oldDir);
           $oldDir = substr($oldDir, -1) == '/' ? $oldDir : $oldDir.'/';
           if (!is_dir($oldDir)) {
             return false;
           }
           if (!file_exists($aimDir)) {
             UtilFile::createDir($aimDir);
           }
           $dirHandle = opendir($oldDir);
           while(false !== ($file = readdir($dirHandle))) {
             if ($file == '.' || $file == '..') {
                continue;
             }
             if (!is_dir($oldDir . $file)) {
                UtilFile::copyFile($oldDir . $file, $aimDir . $file, $overWrite);
             } else {
                UtilFile::copyDir($oldDir . $file, $aimDir . $file, $overWrite);
             }
           }
           return closedir($dirHandle);
    }
    /**
    * 复制文件
    *
    * @param string $fileUrl
    * @param string $aimUrl
    * @param boolean $overWrite 该参数控制是否覆盖原文件
    * @return boolean
    */
    public static function copyFile($fileUrl, $aimUrl, $overWrite = false) {
           if (!file_exists($fileUrl)) {
             return false;
           }
           if (file_exists($aimUrl) && $overWrite == false) {
             return false;
           } elseif (file_exists($aimUrl) && $overWrite == true) {
             UtilFile::unlinkFile($aimUrl);
           }
           $aimDir = dirname($aimUrl);
           UtilFile::createDir($aimDir);
           copy($fileUrl, $aimUrl);
           return true;
    }
}
?>