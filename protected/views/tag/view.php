<?php
/* @var $this TagController */
/* @var $model Tag */

$this->breadcrumbs = array(
    'Tags' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Tag', 'url' => array('index')),
    array('label' => 'Create Tag', 'url' => array('create')),
    array('label' => 'Update Tag', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Tag', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Tag', 'url' => array('admin')),
);

?>

<h1><?php echo $model->text; ?></h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => new CArrayDataProvider($articles),
    'itemView' => '../article/_view',
        )
);
?>
