<?php

/**
 * BootTypeahead class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 * @since 0.9.10
 */

/**
 * Bootstrap type-a-head widget.
 */
class FooterMenu extends CWidget {

    public $firstcolumheader = "En son yazılar";
    public $firstcolumlist = array();
    public $secondcolumheader = "Bazı yazılar";
    public $secondcolumlist = array();

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
        
        if (!isset($this->secondcolumlist))
            $secondcolumlist = Tag::model()->findAll();
    }

    /**
     * Runs the widget.
     */
    public function run() {
        $id = $this->id;

        echo "<div class='comments'>";

        echo "<h2>{$this->firstcolumheader}</h2>";
//        echo"<div id='ebootstraphero-comments' >";

        for ($i = 0; $i < 5 && $i < sizeof($this->firstcolumlist); $i++) {
            echo CHtml::image(Yii::app()->theme->baseUrl . '/images/arrow.gif');
            echo CHtml::link($this->firstcolumlist[$i]['text'], $this->firstcolumlist[$i]['href']);
            echo "<br />";
        }

        echo "</div>";



        $articles = array();
        foreach ($this->secondcolumlist as $tags) {
            foreach ($tags->holders as $holder) {
                $prop = Article::model()->findAll("holder = ?", $holder->id);
                foreach ($prop as $article) {
                    array_push($articles, $article);
                }
            }
        }
        
        $secondArray = array();
        foreach ($articles as $article) {
            $secondArray["../article/" .$article->id] = $article->title;
            $i++;
            if(count($secondArray) > 5 ){break;}
        }
        
      
        echo "<div class='particles'>";
        echo "<h2>{$this->secondcolumheader}</h2>";

        foreach ($secondArray as $key => $value) {
            
            echo CHtml::image(Yii::app()->theme->baseUrl . '/images/arrow.gif');
            echo CHtml::link($value, $key);
            echo "<br />";
        }
        echo"</div>";
    }

}