<?php global $plugin_page; ?>
<div class="admin_wrapper">
    <div class="admin_section">
        <div class="admin_section_header">
            <h2><?php _e("Posts List","gallerix2");?></h2>
            <p><?php _e("Create / Edit Post","gallerix2");?></p>
        </div>
        <div class="admin_section_body fullwidth">
            <button onclick="window.location.href = '?page=<?php echo $plugin_page; ?>&view=addedit';"><?php _e("Create New Post","gallerix2"); ?></button>
            <form method="POST">
                <button class="posts_reorder"><?php _e("Update Posts Order","gallerix2");?></button>
            </form>
            <ul class="list no-touch">
                <?php $posts = Gallerix2::get_posts(); ?>
                <?php foreach ($posts as $post): ?>
                <li id="post-<?php echo $post->id; ?>">
                    <p><?php echo $post->title;?><span>(ID#<?php echo $post->id;?> <?php _e("Order","gallerix2"); ?>)</span></p>
                    <button onclick="window.location.href = '?page=<?php echo $plugin_page; ?>&view=list&task=delete&id=<?php echo $post->id; ?>';"><?php _e("Delete","gallerix2");?></button>
                    <button onclick="window.location.href = '?page=<?php echo $plugin_page; ?>&view=addedit&id=<?php echo $post->id;?>';"><?php _e("Edit","gallerix2");?></button>
                    <input autocomplete="off" type="text" name="order" value="<?php echo $post->ordering; ?>" />
                </li>
                <?php endforeach; ?>
            </ul>
            
            <ul class="pagination">
                <?php echo Gallerix2::get_posts_pagination(); ?>
            </ul>
        </div>
    </div>
</div>
