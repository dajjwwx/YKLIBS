<?php 
$includeDirs = array(
		'Models',
		'Libaray',
		'Libaray/Util',
		'Libaray/api',
		'Libaray/Zend',
		'Libaray/search/phpanalysis',
		'Libaray/pear',
		'Libaray/pear/Flickr',
		'Libaray/pear/Http',
		'Libaray/pear/Http/Request',
		'Libaray/pear/Net',
		'Libaray/pear/XML',
		'Libaray/pear/XML/Tree',
);

$includeDirs = array_map('importDir',$includeDirs);


set_include_path(implode(';', $includeDirs));


function importDir($dir)
{
	return dirname(dirname(__FILE__)).'/yuekegu-common/'.$dir;
}


