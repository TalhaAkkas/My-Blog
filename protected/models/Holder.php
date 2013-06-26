<?php

/**
 * This is the model class for table "holder".
 *
 * The followings are the available columns in table 'holder':
 * @property integer $id
 * @property string $date
 * @property integer $isvirtual
 *
 * The followings are the available model relations:
 * @property Article[] $articles
 * @property Category[] $categories
 * @property Comment[] $comments
 * @property Postit[] $postits
 * @property Problematic[] $problematics
 * @property Process[] $processes
 * @property Process[] $processes1
 * @property Project[] $projects
 * @property Qtip[] $qtips
 * @property Reshare[] $reshares
 * @property Tag[] $tags
 * @property Translate[] $translates
 * @property Update[] $updates
 */
class Holder extends CActiveRecord
{
        private $_owner;
        
        public function getOwner(){
            $criteria=new CDbCriteria;
            $criteria->addCondition("holder = " . $this->id);
            return Article::model()->findAll($criteria);
        }
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Holder the static model class
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
		return 'holder';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('isvirtual', 'numerical', 'integerOnly'=>true),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date, isvirtual', 'safe', 'on'=>'search'),
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
			'articles' => array(self::MANY_MANY, 'Article', 'article_holder(holder, article)'),
			'categories' => array(self::HAS_MANY, 'Category', 'holder'),
			'comments' => array(self::HAS_MANY, 'Comment', 'owner'),
			'postits' => array(self::MANY_MANY, 'Postit', 'postit_holder(holder, postit)'),
			'problematics' => array(self::MANY_MANY, 'Problematic', 'problematic_holder(holder, problematic)'),
			'processes' => array(self::HAS_MANY, 'Process', 'entityholder'),
			'processes1' => array(self::HAS_MANY, 'Process', 'holder'),
			'projects' => array(self::MANY_MANY, 'Project', 'project_holder(holder, project)'),
			'qtips' => array(self::MANY_MANY, 'Qtip', 'qtip_holder(holder, qtip)'),
			'reshares' => array(self::MANY_MANY, 'Reshare', 'reshare_holder(holder, reshare)'),
			'tags' => array(self::MANY_MANY, 'Tag', 'tag_holder(holder, tag)'),
			'translates' => array(self::MANY_MANY, 'Translate', 'translate_holder(holder, translate)'),
			'updates' => array(self::HAS_MANY, 'Update', 'owner'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date' => 'Date',
			'isvirtual' => 'Isvirtual',
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('isvirtual',$this->isvirtual);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}