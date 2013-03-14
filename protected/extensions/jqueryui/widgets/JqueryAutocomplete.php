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
class JqueryAutocomplete extends CWidget {

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

        $options = !empty($this->options) ? CJavaScript::encode($this->options['source']) : '';
        echo "<script>$(function() {var availableTags = {$options} ;$('#{$id}').autocomplete({ source: availableTags });});</script>";

        echo CHtml::tag('input', $this->htmlOptions);

    }

}
