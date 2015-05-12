<?php global $plugin_page; ?>
<!-- Admin Wrapper Start -->
<div class="admin_wrapper">

    <!-- Admin Section Start -->
    <div class="admin_section">

        <!-- Admin Section Header Start -->
        <div class="admin_section_header">
            <h2><?php _e("Create / Edit Post","gallerix2");?></h2>
            <p><?php _e("Create / Edit Post","gallerix2");?></p>
        </div><!--/admin_section_header -->
        <!-- Admin Section Header End -->

        <!-- Admin Section Body Start -->
        <div class="admin_section_body">
            <form action="?page=<?php echo $plugin_page; ?>&view=list" method="POST">
                <?php
                /*
                 *  $post - Post Object ($_REQUEST["id"])
                 *  if $post - update table;
                 *  else - create new post;
                 * 
                 */
                $post = Gallerix2::get_post();
                ?>
                <!-- Text Field Start -->
                <label>
                    <span><?php _e("Post Title","gallerix2");?></span>
                    <span class="caption_note">(<?php _e("Required!","gallerix2");?>)</span><br />
                    <input required name="title" type="text" value="<?php echo $post ? $post->title : ""; ?>" />
                    <p>(<?php _e("Enter Post Title","gallerix2");?>)</p>
                </label>
                <!-- Text Field End -->

                <!-- Select Field Start -->
                <label>
                    <span><?php _e("Post Category","gallerix2");?></span>
                    <span class="caption_note">(<?php _e("Required!","gallerix2");?>)</span><br />
                    <select required name="catid[]" multiple>
                        <?php $categories = Gallerix2::get_categories(true); ?>
                        <?php foreach ($categories as $category): ?>
                            <?php $postcatid = explode(",",$post->catid); ?>
                            <option <?php echo $post && (in_array($category->id, $postcatid)) ? "selected" : ""; ?> value="<?php echo $category->id; ?>"><?php echo $category->title; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p>(<?php _e("Select Post Category. Hold Ctrl Key to select multiple categories.","gallerix2");?>)</p>
                </label>
                <!-- Select Field End -->

                <!-- Text Field Start -->
                <label>
                    <span><?php _e("Post Thumb","gallerix2");?></span>
                    <span class="caption_note">(<?php _e("Required!","gallerix2");?>)</span><br />
                    <input required name="thumb" type="text" value="<?php echo $post ? $post->thumb : ""; ?>" />
                    <p>(<?php _e("Post Thumbnail","gallerix2");?>)</p>
                </label>
                <!-- Text Field End -->
                
             
                
                <div class="gallerix2-post-images">
                    
                    <label>
                        <span><?php _e("Post Image", "gallerix2"); ?></span>
                        <div class="remove_post_image"><i class="fa fa-times"></i></div>
                        <span class="caption_note">(<?php _e("Required!", "gallerix2"); ?>)</span><br />
                        <input name="image[]" type="text" value="" />
                        <p>(<?php _e("Pick image(s) from the Media Library", "gallerix2"); ?>)</p>
                    </label>
                    
                    <?php
                    if ($post) :
                        $images = explode("||", $post->image);
                        foreach ($images as $image):
                            if ($image):
                                ?>
                                <label>
                                    <span><?php _e("Post Image","gallerix2");?></span>
                                    <div class="remove_post_image"><i class="fa fa-times"></i></div>
                                    <span class="caption_note">(<?php _e("Optional.","gallerix2");?>)</span><br />
                                    <input name="image[]" type="text" value="<?php echo $image; ?>" />
                                    <p>(<?php _e("Pick image(s) from the Media Library","gallerix2");?>)</p>
                                </label>
                                <?php
                            endif;
                        endforeach;
                    endif;
                    ?>
                    
                </div>
                
                
                
                
                
                
                
                
                <!-- Text Area Start -->
                <label>
                    <span><?php _e("Post Short Text","gallerix2");?></span>
                    <span class="caption_note">(<?php _e("Optional.","gallerix2");?>)</span><br />
                    <textarea name="short" cols="" rows=""><?php echo $post ? $post->short : ""; ?></textarea>
                    <p>(<?php _e("Post Short Text","gallerix2");?>)</p>
                </label>                
                <!-- Text Area End -->
                
                <!-- Text Area Start -->
                <label>
                    <span><?php _e("Post Content","gallerix2");?></span>
                    <span class="caption_note">(<?php _e("Optional.","gallerix2");?>)</span><br />
                    <textarea name="content" cols="" rows=""><?php echo $post ? $post->content : ""; ?></textarea>
                    <p>(<?php _e("Post Content","gallerix2");?>)</p>
                </label>                
                <!-- Text Area End -->

                <?php if ($post) : ?>
                <input type="hidden" name="update" value="<?php echo $post->id; ?>" />
                <?php endif; ?>
                <input type="hidden" name="task" value="create" />
                <button><?php _e("Save Post","gallerix2");?></button>
            </form>
            <button onclick="window.location.href = '?page=<?php echo $plugin_page; ?>&view=list';"><?php _e("Cancel","gallerix2");?></button>
        </div><!--/admin_section_body-->
        <!-- Admin Section Body End -->

    </div><!--/admin_section -->
    <!-- Admin Section End -->

</div><!--/admin_wrapper-->
<!-- Admin Wrapper End -->