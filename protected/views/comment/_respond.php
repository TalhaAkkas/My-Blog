<div id="respond">
<h3 id="reply-title">Bir Yorumda Bulunun
<!--    <small><a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;">İptal et</a></small>-->
</h3>
<?php
$form = $this->beginWidget('CActiveForm', array(
    
    'id' => 'comment-ArticleView-form-commentform',
        )
);
?>

<p class="comment-form-author"><label for="author">İsim<span class="required">*</span></label> 
    <?php echo $form->textField($model, 'author'); ?>
    <?php echo $form->error($model, 'author'); ?></p>
<p class="comment-form-email"><label for="email">Email <span class="required">*</span></label>

    <?php echo $form->textField($model, 'email'); ?>
    <?php echo $form->error($model, 'email'); ?></p>
<p class="comment-form-comment"><label for="comment">Comment</label>
    <?php echo $form->textArea($model, 'text'); ?>
    <?php echo $form->error($model, 'text'); ?></p>
<p class="form-submit">
    
    <?php echo CHtml::submitButton( 'Create' ); ?>
    <?php //echo CHtml::ajaxButton('Gönder', CController::createUrl('commentAjax', array('id' => $articleID)), array('update' => '#singlecomments'));?>
    <input type="hidden" name="comment_post_ID" value="<?php if (isset($data->owner)) echo $data->owner ?>" id="comment_post_ID"> 
    <input type="hidden" name="comment_parent" id="comment_parent" value="<?php echo $articleID ?>"></p>

<?php $this->endWidget(); ?>
</div>