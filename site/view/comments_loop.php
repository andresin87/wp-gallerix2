<?php $user_is_banned = Gallerix2::is_user_banned(); ?>
<?php if ($comments && $options) : ?>
    <?php foreach ($comments as $comment) : ?>
        <?php
        $level = $comment->replyto != "0" ? "gallerix2-post-comment-level-1" : "";
        ?>
        <li data-gallerix2-comment-id="<?php echo $comment->id; ?>" class="gallerix2-post-comment <?php echo $level; ?>">
            <div class="gallerix2-post-comment-icon">
                <?php
                echo get_avatar($comment->email, 50);
                ?>
            </div>
            
            <div class="gallerix2-post-comment-info">
                <div class="gallerix2-post-comment-author">
                    <?php 
                    if ($comment->website != "") {
                        echo "<a target=\"_BLANK\" href=\"$comment->website\">$comment->name</a>";
                    } else {
                        echo $comment->name;
                    }
                    ?>
                </div>
                <div class="gallerix2-post-comment-date"><?php echo $comment->date; ?></div>
            </div>
            
            <div class="gallerix2-post-comment-text">
                <?php echo nl2br(htmlspecialchars($comment->comment)); ?>
            </div>

            <?php if (($options->commentsrequireuser == "1" && is_user_logged_in()) || $options->commentsrequireuser == "0") : ?>
                <?php if (!$user_is_banned) : ?>
                    <a href="#" class="galleri2-post-comment-reply"><?php _e("Reply to this post", "gallerix2"); ?></a>
                <?php endif; ?>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
<?php endif; ?>