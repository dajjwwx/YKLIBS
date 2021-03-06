<?php

/**
 * This is the model class for table "{{expertise}}".
 *
 * The followings are the available columns in table '{{expertise}}':
 * @property integer $id
 * @property integer $pid
 * @property string $name
 */
class Expertise extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Expertise the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{expertise}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pid, name', 'required'),
			array('pid', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pid, name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'children'=>array(self::HAS_MANY, 'Expertise', 'pid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pid' => 'Pid',
			'name' => 'Name',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function generateExpertiseList($isSelect = true)
    {
        $result = array('select'=>'选择科目');        
      
        $model = self::model()->findAll(array(
            'condition'=>'pid = 0',
        ));
        
        foreach($model as $item)
        {
            $result[$item->id] = $item->name;
        }
        
        //$result = array_merge($pre,$result);
        
        if($isSelete === false)
        {
            $keys = array_keys($result);
            $values = array_values($result);
        
            array_shift($keys);
            array_shift($values);
            
            $result = array_combine($keys,$values);

        }
        
        return $result;
        
    }
    
}