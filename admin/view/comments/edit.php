<?php global $plugin_page; ?>
<!-- Admin Wrapper Start -->
<div class="admin_wrapper">

    <!-- Admin Section Start -->
    <div class="admin_section">

        <!-- Admin Section Header Start -->
        <div class="admin_section_header">
            <h2><?php _e("Edit Comment","gallerix2");?></h2>
            <p><?php _e("Edit Comment","gallerix2");?></p>
        </div><!--/admin_section_header -->
        <!-- Admin Section Header End -->

        <!-- Admin Section Body Start -->
        <div class="admin_section_body">
            <form action="?page=<?php echo $plugin_page; ?>&view=list" method="POST">
                <?php
                /*
                 *  $comment - Post Object ($_REQUEST["id"])
                 * 
                 */
                $comment = Gallerix2::get_comment();
                ?>
                <!-- Text Field Start -->
                <label>
                    <span><?php _e("Comment Author","gallerix2");?></span>
                    <span class="caption_note">(<?php _e("Required!","gallerix2");?>)</span><br />
                    <input required name="name" type="text" value="<?php echo $comment ? $comment->name : ""; ?>" />
                    <p>(<?php _e("Edit Author Name","gallerix2");?>)</p>
                </label>
                <!-- Text Field End -->
                
                <!-- Text Area Start -->
                <label>
                    <span><?php _e("Comment Text","gallerix2");?></span>
                    <span class="caption_note">(<?php _e("Required!","gallerix2");?>)</span><br />
                    <textarea required name="comment" cols="" rows=""><?php echo (($comment->comment)); ?></textarea>
                    <p>(<?php _e("Edit Comment Text","gallerix2");?>)</p>
                </label>                
                <!-- Text Area End -->

                <?php if ($comment) : ?>
                    <input type="hidden" name="update" value="<?php echo $comment->id; ?>" />
                <?php endif; ?>
                <input type="hidden" name="task" value="edit" />
                <button><?php _e("Update","gallerix2");?></button>
            </form>
            <button onclick="window.location.href = '?page=<?php echo $plugin_page; ?>&view=list';"><?php _e("Cancel","gallerix2");?></button>
        </div><!--/admin_section_body-->
        <!-- Admin Section Body End -->

    </div><!--/admin_section -->
    <!-- Admin Section End -->

</div><!--/admin_wrapper-->
<!-- Admin Wrapper End -->