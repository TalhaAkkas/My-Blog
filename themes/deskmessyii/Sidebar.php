<?php

class Sidebar extends CWidget {

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
        CHtml::openTag("div", array("id" => "sidebar"));
        CHtml::openTag("div", array("id" => "sidebar-top"));
        CHtml::closeTag("div");
        CHtml::openTag("div", array("id" => "sidebar-content"));
        CHtml::openTag("div", array("id" => "subcolumn"));
        CHtml::openTag("ul");
    }

    public function run() {

        CHtml::closeTag("ul");
        CHtml::closeTag("div");
        CHtml::closeTag("div");
        CHtml::openTag("div", array("id" => "sidebar-bottom"));
        CHtml::closeTag("div");
        CHtml::closeTag("div");
    }

}

?>
