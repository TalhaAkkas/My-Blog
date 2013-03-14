<?php
/* @var $this HolderController */
/* @var $model Holder */

$this->breadcrumbs=array(
	'Holders'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Holder', 'url'=>array('index')),
	array('label'=>'Create Holder', 'url'=>array('create')),
	array('label'=>'View Holder', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Holder', 'url'=>array('admin')),
);
?>

<h1>Update Holder <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>