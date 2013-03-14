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
    }

    /**
     * Runs the widget.
     */
    public function run() {
        $id = $this->id;
        echo "<div id='top-navigation-menu'>";
        echo "<ul class='nav-menu'>";
        foreach ($this->items as $element) {
            echo"<li class='page_item'>";
            echo $this->renderMenuItem($element);
            //echo "<a href='{$element['label']}'>{$element['url']}</a>";
            if (isset($element['childs'])) {
                 echo $this->placeChildItems($element['childs']);
            }

            echo"</li>";
        }

        echo "</ul>";
        echo "</div>";
    }

    public function placeChildItems($item) {
        echo "<ul class='child'>";
        foreach ($item as $element) {
            echo"<li class='page_item'>";
            echo $this->renderMenuItem($element);
            //echo "<a href='{$element['label']}'>{$element['url']}</a>";
            if (isset($element['childs'])) {
                $this->placeChildItems($element['childs']);
            }

            echo"</li>";
        }

        echo "</ul>";
    }

    protected function renderMenuItem($item) {
        if (isset($item['url'])) {
            $label = $item['label'];
            return CHtml::link($label, $item['url'], isset($item['linkOptions']) ? $item['linkOptions'] : array());
        }
    }

}

?>
