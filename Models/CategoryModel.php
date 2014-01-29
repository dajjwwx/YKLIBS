<?php
/**
 * @copyright (c) 2014 Blue Jobs <zclandxy@gmail.com>
 * @link http://www.yuekegu.com
 * @version 1.0
 * @date 2014/3/18
 * @license http://www.yuekegu.com/lisence
 * @description Define the CategoryModel fields
 * 
 *****************************************************************
 *Functions List：
 *    
 *
 *
 *
 *
 *
 *
 *
 *********************************************************************
 * 
 * History：
 *
 */
class CategoryModel
{
	public $id;				//主键ID
	
	//基本字段
	public $name;			//分类名称
	public $pid;			//父类ID
	
	//附加字段
	public $type;			//分类类型，每一个分类的父ID都设为0
	public $owner;			//分类所有者
	public $weight;			//分类权重
	public $description;	//分类描述
	
	//额外字段
	public $deep;			//分类深度
	
	/**
	 *
	 * 
	 * 
	 ******************************************************************************************** 
	 * @param array $array	//
	 * @param int $pid		//父ID
	 * @param int $y		//初始深度
	 * @param array $tdata
	 * 
	 * @return CategoryModel
	 */
	public function getChildrenArray($array,$pid=0,$y=0,&$tdata=array())
	{
		//然后递归的取出各个子分类，这里默认的$pid=0是因为数据库中的pid为0的表示是第一级分类
		foreach ($array as $value)
		{
			if($value['pid']==$pid){
				$n = $y + 1;
				$value['deep'] = $n;
				if($n > 1)
				{
					$value['name']=$value['name'];
				}
				$tdata[]=$value;
				$this->getChildrenArray($array,$value['id'],$n,$tdata);//这里递归调用，不明白递归的朋友，去找几个简单的递归例子熟悉下
			}
		}
		return $tdata;
	}
	
	
	/**
	 * 将传入的分类数据按PID进行递归
	 ********************************************************************************************* 
	 * 
	 * @method self::getChildrenObject()
	 * 
	 * 
	 *****************************************************************************************
	 *Usage：
	 *		$result = array();
	 *		$categories = Category::model()->findAll();
	 *		foreach ($categories as $category)
	 *		{
	 *			$model = new CategoryModel();
	 *			$model->id = $category->id;
	 *			$model->name = $category->name;
	 *			$model->pid = $category->pid;
	 *			$result[] = $model;
	 *		}
	 *	
	 *		UtilHelper::dump(CategoryModel::getChildrenObject($result,0,0)); 
	 * 
	 ******************************************************************************************** 
	 * 
	 * @param array $array	//传入的是Category的对象List
	 * @param int $pid
	 * @param int $y
	 * @param array $tdata
	 */
	public static function getChildrenObject($array,$pid=0,$y=0,&$tdata=array())
	{
		foreach ($array as $value)
		{
			if($value->pid == $pid)
			{
				$n = $y + 1;
				$value->deep = $n;
				if($n > 1)
				{
					$value->name = $value->name;					
				}
				$tdata[]=$value;
				self::getChildrenObject($array,$value->id,$n,$tdata);//这里递归调用，不明白递归的朋友，去找几个简单的递归例子熟悉下
				
			}
		}
		return $tdata;
	}
	
	
	public function generateCategoryList()
	{
		
	}
	
	
	
}
?>