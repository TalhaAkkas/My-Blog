<div class="form-horizontal">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'article-form',
        'enableAjaxValidation' => false,
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

    <?php echo $form->errorSummary($model); ?>

    <div class="well form-inline">
        <?php echo $form->labelEx($model, 'category'); ?>
        <br />
        <?php echo $form->dropDownList($model, 'category', $categories); ?>
        <?php echo $form->error($model, 'category'); ?>
    </div>

    <div class="well form-inline">
        <?php echo $form->labelEx($model, 'title'); ?>
        <br />
        <?php echo $form->textField($model, 'title', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

        <div class="well form-horizontal">
            <?php echo $form->labelEx($model, 'article'); ?>
            <br />
            <?php
            Yii::import('ext.krichtexteditor.KRichTextEditor');
            $this->widget('KRichTextEditor', array(
                'model' => $model,
                'value' => $model->isNewRecord ? '' : $model->text,
                'attribute' => 'text',
                'options' => array(
                    'theme' => 'advanced',
                    'theme_advanced_resizing' => 'true',
                    'theme_advanced_statusbar_location' => 'bottom',
                ),
            ));
            ?>
        </div>
        <div class="well form-horizontal">
            <div class="well"id="dynamicInput"></div>
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



    <div class="well control-group">
        <br />
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

