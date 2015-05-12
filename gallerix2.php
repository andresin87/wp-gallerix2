<?php
/*
    Plugin Name: Gallerix II
    Description: Gallerix II for WordPress
    Version: 1.4
    Author: Eightyclouds
    Author URI: http://eightyclouds.com
 */

function Gallerix2() {
    
        
    /* =====================================================
     * Define DS as dir separator
     * ==================================================== */
    
    defined("DS") ? NULL : define("DS", DIRECTORY_SEPARATOR);
    
    
    
    
    /* =====================================================
     * Load language
     * ==================================================== */

    load_plugin_textdomain('gallerix2', false, basename( dirname( __FILE__ ) ) . DS . 'languages' );
    
    
    
    
    /* =====================================================
     * Load Class
     * ==================================================== */

    require_once dirname(__FILE__) . DS . "admin" . DS . "class" . DS . "gallerix2.php";
    Gallerix2::set_filename_path(__FILE__);
    
    

    
    
    
    
    /* =====================================================
     * Activate
     * ==================================================== */
    
    register_activation_hook(__FILE__, "gallerix2_install");

    function gallerix2_install() {
        require_once dirname(__FILE__) . DS . "install.php";
    }

    
    
    
    
    /* =====================================================
     * Uninstall
     * ==================================================== */
    
    register_uninstall_hook(__FILE__, "gallerix2_uninstall");

    function gallerix2_uninstall() {
        require_once dirname(__FILE__) . DS . "uninstall.php";
    }

    
    
    
    
    /* =====================================================
     * Admin Menus
     * ==================================================== */

    function gallerix2_home()       { require ("admin/view/home/index.php");       }
    function gallerix2_general()    { require ("admin/view/general/index.php");    }
    function gallerix2_categories() { require ("admin/view/categories/index.php"); }
    function gallerix2_posts()      { require ("admin/view/posts/index.php");      }
    function gallerix2_comments()   { require ("admin/view/comments/index.php");   }
    function gallerix2_bans()       { require ("admin/view/bans/index.php");       }

    function gallerix2_menus() {
        add_menu_page("Gallerix II", "Gallerix II", "update_plugins", "gallerix2", "gallerix2_home", "dashicons-format-image");
        add_submenu_page("gallerix2", "General", "General", "update_plugins", "gallerix2_general", "gallerix2_general");
        add_submenu_page("gallerix2", "Categories", "Categories", "update_plugins", "gallerix2_categories", "gallerix2_categories");
        add_submenu_page("gallerix2", "Posts", "Posts", "update_plugins", "gallerix2_posts", "gallerix2_posts");
        add_submenu_page("gallerix2", "Comments", "Comments", "update_plugins", "gallerix2_comments", "gallerix2_comments");
        add_submenu_page("gallerix2", "Ban List", "Ban List", "update_plugins", "gallerix2_bans", "gallerix2_bans");
    }

    add_action("admin_menu", "gallerix2_menus");

    
    
    
    
    /* =====================================================
     * Load Admin CSS and JS
     * ==================================================== */
    
    function gallerix2_admin_scripts($hook) {
        if (
                $hook == 'toplevel_page_gallerix2' ||
                $hook == 'gallerix-ii_page_gallerix2_general' ||
                $hook == 'gallerix-ii_page_gallerix2_categories' ||
                $hook == 'gallerix-ii_page_gallerix2_posts'  ||
                $hook == 'gallerix-ii_page_gallerix2_comments'  ||
                $hook == 'gallerix-ii_page_gallerix2_bans' 
        )
            
        Gallerix2::load_admin_scripts();
    }

    add_action('admin_enqueue_scripts', 'gallerix2_admin_scripts');
    
    
    
    
    
    /* =====================================================
     * Shortcode Quicktag
     * ==================================================== */
    
    if (is_admin()) {
        function gallerix2_quicktags() {
            if (wp_script_is('quicktags')) {
                ?>
                    <script type="text/javascript">
                         QTags . addButton('gallerix2' , 'Gallerix II', '[gallerix2]' , '', '', 'Displays the Gallerix II plugin');
                    </script>
                <?php
            }
        }

        add_action( 'admin_print_footer_scripts', 'gallerix2_quicktags' );
    }
    
    
    
    
    
    
    
    
    /* =====================================================
     * AJAX
     * ==================================================== */

    function gallerix2_ajax() {
    ?>
        <script type="text/javascript">
            if (typeof ajaxurl === "undefined") 
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        </script>
    <?php
    }
    add_action('wp_head', 'gallerix2_ajax');



    function gallerix2_send_comment() {
        Gallerix2::send_comment();
        die();
    }
    add_action('wp_ajax_nopriv_gallerix2_send_comment', 'gallerix2_send_comment');
    add_action('wp_ajax_gallerix2_send_comment', 'gallerix2_send_comment');

    



    function gallerix2_load_more_comments() {
        Gallerix2::load_more_comments();
        die();
    }
    add_action('wp_ajax_nopriv_gallerix2_load_more_comments', 'gallerix2_load_more_comments');
    add_action('wp_ajax_gallerix2_load_more_comments', 'gallerix2_load_more_comments');

    
    
    
    

    function gallerix2_post_viewed() {
        Gallerix2::post_viewed();
        die();
    }
    add_action('wp_ajax_nopriv_gallerix2_post_viewed', 'gallerix2_post_viewed');
    add_action('wp_ajax_gallerix2_post_viewed', 'gallerix2_post_viewed');

    
    
    
    
    

    function gallerix2_post_liked() {
        Gallerix2::post_liked();
        die();
    }
    add_action('wp_ajax_nopriv_gallerix2_post_liked', 'gallerix2_post_liked');
    add_action('wp_ajax_gallerix2_post_liked', 'gallerix2_post_liked');

    
    
    
    
    
    
    
    /* =====================================================
     * Front
     * ==================================================== */
    
    function gallerix2_check_for_shortcode() {
        global $post;
        if (has_shortcode($post->post_content, 'gallerix2')) {
            Gallerix2::load_front_scripts();
        }
    }

    add_action('wp_enqueue_scripts', 'gallerix2_check_for_shortcode');

    function gallerix2_display($override = array()) {
        ob_start();
        
        $options = Gallerix2::get_options();
        
        if (!empty($override)) {
            foreach ($override as $key => $value) {
                $options->{$key} = $value;
            }
        }
        
        if (!isset($options->id)) $options->id = "gallerix2-instance-".rand(0, 9999);
        
        Gallerix2::register_js_instance( array(
                "id"             => "$options->id",
                "catperpage"     => "$options->catperpage",
                "postperpage"    => "$options->postperpage",
                "swapanimation"  => "$options->swapanimation",
                "disqus"         => "$options->disqus",
                "disqussite"     => "$options->disqussite",
                "rtnavigation"   => "$options->rtnavigation"
        ));
        
        Gallerix2::load_front_scripts("footer");

        require dirname(__FILE__) . DS . "site" . DS . "view" . DS . "default.php";
        
        return ob_get_clean();
    }

    add_shortcode("gallerix2", "gallerix2_display");
}

Gallerix2();