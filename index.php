<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);

$app = Yii::createWebApplication($config);
$app->run();

if(count(Holder::model()->findAll()) === 0){
    $none = new Holder;
    $none->isvirtual = 1;
    $none->save();  
}
if(count(Category::model()->findAll()) === 0){
    $root = new Category;
    $root->title = "root";
    $root->holder = 1;
    $root->save();  
}

