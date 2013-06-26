<?php

/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property integer $id
 * @property integer $category
 * @property string $title
 * @property string $text
 * @property integer $holder
 *
 * The followings are the available model relations:
 * @property Category $category0
 * @property Holder $holder0
 * @property Holder[] $holders
 * @property Project[] $projects
 * @property Translate[] $translates
 */
class Article extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Article the static model class
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
		return 'article';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category, holder', 'numerical', 'integerOnly'=>true),
			array('title, text', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category, title, text, date', 'safe', 'on'=>'search'),
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
			'category0' => array(self::BELONGS_TO, 'Category', 'category'),
			'holder0' => array(self::BELONGS_TO, 'Holder', 'holder'),
			'holders' => array(self::MANY_MANY, 'Holder', 'article_holder(article, holder)'),
			'projects' => array(self::HAS_MANY, 'Project', 'desctription'),
			'translates' => array(self::HAS_MANY, 'Translate', 'article'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category' => 'Category',
			'title' => 'Title',
			'text' => 'Text',
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
		$criteria->compare('category',$this->category);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('text',$this->text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        public function getDate()
        {
            return Holder::model()->findByPk($this->holder)->date;
        }
        public function setDate($date)
        {
            if(! $date instanceof CDbExpression){
                throw  new Exception('Bad Date Type');
            }
            $this->holder0->date = $date;
            $this->holder0->save();
        }
        
        public function getIsvirtual()
        {
            return ($this->holder0->isvirtual == 0);
        }
        public function setIsvirtual($isvirtual)
        {
            if(! is_bool($isvirtual)){
                throw  new Exception('Bad Date Type');
            }
            if($isvirtual)
                $this->holder0->isvirtual = 0;
            else
                $this->holder0->isvirtual = 1;
            $this->holder0->save();
        }
}