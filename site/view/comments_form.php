<?php if (($options->commentsrequireuser == "1" && is_user_logged_in()) || $options->commentsrequireuser == "0") : ?>
    <?php if (!$user_is_banned) : ?>
        <div class="gallerix2-comment-form" data-gallerix-comment-form-reply-to="0">
            <div class="gallerix2-comment-form-loader"></div>
            <span class="gallerix2-comment-form-status"></span>

            <div class="gallerix2-comment-form-content">
                <h3 class="gallerix2-leave-comment-title"><?php _e("Leave a comment", "gallerix2"); ?> <span class="gallerix2-leave-comment-cancel"><?php _e("(Cancel Reply)", "gallerix2"); ?></span></h3>

                <?php if (is_user_logged_in()) : ?>
                    <?php
                    $cuser = wp_get_current_user();
                    ?>

                    <p> You are logged in as <?php echo $cuser->display_name; ?></p>
                <?php else: ?> 
                    <input class="gallerix2-form-field" required="required" name="gallerix2-form-name" type="text" placeholder="<?php _e("Your Name (Required)", "gallerix2"); ?>" />
                    <input class="gallerix2-form-field" required="required" name="gallerix2-form-email" type="email" placeholder="<?php _e("E-Mail Address (Required)", "gallerix2"); ?>" />
                    <input class="gallerix2-form-field" name="gallerix2-form-website" type="url" placeholder="<?php _e("Website", "gallerix2"); ?>" />
                <?php endif; ?> 

                <textarea class="gallerix2-form-textarea" required="required" name="gallerix2-form-comment" placeholder="<?php _e("Comment (Required)"); ?>"></textarea>

                <div class="gallerix2-form-button-submit"><?php _e("Submit Comment", "gallerix2"); ?></div>
            </div>
        </div>
    <?php endif;?>
<?php endif; ?>