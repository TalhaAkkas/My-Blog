<?php
/* @var $this HolderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Holders',
);

$this->menu=array(
	array('label'=>'Create Holder', 'url'=>array('create')),
	array('label'=>'Manage Holder', 'url'=>array('admin')),
);
?>

<h1>Holders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
