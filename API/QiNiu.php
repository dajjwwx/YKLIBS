<?php

use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;

class Qiniu
{
	

	private $domain;
	private $accessKey;
	private $secretKey;
	private $bucket;		
	private $token;

	private $UploadManager;
	private $bucketManager;
	
	public function __construct()
	{	
			
		$this->bucket = Yii::app()->params['QiNiu']['bucket'];
		$this->domain = Yii::app()->params['QiNiu']['domain'];
		$this->accessKey = Yii::app()->params['QiNiu']['accessKey'];
		$this->secretKey = Yii::app()->params['QiNiu']['secretKey'];

		$this->getToken();

			
	}

	protected function getToken()
	{
		$auth = new Auth($this->accessKey,$this->secretKey);

		$this->token = $auth->uploadToken($this->bucket);
	}

	public function getUploadManager()
	{
		$this->UploadManager = new UploadManager();
		return $this;
	}

	public function getBucketManager()
	{
		$this->bucketManager = new BucketManager();
		return $this;
	}

	/**
	 * 返回文件的键名
	 * @param File $model
	 * @param string $folder
	 * @return mixed
	 */
	public function getKey(File $model, $folder=null)
	{			
			
// 		UtilHelper::dump($model);

		if (is_null($folder)) {
			$folder = Yii::app()->params->uploadFilePath;
		}		

		$model = File::model()->attributeAdapter($model, Yii::app()->params->uploadGaoKaoPath);
		
		$filename = $model->generateFilePath($folder, false, false);			

		return $filename;
			
	}

	// 上传字符串到七牛
	public function putString($key, $string)
	{
		
		list($ret, $err) = $this->uploadManager->put($this->token, $key, $string);
		echo "\n====> put result: \n";
		if ($err !== null) {
		    var_dump($err);
		} else {
		    var_dump($ret);
		}
	}


	// 上传本地文件到七牛
	public function putFile($key, $filePath)
	{
		
		// $filePath = './php-logo.png';
		// $key = 'php-logo.png';
		list($ret, $err) = $this->uploadManager->putFile($token, $key, $filePath);
		echo "\n====> putFile result: \n";
		if ($err !== null) {
		    var_dump($err);
		} else {
		    var_dump($ret);
		}
	}

	public function fetchFile($key, $uri)
	{

		list($ret, $err) = $this->bucketManager->fetch($url, $this->bucket, $key);
		echo "=====> fetch $url to bucket: $bucket  key: $key\n";
		if ($err !== null) {
		    var_dump($err);
		} else {
		    echo 'Success';
		}		
	}

}


?>