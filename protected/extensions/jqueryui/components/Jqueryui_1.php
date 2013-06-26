<?php

/**
 * Bootstrap class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version 0.9.12
 */

/**
 * Bootstrap application component.
 * Used for registering Bootstrap core functionality.
 */
class Jqueryui extends CApplicationComponent {
    // Bootstrap plugins.

    const PLUGIN_AUTOCOMPLETE = 'typeahead';

    /**
     * @var boolean whether to register the Bootstrap core CSS (bootstrap.min.css).
     * Defaults to true.
     */
    public $coreCss = true;

    /**
     * @var boolean whether to register the Bootstrap responsive CSS (bootstrap-responsive.min.css).
     * Defaults to false.
     */
    public $responsiveCss = false;

    /**
     * @var boolean whether to register the Yii-specific CSS missing from Bootstrap.
     * @since 0.9.12
     */
    public $yiiCss = true;

    /**
     * @var boolean whether to register jQuery and the Bootstrap JavaScript.
     * @since 0.9.10
     */
    public $enableJS = true;

    /**
     * @var array the plugin options (name=>options).
     * @since 0.9.8
     */
    public $plugins = array();

    /**
     * @var boolean whether to enable debugging mode.
     */
    public $debug = false;
    protected $_assetsUrl;

    /**
     * Initializes the component.
     */
    public function init() {
        // Register the bootstrap path alias.
        if (!Yii::getPathOfAlias('jqueryui'))
            Yii::setPathOfAlias('jqueryui', realpath(dirname(__FILE__) . '/..'));

        // Prevents the extension from registering scripts
        // and publishing assets when ran from the command line.
        if (php_sapi_name() === 'cli')
            return;

        if ($this->coreCss)
            $this->registerCss();
        
        if ($this->responsiveCss)
            $this->registerResponsiveCss();

        if ($this->yiiCss)
            $this->registerYiiCss();
        
        if ($this->enableJS)
            $this->registerCorePlugins();
    }

    /**
     * Registers the Bootstrap CSS.
     */
    public function registerCss() {
        Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/css/smoothness/jquery-ui-1.8.23.custom.css');
    }

    /**
     * Registers the Bootstrap responsive CSS.
     * @since 0.9.8
     */
    public function registerResponsiveCss() {
        /** @var CClientScript $cs */
        $cs = Yii::app()->getClientScript();
        $cs->registerMetaTag('width=device-width, initial-scale=1.0', 'viewport');
        $cs->registerCssFile($this->getAssetsUrl() . '/css/bootstrap-responsive.min.css');
    }

    /**
     * Registers the Yii-specific CSS missing from Bootstrap.
     * @since 0.9.11
     */
    public function registerYiiCss() {
        Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/css/bootstrap-yii.css');
    }

    /**
     * Registers the core JavaScript plugins.
     * @since 0.9.8
     */
    public function registerCorePlugins() {
        /** @var CClientScript $cs */
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile($this->getAssetsUrl() . '/js/jquery-ui-1.8.23.custom.min.js');
       // $cs->registerScriptFile($this->getAssetsUrl() . '/js/jquery-1.8.0.min.js');
    }

    /**
     * Registers the Bootstrap alert plugin.
     * @param string $selector the CSS selector
     * @param array $options the plugin options
     * @see http://twitter.github.com/bootstrap/javascript.html#alerts
     * @since 0.9.8
     */

    /**
     * Registers the Bootstrap typeahead plugin.
     * @param string $selector the CSS selector
     * @param array $options the plugin options
     * @see http://twitter.github.com/bootstrap/javascript.html#typeahead
     * @since 0.9.8
     */
    public function registerAutocomplete($selector = null, $options = array()) {
        $this->registerPlugin(self::PLUGIN_AUTOCOMPLETE, $selector, $options);
    }

    /**
     * Sets the target element for the scrollspy.
     * @param string $selector the CSS selector
     * @param string $target the target CSS selector
     * @param string $offset the offset
     */
    public function spyOn($selector, $target = null, $offset = null) {
        $script = "jQuery('{$selector}').attr('data-spy', 'scroll');";

        if (isset($target))
            $script .= "jQuery('{$selector}').attr('data-target', '{$target}');";

        if (isset($offset))
            $script .= "jQuery('{$selector}').attr('data-offset', '{$offset}');";

        Yii::app()->clientScript->registerScript(__CLASS__ . '.spyOn.' . $selector, $script, CClientScript::POS_BEGIN);
    }

    /**
     * Registers a Bootstrap JavaScript plugin.
     * @param string $name the name of the plugin
     * @param string $selector the CSS selector
     * @param array $options the plugin options
     * @param string $defaultSelector the default CSS selector
     * @since 0.9.8
     */
    protected function registerPlugin($name, $selector = null, $options = array(), $defaultSelector = null) {
        if (!isset($selector) && empty($options)) {
            // Initialization from extension configuration.
            $config = isset($this->plugins[$name]) ? $this->plugins[$name] : array();

            if (isset($config['selector']))
                $selector = $config['selector'];

            if (isset($config['options']))
                $options = $config['options'];

            if (!isset($selector))
                $selector = $defaultSelector;
        }

        if (isset($selector)) {
            $key = __CLASS__ . '.' . md5($name . $selector . serialize($options) . $defaultSelector);
            $options = !empty($options) ? CJavaScript::encode($options) : '';
            Yii::app()->clientScript->registerScript($key, "jQuery('{$selector}').{$name}({$options});");
        }
    }

    /**
     * Returns the URL to the published assets folder.
     * @return string the URL
     */
    protected function getAssetsUrl() {
        if ($this->_assetsUrl !== null)
            return $this->_assetsUrl;
        else {
            $assetsPath = Yii::getPathOfAlias('jqueryui.assets');

            if ($this->debug)
                $assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, true);
            else
                $assetsUrl = Yii::app()->assetManager->publish($assetsPath);

            return $this->_assetsUrl = $assetsUrl;
        }
    }

}
