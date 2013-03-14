<?php foreach ($data as $comment): ?>
    <li class="comment even thread-even depth-1 parent guest user-id-0 " id="comment">
        <div id="div-comment-902" class="comment-body">
            <div class="comment-author vcard"><?php echo $comment->author ?> <span class="says">diyor ki:</span></div>
            <br />
            <?php echo $comment->text; ?>
            <br />
            <br />
        </div>
        <ul class="children">
        <?php if (isset($data->comments)) $this->renderPartial('_commentslist', $data->comments); ?>
        </ul>
    </li>
        
<?php endforeach; ?>
