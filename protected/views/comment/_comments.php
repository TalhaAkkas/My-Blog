<div id="comments-main">
    <h4 id="comments">Yorumlar <?php echo sizeof($data) ?></h4>
    <ul class="commentlist" id="singlecomments">
        <?php $this->renderPartial('../comment/_commentslist', array('data' =>$data)); ?>
    </ul>
    <?php echo $this->renderPartial('../comment/_respond', array('model'=> $comment, 'data' =>$data, 'articleID'=>$articleID)); ?>
    <div class="navigation"><div class="alignleft"></div><div class="alignright"></div></div>
    <div id="wp-temp-form-div" style="display: none; "></div>
</div>
