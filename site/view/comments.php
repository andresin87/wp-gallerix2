<?php
$comments = Gallerix2::front_get_comments($post->id);
$total    = Gallerix2::get_total_comments($post->id);
?>

<h3 class="gallerix2-post-comments-title">
    <?php echo $comments_title = $total == 1 ? "<span>1</span> " . __("Comment", "gallerix2") : "<span>{$total}</span> " . __("Comments", "gallerix2"); ?>
</h3>

<ul class="gallerix2-post-comments-list">
    <?php include("comments_loop.php"); ?>
</ul>

<?php if (count($comments) < $total) : ?>
    <div class="gallerix2-comments-load-more">
        <div class="gallerix2-comments-load-more-loader"></div>
        <div class="gallerix2-comments-load-more-button"><?php _e("Load older comments", "gallerix2"); ?></div>
    </div>
<?php endif; ?>

<?php include("comments_form.php"); ?>