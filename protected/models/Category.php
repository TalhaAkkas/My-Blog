<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property integer $pid
 * @property string $title
 * @property string $icon
 * @property integer $holder
 *
 * The followings are the available model relations:
 * @property Article[] $articles
 * @property Category $p
 * @property Category[] $categories
 * @property Holder $holder0
 * @property Problematic[] $problematics
 * @property Reshare[] $reshares
 * @property Translate[] $translates
 */
class Category extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
	 */
        public $image;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pid, holder', 'numerical', 'integerOnly'=>true),
			array('title, icon', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pid, title, icon, holder', 'safe', 'on'=>'search'),
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
			'articles' => array(self::HAS_MANY, 'Article', 'category'),
			'p' => array(self::BELONGS_TO, 'Category', 'pid'),
			'categories' => array(self::HAS_MANY, 'Category', 'pid'),
			'holder0' => array(self::BELONGS_TO, 'Holder', 'holder'),
			'problematics' => array(self::HAS_MANY, 'Problematic', 'category'),
			'reshares' => array(self::HAS_MANY, 'Reshare', 'category'),
			'translates' => array(self::HAS_MANY, 'Translate', 'category'),
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
			'title' => 'Title',
			'icon' => 'Icon',
			'holder' => 'Holder',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('holder',$this->holder);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}