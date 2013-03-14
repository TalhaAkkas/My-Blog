<?php
$this->breadcrumbs=array(
	'Articles',
);

$this->menu=array(
    'sidemenu' => array(
	array('label'=>'Create Articles', 'url'=>array('create')),
	array('label'=>'Manage Articles', 'url'=>array('admin')),
        ),
);
?>

<h1>Tüm Yazılarım</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
        
)); ?>
