<?php foreach ($data as $comment): ?>
    <div class="comment even thread-even depth-1 parent guest user-id-0 " id="comment">
        <div id="" class="">
            <div class="comment-author vcard"><?php echo $comment->author ?> <span class="says">diyor ki:</span></div>
            <br />
            <?php echo $comment->text; ?>
            <br />
            <br />
        </div>
        <div class="children">
            <?php if (isset($data->comments)) $this->renderPartial('_commentslist', $data->comments); ?>
        </div>
    </div>
        
<?php endforeach; ?>
