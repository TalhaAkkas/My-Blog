<?php

class TopMenuCustomize extends TopMenu {

    public $items = array();

    /**
     * @var array the options for the Bootstrap JavaScript plugin.
     */
    public $options = array();

    /**
     * @var array the HTML attributes for the widget container.
     */
    public $htmlOptions = array();

    /**
     * Initializes the widget.
     */
    public function init() {
        if (!isset($this->htmlOptions['id']))
            $this->htmlOptions['id'] = $this->getId();
        $root = Category::model()->findByPk(1);
        $this->items = array(array('label' => 'Anasayfa', 'url' => array('/site/index')));
        if($root != null)
            $this->items = array_merge($this->items, $this->parseCategories($root));
        array_push($this->items,array('label' => 'Hakkında', 'url' => array('/site/page', 'view' => 'about')));
        array_push($this->items,array('label' => 'Bağlantı', 'url' => array('/site/contact')));
        array_push($this->items, array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest));
    
    }

    public function parseCategories(Category $item) {
        $tempArray = array();
        foreach ($item->categories as $child) {
            array_push($tempArray, array('label' => $child->title,
                'url' => '../category/' . $child->id,
                'childs' => $this->parseCategories($child))
            );
        }
        return $tempArray;
    }

}

?>