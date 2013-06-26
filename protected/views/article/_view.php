<?php
$usingTags = "";
if ($data->holder0) {
    foreach ($data->holder0->tags as $tag) {
        $usingTags = $usingTags . '~' . $tag->text .'`'. $tag->id . '~';
    }
}
?>


<div class="well-small">
    <h1><?php //echo CHtml::encode($data->category);    ?></h1>
    <br />

    <h3><?php echo CHtml::link(CHtml::encode($data->title), "../article/" . $data->id, $options = array('class' => 'blacklink')); ?></h3>
    <input rows="6" cols="50" name="Article[tagstr]" id="<?php echo $data->id ?>dArticle_tagstr" type="hidden" >
    <div id="<?php echo $data->id ?>dynamicInput"></div>
    <script type="text/javascript">addTagsLinkedOnload("<?php echo $usingTags; ?>",'<?php echo $data->id ?>dynamicInput','<?php echo $data->id ?>dArticle_tagstr', '<?php echo Yii::app()->request->baseUrl ?>');</script>
    
    <br />

    <?php
    echo StaticLib::htmlcut($data->text, 500);
    ?>

    <br />
    
</div>