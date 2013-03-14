<?php

class SidebarWidget extends CWidget {

    public $items = array();

    /**
     * @var array the options for the Bootstrap JavaScript plugin.
     */
    public $options = array();
    public $title;

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
        echo "<li class='widget'>";
        echo "<h2 class='widgettitle'>";
        if (isset($this->title)){
            echo $this->title;
        }  
        echo "</h2>";
        echo "<div id ='textwidget'>";
    }

    /**
     * Runs the widget.
     */
    public function run() {
        echo "</div>";
        echo "</li>";
    }

}

