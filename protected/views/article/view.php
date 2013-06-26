<?php
$this->breadcrumbs = array(
    'Articles' => array('index'),
    $model->title,
);
$usingTags = "";
if ($model->holder0) {
    foreach ($model->holder0->tags as $tag) {
        $usingTags = $usingTags . '~' . $tag->text . '`' . $tag->id . '~';
    }
}
$this->menu=array(
    'sidemenu' => array(
	array('label'=>'List Article', 'url'=>array('index')),
	array('label'=>'Create Article', 'url'=>array('create')),
	array('label'=>'Update Article', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Article', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
        ),
);
?>
<div class="large-12 columns">
			
    <div>
    <span><h3><?php echo CHtml::encode($model->title);?>  </h3> <?php echo $model->holder0-> date;?></span>
    </div>
    <br />
    <br />
    <input rows="6" cols="50" name="Article[tagstr]" id="<?php echo $model->id ?>dArticle_tagstr" type="hidden" >
    <div id="<?php echo $model->id ?>dynamicInput"></div>
    <script type="text/javascript">addTagsLinkedOnload("<?php echo $usingTags; ?>",'<?php echo $model->id ?>dynamicInput','<?php echo $model->id ?>dArticle_tagstr', '<?php echo Yii::app()->request->baseUrl ?>');</script>

    <div class="row">
        <div class="large-12 columns">
            <div class="panel">
                <?php echo $model->text;?>
            </div>
        </div>
    </div>


    <br />
    <?php $this->renderPartial('../comment/_comments', array('data'=>$model->holder0->comments, 'comment'=>$comment,'articleID'=>$model->id)); ?>

</div>


