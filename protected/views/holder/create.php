<?php
/* @var $this HolderController */
/* @var $model Holder */

$this->breadcrumbs=array(
	'Holders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Holder', 'url'=>array('index')),
	array('label'=>'Manage Holder', 'url'=>array('admin')),
);
?>

<h1>Create Holder</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>