<?php

class TopMenu extends CWidget {

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
        CHtml::openTag("li", array("class"=>"widget"));
        CHtml::openTag("h2", array("class"=>"widgettitle"));
        if(isset($this->options['title']))
            echo $this->options['title'];
        CHtml::closeTag("h2");
        CHtml::openTag("div", array("class" => "textwidget"));
    }

    /**
     * Runs the widget.
     */
    public function run() {
        CHtml::closeTag("div");
        CHtml::closeTag("li");
    }

}

