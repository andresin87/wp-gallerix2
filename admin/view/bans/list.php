<?php global $plugin_page; ?>
<div class="admin_wrapper">
    <div class="admin_section">
        <div class="admin_section_header">
            <h2><?php _e("Ban List","gallerix2");?></h2>
            <p><?php _e("Manage Ban List","gallerix2");?></p>
        </div>
        
        <div class="admin_section_body fullwidth">
            
            <button onclick="window.location.href = '?page=<?php echo $plugin_page; ?>&view=list&task=unbanall';"><?php _e("Delete Ban List","gallerix2"); ?></button>
            
            <ul class="list no-touch">
                <?php $bans = Gallerix2::get_bans(); ?>
                <?php foreach ($bans as $ban): ?>
                <li id="ban-<?php echo $ban->id; ?>">
                    <p><?php echo $ban->ip; ?></p>
                    <button onclick="window.location.href = '?page=<?php echo $plugin_page; ?>&view=list&task=unban&id=<?php echo $ban->id; ?>';"><?php _e("Unban","gallerix2");?></button>
                </li>
                <?php endforeach; ?>
            </ul>
            
        </div>
    </div>
</div>
