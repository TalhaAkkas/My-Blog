<?php
/* @var $this HolderController */
/* @var $model Holder */

$this->breadcrumbs=array(
	'Holders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Holder', 'url'=>array('index')),
	array('label'=>'Create Holder', 'url'=>array('create')),
	array('label'=>'Update Holder', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Holder', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Holder', 'url'=>array('admin')),
);
?>

<h1>View Holder #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date',
		'isvirtual',
	),
)); ?>
