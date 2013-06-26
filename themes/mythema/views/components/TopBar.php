<?php
class TopBar extends CWidget {
 
    public $urls = array();
 
    public function run() {
        $this->render('_topbar', array('urls' =>$this->urls)); 
        
    }
 
}
?>