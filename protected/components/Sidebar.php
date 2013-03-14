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
        if (!isset($this->htmlOptions['id'])) {
            $this->htmlOptions['id'] = $this->getId();
        }

        echo "<div id ='sidebar-top'>";
        echo "</div>";
        echo "<div id ='sidebar-content'>";
            echo "<div id ='subcolumn'>";
            echo "<ul>";
    }

    public function run() {

            echo "</ul>";
        echo "</div>";
        echo "</div>";
        echo "<div id ='sidebar-bottom'>";
        echo "</div>";
    }

}

?>
