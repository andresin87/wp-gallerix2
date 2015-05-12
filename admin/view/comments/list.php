<?php global $plugin_page; ?>
<div class="admin_wrapper">
    <div class="admin_section">
        <div class="admin_section_header">
            <h2><?php _e("Comments List","gallerix2");?></h2>
            <p><?php _e("Manage Comments","gallerix2");?></p>
        </div>
        
        <div class="admin_section_body fullwidth">
            
            <button onclick="window.location.href = '?page=<?php echo $plugin_page; ?>&view=list&task=deleteall';"><?php _e("Delete All Comments","gallerix2"); ?></button>
            
            <ul class="list no-touch">
                <?php $comments = Gallerix2::get_comments(); ?>
                <?php foreach ($comments as $comment): ?>
                <li id="post-<?php echo $comment->id; ?>">
                    <p><?php echo htmlspecialchars(Gallerix2::truncate_string($comment->comment, 50));?><span><?php echo $comment->name;?> (<?php echo $comment->ip; ?>) <?php echo $comment->date;?></span></p>
                    <button onclick="window.location.href = '?page=<?php echo $plugin_page; ?>&view=list&task=ban&ip=<?php echo $comment->ip; ?>';"><?php _e("Ban","gallerix2");?></button>
                    <button onclick="window.location.href = '?page=<?php echo $plugin_page; ?>&view=list&task=delete&id=<?php echo $comment->id; ?>';"><?php _e("Delete","gallerix2");?></button>
                    <button onclick="window.location.href = '?page=<?php echo $plugin_page; ?>&view=edit&id=<?php echo $comment->id;?>';"><?php _e("Edit","gallerix2");?></button>
                </li>
                <?php endforeach; ?>
            </ul>
            
            <ul class="pagination">
                <?php echo Gallerix2::get_comments_pagination(); ?>
            </ul>
            
        </div>
    </div>
</div>
