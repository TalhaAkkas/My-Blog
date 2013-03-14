<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'category-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
    $categories = array();
    foreach (Category::model()->findAll() as $category) {
        $categories[$category->id] = $category->title;
    }
    $tags = array();
    foreach (Tag::model()->findAll() as $tag) {
        array_push($tags, $tag->text);
    }
    $usingTags = "";
    if ($model->holder0) {
        foreach ($model->holder0->tags as $tag) {
            $usingTags = $usingTags . '~' . $tag->text . '~';
        }
    }
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="well">
        <?php echo $form->labelEx($model, 'pid'); ?>
        <br />
        <?php echo $form->dropDownList($model, 'pid', $categories); ?>
        <?php echo $form->error($model, 'pid'); ?>
    </div>

    <div class="well">
        <?php echo $form->labelEx($model, 'title'); ?>
        <br />
        <?php echo $form->textField($model, 'title'); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="well">
        <?php echo $form->labelEx($model, 'icon'); ?>
        <br />
        <?php echo $form->fileField($model, 'image'); ?>
        <?php echo $form->error($model, 'icon'); ?>
    </div>
    <div class="well form-horizontal">
        <div class="well"id="dynamicInput">
        </div>
        <?php
        $this->widget('jqueryui.widgets.JqueryAutocomplete', array(
            'options' => array(
                'source' => $tags,
                'items' => 4,
            ),
        ));
        ?>

        <input rows="6" cols="50" name="Article[tagstr]" id="Article_tagstr" type="hidden" >	
        <input type="button" value="Yeni Bir Tag Ekle" onClick="onTagAdderClick('yw0', 'dynamicInput', 'Article_tagstr')">
        <script type="text/javascript">addTagsOnload("<?php echo $usingTags; ?>",'dynamicInput','Article_tagstr');</script>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->