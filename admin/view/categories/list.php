<?php global $plugin_page; ?>
<div class="admin_wrapper">
    <div class="admin_section">
        <div class="admin_section_header">
            <h2><?php _e("Category List","gallerix2");?></h2>
            <p><?php _e("Create / Edit existing Category","gallerix2");?></p>
        </div>
        <div class="admin_section_body fullwidth">
            <button onclick="window.location.href = '?page=<?php echo $plugin_page; ?>&view=addedit';"><?php _e("Create New Category","gallerix2");?></button>
            <form method="POST">
                <button class="categories_reorder"><?php _e("Update Category Order","gallerix2");?></button>
            </form>
            <ul class="list no-touch">
                <?php $categories = Gallerix2::get_categories(); ?>
                <?php foreach ($categories as $category): ?>
                <li id="category-<?php echo $category->id; ?>">
                    <p><?php echo $category->title;?><span>(ID#<?php echo $category->id;?> <?php _e("Order","gallerix2"); ?>)</span></span></p>
                    <button onclick="window.location.href = '?page=<?php echo $plugin_page; ?>&view=list&task=delete&catid=<?php echo $category->id; ?>'"><?php _e("Delete","gallerix2");?></button>
                    <button onclick="window.location.href = '?page=<?php echo $plugin_page; ?>&view=addedit&catid=<?php echo $category->id;?>';"><?php _e("Edit","gallerix2");?></button>
                    <input autocomplete="off" type="text" name="order" value="<?php echo $category->ordering; ?>" />
                </li>
                <?php endforeach; ?>
            </ul>
            
            <ul class="pagination">
                <?php echo Gallerix2::get_categories_pagination(); ?>
            </ul>
            
        </div>
    </div>
</div>