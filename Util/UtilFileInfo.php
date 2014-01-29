<?php
class UtilFileInfo
{
	public static function getMimeType($filename)
	{
		
		if (substr($filename, 0, 1) == '.' || substr($filename, 0, 1) == '/')
		{
			$mime = CFileHelper::getMimeType($filename);
		}
		elseif (substr($filename, 0, 4)== 'http')
		{
			$info = get_headers($filename, true);
			
			$mime = $info['Content-Type'];
			
		}
		
		return $mime;
		
	}
	
}
?>