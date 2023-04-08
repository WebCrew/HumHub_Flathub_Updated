<?php

use yii\helpers\Url;
use humhub\modules\comment\widgets\ShowMore;
?>
<div class="well well-small comment-container" style="display:none;" id="comment_<?= $id; ?>">
    <div class="comment <?php if (Yii::$app->user->isGuest): ?>guest-mode<?php endif; ?>" id="comments_area_<?= $id; ?>">
        
        <?= ShowMore::widget([
            'object' => $object,
            'commentId' => isset($comments[0]) ? $comments[0]->id : null,
            'type' => ShowMore::TYPE_PREVIOUS,
        ]); ?>
        
        <?php foreach ($comments as $comment) : ?>
            <?= \humhub\modules\comment\widgets\Comment::widget(['comment' => $comment]); ?>
        <?php endforeach; ?>
    </div>

    <?= \humhub\modules\comment\widgets\Form::widget(['object' => $object]); ?>

</div>
<?php /* END: Comment Create Form */ ?>

<script>

<?php if (count($comments) != 0) { ?>
    // make comments visible at this point to fixing autoresizing issue for textareas in Firefox
    $('#comment_<?php echo $id; ?>').show();
<?php } ?>

</script>
