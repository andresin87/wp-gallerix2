<?php global $plugin_page; ?>
<div class="admin_wrapper">
    <div class="admin_section">
        <div class="admin_section_header">
            <h2><?php _e("Add/Edit Category","gallerix2");?></h2>
            <p><?php _e("Create new or edit existing category","gallerix2");?></p>
        </div>

        <div class="admin_section_body">
            <form action="?page=<?php echo $plugin_page; ?>&view=list" method="POST">
                <?php
                /*
                 *  $category - Category Object Array ($_REQUEST["catid"])
                 *  if $category - update table;
                 *  else - create new category;
                 * 
                 */
                $category = Gallerix2::get_category();
                ?>

                <label>
                    <span><?php _e("Category Title","gallerix2");?></span>
                    <span class="caption_note">(<?php _e("Required!","gallerix2");?>)</span><br />
                    <input required type="text" name="title" value="<?php echo $category ? $category->title : "" ?>"/>
                    <p>(<?php _e("Name of the category","gallerix2");?>)</p>
                </label>

                <label>
                    <span><?php _e("Category Thumb","gallerix2");?></span>
                    <span class="caption_note">(<?php _e("Optional.","gallerix2");?>)</span><br />
                    <input type="text" name="thumb" value="<?php echo $category ? $category->thumb : "" ?>"/>
                    <p>(<?php _e("If empty, the category will use post thumb","gallerix2");?>)</p>
                </label>

                <input type="hidden" name="task" value="create" />
                <?php if ($category) : ?><input type="hidden" name="update" value="<?php echo $category->id; ?>" /><?php endif; ?>
                <?php if ($category) : ?><button><?php _e("Update Category","gallerix2");?></button><?php else: ?><button><?php _e("Save Category","gallerix2");?></button><?php endif; ?>

            </form>
            <button onclick="window.location.href = '?page=<?php echo $plugin_page; ?>&view=list';"><?php _e("Cancel","gallerix2");?></button>
        </div>
    </div>
</div>
