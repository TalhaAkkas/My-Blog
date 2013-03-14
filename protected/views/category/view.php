<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs = array(
    'Categories' => array('index'),
    $model->title,
);

$this->menu = array(
    'sidemenu' => array(
        array('label' => 'List Category', 'url' => array('index')),
        array('label' => 'Create Category', 'url' => array('create')),
        array('label' => 'Update Category', 'url' => array('update', 'id' => $model->id)),
        array('label' => 'Delete Category', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
        array('label' => 'Manage Category', 'url' => array('admin')),
    ),
);
$articles = array();
foreach ($model->articles as $article) {
    array_push($articles, $article);
}
?>

<h1><?php echo $model->title; ?></h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => new CArrayDataProvider($articles, array(
            'sort'=>array(
                    'defaultOrder'=>'id DESC',
                ),
        )
     ),
    'itemView' => '../article/_view',
    
    'sortableAttributes' => array(
        'id',
    ),
    )
);
?>
