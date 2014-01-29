<?php 

	# @gist require_io
	require_once('qiniu/io.php');
	# @endgist
	# @gist require_rs
	require_once('qiniu/rs.php');
	# @endgist
	# @gist require_fop
	require_once('qiniu/fop.php');
	# @endgist
	# @gist require_rsf
	require_once('qiniu/rsf.php');
	# @endgist
	# @gist require_rio
	require_once('qiniu/resumable_io.php');
	# @endgist
	
	
	class QiNiu
	{
	
		private $domain;
		private $accessKey;
		private $secretKey;
		
		private $bucket;
		
		private $upToken;
		
		public function __construct()
		{	
			
			$this->bucket = Yii::app()->params['QiNiu']['bucket'];
			$this->domain = Yii::app()->params['QiNiu']['domain'];
			$this->accessKey = Yii::app()->params['QiNiu']['accessKey'];
			$this->secretKey = Yii::app()->params['QiNiu']['secretKey'];
			
			Qiniu_setKeys($this->accessKey, $this->secretKey);
			# @endgist
			# @gist mac_client
// 			$client = new Qiniu_MacHttpClient(null);
			# @endgist
			//------------------------------------io-----------------------------------------
			# @gist putpolicy
			$putPolicy = new Qiniu_RS_PutPolicy($this->bucket);
			$this->upToken = $putPolicy->Token(null);
			# @endgist		
			
		}
		
		/**
		 * 返回文件的键名
		 * @param File $model
		 * @param string $folder
		 * @return mixed
		 */
		public function getKey(FileModel $model, $folder=null)
		{			
			
// 			UtilHelper::dump($model);

			if (is_null($folder)) {
				$folder = Yii::app()->params->uploadMediaPath;
			}
			
// 			$file = File::model()->generateFilePath($model,true,false,$folder);
			
			$file = $model->generateFilePath($folder,true,false);
			
// 			echo $file;
				
			$filename = pathinfo($file, PATHINFO_BASENAME);
			
// 			echo $filename;
			return $filename;
			
		}
		
		/**
		 * 同步文件到七牛
		 * @param File $model
		 * @param string $folder
		 */
		public function synchronizationFile($model, $folder=null)
		{
			
			if (is_null($folder)) {
				$folder = Yii::app()->params->uploadMediaPath;
			}
			
// 			$model = new FileModel();
			
			$model= File::model()->attributeAdapter($model);
			
			$file = $model->generateFilePath($folder,true,false);

// 			$file = File::model()->generateFilePath($model,true,false,$folder);
			
// 			UtilHelper::dump(pathinfo($file));
			
			$filename = pathinfo($file, PATHINFO_BASENAME);
			
			$stat = $this->fileStat($filename);
			
// 			UtilHelper::dump($stat);
			
			if ($stat['error'] != null) {		

				$upload = $this->uploadFile($filename, $file);
				
				$result = array(
						'message'=>$upload['message'],
						'success'=>$upload['success']
				);
	
			} else {
				$result =  array(
						'success'=>false,
						'message'=>"此文件已经同步了"
				);
			}
			
			return $result;
			
		}
		
		/** 
		 * 返回查询文件状态
		 * @param string $key
		 * @return multitype:unknown Ambigous <multitype:NULL unknown , multitype:NULL Qiniu_Error , multitype:NULL Ambigous <NULL, mixed> , multitype:unknown Qiniu_Error >
		 */
		public function fileStat($key)
		{
			
			$result = array();
			
			$client = new Qiniu_MacHttpClient(null);
			
			list($ret, $err) = Qiniu_RS_Stat($client, $this->bucket, $key);
			
			$result = array(
					'error'=>$err,
					'stat'=>$ret
					
			);
			
			return $result;		
			
			
// 			if ($err != null) {
// 				UtilHelper::dump($err);
// 			} else {
// 				UtilHelper::dump($ret);
// 			}
			
		}
		
		
		/**
		 * 上传文件
		 * @param string $key
		 * @param string $localFile
		 */
		public function uploadFile($key,$localFile)
		{
			
			
			$putExtra = new Qiniu_Rio_PutExtra($this->bucket);
			list($ret,$err) = Qiniu_Rio_PutFile($this->upToken, $key, $localFile, $putExtra);
			
			if ($err !== null) {
				return array(
						'success'=>false,
						'message'=>"文件{$key}上传失败~"
						
				);
			} else {				
				return  array(
						'success'=>true,
						'message'=>"文件{$key}上传成功~"
				);
			}		
			
		}
		
		
		/**
		 * 上传文本内容
		 * @param string $key
		 * @param string $string
		 */
		public function uploadString($key, $string)
		{

			list($ret, $err) = Qiniu_Put($this->upToken, $key, $string, null);
			echo "====> Qiniu_Put result: \n";
			if ($err !== null) {
			    var_dump($err);
			} else {
			    var_dump($ret);
			}
			
		}
		
		/**
		 * 删除文件
		 * @param string $key
		 */
		public function delete($key)
		{
			
			$client = new Qiniu_MacHttpClient(null);			
			$err = Qiniu_RS_Delete($client, $this->bucket, $key);
			
			echo "===>Qiniu_RS_DELETE result: \n";
			
			if ($err != null) {
				var_dump($err);
			} else {
				var_dump("Success!");
			}			
		}
		
		
		/**
		 * 获取文件地址
		 * @param string $key
		 * @return string
		 */
		public function getFileLinks($key)
		{
			$baseUrl = Qiniu_RS_MakeBaseUrl($this->domain, $key);
			
			return $baseUrl;
		}
		
		/**
		 * 获取图片缩略图
		 * @param string $key
		 * @param number $width
		 * @return string
		 */
		public function getImageLinks($key,$width=210)
		{
			# @gist base_url
			//$baseUrl 就是您要访问资源的地址
			$baseUrl = Qiniu_RS_MakeBaseUrl($this->domain, $key);
			# @endgist
			
			# @gist image_view
			$getPolicy = new Qiniu_RS_GetPolicy();
			$imgView = new Qiniu_ImageView;
			$imgView->Mode = 0;
			$imgView->Width =$width;
			// 	$imgView->Height = 30;
			
			//生成fopUrl
			$imgViewUrl = $imgView->MakeRequest($baseUrl);
			
			//对fopUrl 进行签名，生成privateUrl。 公有bucket 此步可以省去。
			$imgViewPrivateUrl = $getPolicy->MakeRequest($imgViewUrl, null);
			
			return $imgViewPrivateUrl;
			
// 			echo "\n\n====> imageView privateUrl: \n";
// 			echo $imgViewPrivateUrl . "\n";
// 			# @endgist			
		}
		
		/**
		 * 获取图片的EXIF信息
		 * @param string $key
		 * @return mixed
		 */
		public function getImageExifInfo($key)
		{
			//生成baseUrl
			$baseUrl = Qiniu_RS_MakeBaseUrl($this->domain, $key);
			
			//生成fopUrl
			$imgExif = new Qiniu_Exif;
			$imgExifUrl = $imgExif->MakeRequest($baseUrl);
			
			//对fopUrl 进行签名，生成privateUrl。 公有bucket 此步可以省去。
			$getPolicy = new Qiniu_RS_GetPolicy();
			$imgExifPrivateUrl = $getPolicy->MakeRequest($imgExifUrl, null);
			
			return json_decode(file_get_contents($imgExifPrivateUrl));
			
// 			return $imgExifPrivateUrl;
// 			echo "====> imageView privateUrl: \n";
// 			echo $imgExifPrivateUrl . "\n";
		}
	
	}

?>