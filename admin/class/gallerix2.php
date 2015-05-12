<?php
class Gallerix2 {
    
    private static $TB_PREFIX            = "gallerixii";
    private static $__FILE__             = "";
    private static $__DIR__              = "";
    private static $front_scripts_loaded = false;
    private static $comments             = array();
    private static $google_fonts         = array();
    
    static function table_prefix() {
        global $wpdb;
        $table_prefix = $wpdb->base_prefix;
        $tb_prefix = self::$TB_PREFIX;
        $table = $table_prefix.$tb_prefix;
        
        if (!$table) die("Gallerix 2: Table prefix missing!");
        return $table;
    }
    
    static function REQUEST($var, $type = "REQUEST", $default = false) {
        switch (strtolower($type)):
            case "get" :
                return isset($_GET["{$var}"]) ? stripslashes_deep($_GET["{$var}"]) : $default;
        
            case "post":
                return isset($_POST["{$var}"]) ? stripslashes_deep($_POST["{$var}"]) : $default;
      
            case "request":
            default: return isset($_REQUEST["{$var}"]) ? stripslashes_deep($_REQUEST["{$var}"]) : $default;
        endswitch;
    }
    
    static function set_filename_path($file) {
        self::$__FILE__ = $file;
        self::$__DIR__  = dirname($file);
    }
    
    static function load_admin_scripts() {
        wp_enqueue_media();
        
        wp_enqueue_style("font-awesome", "//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
        
        wp_enqueue_style("colorpicker_style", plugins_url("/admin/js/colorpicker/css/colorpicker.css", self::$__FILE__));
        wp_enqueue_style("gallerix2_admin_css", plugins_url("/admin/css/style.css", self::$__FILE__));

        wp_enqueue_script("colorpicker_js",  plugins_url("/admin/js/colorpicker/js/colorpicker.js", self::$__FILE__),array("jquery"));
        wp_enqueue_script("gallerix2_admin_js",  plugins_url("/admin/js/admin.js", self::$__FILE__), array("jquery"));
        
    } 
    
    static function register_js_instance($params = false) {
        if (!$params) return;
        $params = json_encode($params);
        ?>
        <script type='text/javascript'>
            if (typeof gallerix2_instance === "undefined") {
                var gallerix2_instance = [];
            }
            gallerix2_instance.push(<?php echo $params; ?>);
        </script>
        <?php
    }
     
    static function load_front_scripts($position = "header") {
        if (self::$front_scripts_loaded != false) return;
        
        wp_enqueue_script("jquery");
        wp_enqueue_style("font-awesome", "//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
        wp_enqueue_style('gallerix2_css', plugins_url('site/css/gallerix2.css', self::$__FILE__));
        wp_enqueue_style('gallerix2_animations_css', plugins_url('site/css/gallerix2-animations.css', self::$__FILE__));
        wp_enqueue_script('jquery-cookie', plugins_url('site/js/jquery.cookie.js', self::$__FILE__), array("jquery"));
        wp_enqueue_script('jquery-easing', plugins_url('site/js/jquery.easing.js', self::$__FILE__), array("jquery"));
        wp_enqueue_script('imagesloaded', plugins_url('site/js/imagesloaded.js', self::$__FILE__), array("jquery"));
        wp_enqueue_script('gallerix2_js', plugins_url('site/js/gallerix2.js', self::$__FILE__), array("jquery"));
        
        
        wp_localize_script('gallerix2_js', 'gallerix2L10n', array(
            'commentsent' => __('Comment Sent!', 'gallerix2'),
        ));

        switch ($position) {
            case "footer" :
                add_action('wp_footer', array( __CLASS__ , 'generate_css')); 
            break;
            case "header":
            default:
                add_action('wp_head', array( __CLASS__ , 'generate_css'));
        }
        
        self::$front_scripts_loaded = true;
    }
    
    public static function generate_css() {
        include self::$__DIR__ . DS . "site" . DS . "css" . DS . "generate.php"; 
    }
    
    public static function load_google_fonts() {
        
        $fonts = array(
            "titlefont",
            "cattitlefont" ,
            "posttitlefont",
            "postdescfont",
            "postcommentsfont",
            "postlikesfont",
            "postviewsfont" ,
            
            "lightboxtitlefont",
            "lightboxdescfont",
            "lightboxsharelinksfont",
            "lightboxcommentsheaderfont",
            "lightboxcommentsauthorfont",
            "lightboxcommentsdatefont",
            "lightboxcommentstextfont",
            "lightboxcommentsreplylinkfont",
            "lightboxcommentsloadmorefont",
            "lightboxcommentformheaderfont",
            "lightboxcommentforminputfont",
            "lightboxcommentformbuttonfont",
            "lightboxcommentformcancelreplyfont"
        );
        
        $prefix  = self::$TB_PREFIX; 
        $include = array();
        
        foreach($fonts as $font) {
            $fontfamily = get_option($prefix.$font);
            
            if (!empty($fontfamily)) {
                if ($fontfamily != "default") {
                    if (!in_array($fontfamily, $fonts)) {
                        $include[] = $fontfamily;
                    }
                }
            }
        }
        
        $fonts = implode("|", $include);
        
        if (!empty($fonts)) {
            ?>
            <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo urlencode($fonts); ?>">
            <?php
        }
    }
    
    
    private static function clean_cat($cat = 0, $return_array = 0) {
        if (is_string($cat)) {
            $cat = explode(",", $cat);
        }
        foreach ($cat as $k => $v) {
            $cat[$k] = (int) $v;
        }
        
        if ($return_array) {
            return $cat;
        } else {
            $cat = implode(",", $cat);
            return $cat;
        } 
    }
    
    /*
     *  Returns category object array by catid
     *  returns false on empty
     */
    public static function get_category($catid = null) {
        if (!$catid) $catid = (int) self::REQUEST ("catid");
        if ($catid <= 0) return false;
        global $wpdb;
        $table_prefix = self::table_prefix();
        $category = $wpdb->get_results("SELECT * FROM {$table_prefix}_categories WHERE id = {$catid}");
        return !empty($category) ? $category[0] : false;
    }
    
    
    
    
    /*
     * Get list of categories object array
     */
    public static function get_categories($all = false) {
        global $wpdb;
        $table_prefix = self::table_prefix();
        
        if ($all) {
            $categories = $wpdb->get_results("SELECT * FROM {$table_prefix}_categories ORDER BY `ordering`,`id` ");
            return !empty($categories) ? $categories : array();
        }
        
        $perpage = 10;
        $page    = max(self::REQUEST("paged") - 1, 0);
        $offset  = $page * $perpage;
        
        $categories = $wpdb->get_results("SELECT * FROM {$table_prefix}_categories ORDER BY `ordering`,`id` LIMIT {$offset}, {$perpage} ");
        return !empty($categories) ? $categories : array();
    }

    /*
     * Get list of categories pages number
     */

    public static function get_categories_pagination() {
        global $wpdb;
        $table_prefix = self::table_prefix();
        global $plugin_page;
        $perpage = 10;

        $categories = $wpdb->query("SELECT * FROM {$table_prefix}_categories");

        $pages = max(ceil($categories / $perpage), 0);
        
        $cpage = max(self::REQUEST("paged"),1);
        
        if ($pages <= 1) return;
        
        ob_start();
        for ($page = 1; $page <= $pages; $page++) {
            $k = $cpage == $page ? "active" : "";
            $href = "?page=$plugin_page&paged=$page";
            echo "<li class='$k'><a href='$href'>$page</a></li>";
        }
        return ob_get_clean();
    }
    
    
    
    
    
    
    /*
     * Create or Update Category
     */
    public static function create_category() {
        global $wpdb;
        $table_prefix = self::table_prefix();
        
        $title     = self::REQUEST("title","post", false);
        $thumb     = self::REQUEST("thumb","post", "");
        $update    = self::REQUEST("update","post");
        $ordering  = 0;
        
        if (!$title) return new WP_Error("broke", "Category must have title!");
        
        if ($update) :
            $id = (int) $update;
            if ($id <= 0) return false;
            $query = $wpdb->update(
                "{$table_prefix}_categories", array(
                "title" => "{$title}",
                "thumb" => "{$thumb}",
                ),
                array('id' => $id),
                array(
                    '%s',
                    '%s'
                )
            );
        else :
            $query = $wpdb->insert(
                "{$table_prefix}_categories", array(
                "title"    => "{$title}",
                "thumb"    => "{$thumb}",
                "ordering" => "{$ordering}"
                ),
                array(
                    '%s',
                    '%s',
                    '%d'
                )
            );
        endif;
        
        if ($query === false) :
            $wpdb->show_errors();
            return new WP_Error("broke", "SQL Error: ". $wpdb->last_error);
        endif;
    }
    
    /*
     * Delete Post
     */
    public static function delete_post() {
        global $wpdb;
        $table_prefix = self::table_prefix();
        $id = (int) self::REQUEST("id");
        if ($id <= 0) return new WP_Error("broke", "Unable to delete non-existent post!");
        $query = $wpdb->query(
            $wpdb->prepare(
            "
                DELETE FROM {$table_prefix}_posts
                WHERE id = %d
            ", $id
            )
        );
                
        if ($query === false) {
            $wpdb->show_errors();
            return new WP_Error("broke", "SQL Error: " . $wpdb->last_error);
        }
    }
    
    /*
     * Delete Category
     */
    public static function delete_category() {
        global $wpdb;
        $table_prefix = self::table_prefix();
        $id = (int) self::REQUEST("catid");
        if ($id <= 0) return new WP_Error("broke", "Unable to delete non-existent category!");
        $query = $wpdb->query(
            $wpdb->prepare(
            "
                DELETE FROM {$table_prefix}_categories
                WHERE id = %d
            ", $id
            )
        );
                
        if ($query === false) {
            $wpdb->show_errors();
            return new WP_Error("broke", "SQL Error: ". $wpdb->last_error);
        }
        
        $query = $wpdb->query(
            $wpdb->prepare(
            "
                DELETE FROM {$table_prefix}_posts
                WHERE catid = %d
            ", $id
            )
        );
                
        if ($query === false) {
            $wpdb->show_errors();
            return new WP_Error("broke", "SQL Error: " . $wpdb->last_error);
        }
        
        $posts = self::get_posts();
        
        foreach ($posts as $post) {
            $cats = explode(",",$post->catid);
            
            if (in_array($id, $cats)) {
                foreach ($cats as $k => $cat) {
                    if ($cat == $id) {
                        unset($cats[$k]);
                    }
                }
                
                $cats = array_values($cats); 
                $catid = self::clean_cat($cats);
                
                $query = $wpdb->update(
                    "{$table_prefix}_posts", 
                    array(
                        "catid"     => "{$catid}"
                    ), 
                    array(
                        'id' => $post->id
                    ), 
                    array(
                        '%s'
                    )
                );
            }
        }
    }

    /*
     * Get list of posts object array
     */
    public static function get_posts() {
        global $wpdb;
        $table_prefix = self::table_prefix();
        
        $perpage = 10;
        $page    = max(self::REQUEST("paged") - 1, 0);
        $offset  = $page * $perpage;
        
        $posts = $wpdb->get_results("SELECT * FROM {$table_prefix}_posts ORDER BY `ordering`,`id` LIMIT {$offset}, {$perpage} ");
        return !empty($posts) ? $posts : array();
    }

    /*
     * Get list of posts pages number
     */

    public static function get_posts_pagination() {
        global $wpdb;
        $table_prefix = self::table_prefix();
        global $plugin_page;
        $perpage = 10;

        $posts = $wpdb->query("SELECT * FROM {$table_prefix}_posts");

        $pages = max(ceil($posts / $perpage), 0);
        
        $cpage = max(self::REQUEST("paged"),1);
        
        if ($pages <= 1) return;
        
        ob_start();
        for ($page = 1; $page <= $pages; $page++) {
            $k = $cpage == $page ? "active" : "";
            $href = "?page=$plugin_page&paged=$page";
            echo "<li class='$k'><a href='$href'>$page</a></li>";
        }
        return ob_get_clean();
    }
    

    /*
     * Get post object array 
     * returns false on empty
     */
    public static function get_post($id = null) {
        $id = (int)self::REQUEST("id");
        if ($id <= 0) return false;
        global $wpdb;
        $table_prefix = self::table_prefix();
        $post = $wpdb->get_results("SELECT * FROM {$table_prefix}_posts WHERE id = {$id}");
        return !empty($post) ? $post[0] : false;
    }
    
    /*
     * Create of Update Post
     */

    public static function create_post() {
        global $wpdb;
        $table_prefix = self::table_prefix();

        $title     = self::REQUEST("title","post", false);
        $catid     = self::REQUEST("catid", "post", false);
        $thumb     = self::REQUEST("thumb", "post", false);
        $image     = self::REQUEST("image", "post", false);
        $short     = self::REQUEST("short", "post", "");
        $content   = self::REQUEST("content", "post", "");
        
        $update    = self::REQUEST("update", "post");
        $ordering  = 0;
        
        if (!$title)     return new WP_Error("broke", "Post must have title!");
        if (!$catid)     return new WP_Error("broke", "Post must have category!");
        if (!$thumb)     return new WP_Error("broke", "Post must have thumb!");
        if (!$image)     return new WP_Error("broke", "Post must have at least one image!");
        
        $image = implode("||",$image);
        
        $query = $wpdb->get_var("SELECT MAX(ordering) FROM {$table_prefix}_posts");
        
        if ($query === false) :
            $wpdb->show_errors();
            return new WP_Error("broke", "SQL Error: " . $wpdb->last_error);
        endif;
        
        $ordering = (int) $query + 1;
        
        $catid = self::clean_cat($catid);
        
        if ($update) :
            $id = (int) $update;
            if ($id <= 0) return false;
            $query = $wpdb->update(
                "{$table_prefix}_posts", 
                array(
                    "title"     => "{$title}",
                    "catid"     => "{$catid}",
                    "thumb"     => "{$thumb}",
                    "image"     => "{$image}",
                    "short"     => "{$short}",
                    "content"   => "{$content}"
                ), 
                array(
                    'id' => $id
                ), 
                array(
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s'
                )
            );
        else :
            $query = $wpdb->insert(
                "{$table_prefix}_posts", 
                 array(
                    "title"     => "{$title}",
                    "catid"     => "{$catid}",
                    "thumb"     => "{$thumb}",
                    "image"     => "{$image}",
                    "short"     => "{$short}",
                    "content"   => "{$content}",
                    "likes"     => "0",
                    "views"     => "0",
                    "ordering"  => "{$ordering}"
                ), array(
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%d',
                    '%d',
                    '%d'
                )
            );
        endif;

        if ($query === false) :
            $wpdb->show_errors();
            return new WP_Error("broke", "SQL Error: " . $wpdb->last_error);
        endif;
    }
    
    /*
     * Post ordering
     */
    public static function order_posts() {
        $order = self::REQUEST("order");
        
        if (empty($order)) return;
        
        global $wpdb;
        $table_prefix = self::table_prefix();
        
        foreach ($order as $k) {
            $k = explode(":",$k);
            $p = (int) $k[0];
            $o = (int) $k[1];
            $query = $wpdb->update(
                "{$table_prefix}_posts", 
                array("ordering" => "{$o}"),
                array("id"    => "{$p}"),
                array('%d'),
                array('%d')
            );
             
            if ($query === false) :
                $wpdb->show_errors();
                return new WP_Error("broke", "SQL Error: " . $wpdb->last_error);
            endif;
        }
    }
    
    
    /*
     * Categories ordering
     */
    public static function order_categories() {
        $order = self::REQUEST("order");
        
        if (empty($order)) return;
        
        global $wpdb;
        $table_prefix = self::table_prefix();
        
        foreach ($order as $k) {
            $k = explode(":",$k);
            $p = (int) $k[0];
            $o = (int) $k[1];
            $query = $wpdb->update(
                "{$table_prefix}_categories", 
                array("ordering" => "{$o}"),
                array("id"    => "{$p}"),
                array('%d'),
                array('%d')
            );
             
            if ($query === false) :
                $wpdb->show_errors();
                return new WP_Error("broke", "SQL Error: " . $wpdb->last_error);
            endif;
        }
    }
       
    
    /*
     *  Returns posts object array FRONT END
     */
    public static function front_get_posts($cat = 0) {
        global $wpdb;
        $table_prefix = self::table_prefix();
     
        $if_cat   = "";
        
        if ($cat != "0" && !empty($cat)) {
            $catarray = self::clean_cat($cat, 1); // 1 returns array instead of comma separated string
            $if_cat = " WHERE ";
            
            foreach ($catarray as $catid) {
                $if_cat .= " FIND_IN_SET('$catid', catid) ";
                if (end($catarray) !== $catid) {
                    $if_cat .= " OR ";
                }
            }
        }
        
        $posts = $wpdb->get_results("SELECT * FROM {$table_prefix}_posts {$if_cat} ORDER BY `ordering`,`id` ");
        
        if ($posts && !empty($posts)) {
            foreach ($posts as $k => $post) {
                $comments = $wpdb->query("SELECT `id` FROM {$table_prefix}_comments WHERE postid={$post->id} ");
                $posts[$k]->comments = (int)$comments;
            }
        }

        return !empty($posts) ? $posts : array();
    }
    
    
    /*
     *  Returns list of categories object array FRONT END
     */
    public static function front_get_categories($cat = "0") {
        global $wpdb;
        $table_prefix = self::table_prefix();
        
        $filter_cat  = "";
        if ($cat != "0") {
            $cat = self::clean_cat($cat);
            $filter_cat = " WHERE c.`id` IN ({$cat}) ";
        }
        
        $categories = $wpdb->get_results(" 
            SELECT c.*, p.thumb as postthumb FROM {$table_prefix}_categories as c
            LEFT JOIN (
                SELECT `catid`, `thumb` FROM {$table_prefix}_posts order by `ordering`,`id` DESC
            ) as p ON
            p.catid = c.id 
            {$filter_cat}
            GROUP BY c.id
            ORDER BY c.`ordering`, c.`id`
        ");
            
        return !empty($categories) ? $categories : array();
    }
    
    /*
     *  Truncate string
     */
    
    public static function truncate_string($str = "", $length = 120) {
        if (!(string)$str) $str = "";
        
        $truncate = substr($str, 0, $length);
        
        if (strlen($truncate) < strlen($str)) {
            $truncate .= "...";
        }
        
        return $truncate;
    }
    
    /*
     * Comments  
     */
    
    public static function get_total_comments($postid = false) {
        if (!$postid) return 0;
        
        global $wpdb;
        $table_prefix = self::table_prefix();
        
        $query = $wpdb->query("
                    SELECT c.* FROM {$table_prefix}_comments as c 
                    LEFT JOIN {$table_prefix}_bans AS b 
                    ON b.ip = c.ip
                    WHERE `postid` = '{$postid}'
                    AND b.ip IS NULL
               ");
        
        return (int)$query;
    }
    
    public static function load_more_comments() {
        
        $data = self::REQUEST("gallerix2commentdata", "POST", false);
        
        if (!$data || empty($data)) {
         
            $result = array(
                "status" => "error",
                "error"  => "No data found"
            );
            return json_encode($result);
        }
        
        $postid  = $data["postid"] ? (int)$data["postid"] : 0;
        $offset  = $data["offset"] ? (int)$data["offset"] : 0;
        $replyto = 0;
        
        $options  = self::get_options();
        $comments = self::front_get_comments($postid, $replyto, $offset);
        
        ob_start();
        
        include(self::$__DIR__ . DS . "site" . DS . "view" . DS . "comments_loop.php");
        
        $content = ob_get_clean();

        $result = array(
            "status" => "ok",
            "content" => "{$content}"
        );
        
        echo json_encode($result);
    }
    
    public static function is_user_banned() {
         global $wpdb;
         $table_prefix = self::table_prefix();
         $ip    = $_SERVER['REMOTE_ADDR'];
         $query = $wpdb->query("SELECT * FROM {$table_prefix}_bans WHERE `ip` = '{$ip}' ");
         return $query > 0 ? true : false;
    }
    
    public static function unban_user($all = false) {
        global $wpdb;
        $table_prefix = self::table_prefix();
        
        if ($all === TRUE) {
            $query = $wpdb->query("DELETE FROM {$table_prefix}_bans");
        } else {
            $id = (int) self::REQUEST("id");
            if ($id <= 0) return new WP_Error("broke", "Unable to delete non-existent user id!");
            $query = $wpdb->query(
                $wpdb->prepare(
                "
                    DELETE FROM {$table_prefix}_bans
                    WHERE `id` = %d
                ", $id
                )
            );
        }
        
        if ($query === false) {
            $wpdb->show_errors();
            return new WP_Error("broke", "SQL Error: " . $wpdb->last_error);
        }
    }
    
    public static function get_bans() {
        global $wpdb;
        $table_prefix = self::table_prefix();

        $bans = $wpdb->get_results("SELECT * FROM {$table_prefix}_bans");

        return $bans ? $bans : array();
    }

    public static function ban_user() {
        global $wpdb;
        $table_prefix = self::table_prefix();

        $ip = self::REQUEST("ip");
        if (!$ip) return new WP_Error("broke", "No IP address provided!");
        
        $query = $wpdb->insert(
             "{$table_prefix}_bans", 
             array(
                 "ip"         => "{$ip}"
             ),
             array(
                 "%s"
             )
         );
        
        if ($query === false) {
            $wpdb->show_errors();
            return new WP_Error("broke", "SQL Error: " . $wpdb->last_error);
        }
    }
    
    public static function delete_comment($all = false) {
        global $wpdb;
        $table_prefix = self::table_prefix();
        
        if ($all === TRUE) {
            $query = $wpdb->query("DELETE FROM {$table_prefix}_comments");
        } else {
            $id = (int) self::REQUEST("id");
            if ($id <= 0) return new WP_Error("broke", "Unable to delete non-existent comment!");
            $query = $wpdb->query(
                $wpdb->prepare(
                "
                    DELETE FROM {$table_prefix}_comments
                    WHERE `id` = %d
                ", $id
                )
            );
        }
        
        if ($query === false) {
            $wpdb->show_errors();
            return new WP_Error("broke", "SQL Error: " . $wpdb->last_error);
        }
    }
    
    public static function edit_comment() {
        global $wpdb;
        $table_prefix = self::table_prefix();
        
        $name     = self::REQUEST("name","post", false);
        $comment  = self::REQUEST("comment","post", false);
        $update   = self::REQUEST("update","post", false);
        
        if (!$name) return new WP_Error("broke", "Author must have name!");
        if (!$comment) return new WP_Error("broke", "Comment cannot be empty!");
        if (!$update) return new WP_Error("broke", "Comment id is missing!");
        
        $id = (int) $update;
        
        $query = $wpdb->update(
            "{$table_prefix}_comments", array(
            "name" => "{$name}",
            "comment" => "{$comment}",
            ),
            array('id' => $id),
            array(
                '%s',
                '%s'
            )
        );
        
        if ($query === false) :
            $wpdb->show_errors();
            return new WP_Error("broke", "SQL Error: ". $wpdb->last_error);
        endif;
        
    }
    
    public static function get_comment($id = null) {
        $id = (int)self::REQUEST("id");
        if ($id <= 0) return false;
        global $wpdb;
        $table_prefix = self::table_prefix();
        $comment = $wpdb->get_results("SELECT * FROM {$table_prefix}_comments WHERE id = {$id}");
        return !empty($comment) ? $comment[0] : false;
    }
    
    public static function get_comments_pagination() {
        global $wpdb;
        $table_prefix = self::table_prefix();
        global $plugin_page;
        $perpage = 10;

        $comments = $wpdb->query(" 
                SELECT c.* FROM {$table_prefix}_comments as c
                LEFT JOIN {$table_prefix}_bans AS b 
                ON b.ip = c.ip
                WHERE b.ip IS NULL
        ");

        $pages = max(ceil($comments / $perpage), 0);
        
        $cpage = max(self::REQUEST("paged"),1);
        
        if ($pages <= 1) return;
        
        ob_start();
        for ($page = 1; $page <= $pages; $page++) {
            $k = $cpage == $page ? "active" : "";
            $href = "?page=$plugin_page&paged=$page";
            echo "<li class='$k'><a href='$href'>$page</a></li>";
        }
        return ob_get_clean();
    }
    
    public static function get_comments() {
        global $wpdb;
        $table_prefix = self::table_prefix();
        
        $perpage = 10;
        $page    = max(self::REQUEST("paged") - 1, 0);
        $offset  = $page * $perpage;
        
        $comments = $wpdb->get_results(" 
                SELECT c.* FROM {$table_prefix}_comments as c
                LEFT JOIN {$table_prefix}_bans AS b 
                ON b.ip = c.ip
                WHERE b.ip IS NULL
                ORDER BY `date` desc LIMIT {$offset}, {$perpage}
        ");
        
        return $comments ? $comments : array();
    }
    
    public static function front_get_comments($postid = false, $replyto = 0, $offset = 0) {
        if (!$postid) return array();
        self::$comments = array();
        self::query_comments($postid, $replyto, $offset);
        return !is_array(self::$comments) ? array() : self::$comments;
    }
    
    
    private static function query_comments($postid = false, $replyto = 0, $offset = 0) {
        
        if (!$postid) return array();
        
        global $wpdb;
        $table_prefix = self::table_prefix();
        
        $options = self::get_options();
        
        $limit        = "";
        $perload      = (int)$options->commentsperload;
        
        if ($replyto == 0) {
            
            /*
             * Root comments has limit
             */
            
            $limit = "LIMIT {$perload} OFFSET {$offset}";
        }
        
        $comments = $wpdb->get_results(" 
                    SELECT c.* FROM {$table_prefix}_comments as c
                    
                    LEFT JOIN {$table_prefix}_bans AS b 
                    ON b.ip = c.ip

                    WHERE `postid` = '{$postid}' 
                    AND `replyto` = '{$replyto}'
                    AND b.ip IS NULL
                    ORDER BY `date` desc {$limit}");
                    
        if ($comments) {
            foreach ($comments as $comment) {
                self::$comments[] = $comment;
                self::query_comments($postid, $comment->id);
            }
        } 
    }
    
    public static function send_comment() {
        
        if (self::is_user_banned()) {
            $result = array(
                "status" => "error",
                "error" => "User is banned"
            );
            return json_encode($result);
        }

        $options = Gallerix2::get_options();
        if (($options->commentsrequireuser == "1" && !is_user_logged_in())) {
            $result = array(
                "status" => "error",
                "error"  => "You must be registered user to post comments"
            );
            return json_encode($result);
        }  
        

        $data = self::REQUEST("gallerix2commentdata", "POST", false);
        
        if (!$data || empty($data)) {
            
            $result = array(
                "status" => "error",
                "error"  => "No comment found"
            );
            
            return json_encode($result);
                
        }
        
        $valid = true;

        $postid   = (int)$data["postid"];
        $replyto  = (int)$data["replyto"];
        $name     = $data["name"];
        $email    = $data["email"];
        $website  = $data["website"];
        $comment  = $data["comment"];
        $ip       = $_SERVER['REMOTE_ADDR'];

        if (is_user_logged_in()) {

            $cuser    = wp_get_current_user();
            $name     = $cuser->display_name;
            $email    = $cuser->user_email;
            $website  = $cuser->user_url;

            if (trim($comment) == "") {
                $valid = false;
            }

        } else {

            if (trim($name) == "") {
                $valid = false;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $valid = false;
            }

            if ($website != "" && !filter_var($website, FILTER_VALIDATE_URL)) {
                $valid = false;
            }

            if (trim($comment) == "") {
                $valid = false;
            }

        }

        if ($valid === true) {

            global $wpdb;
            $table_prefix = self::table_prefix();

             $query = $wpdb->insert(

                "{$table_prefix}_comments", 

                array(

                    "postid"     => "{$postid}",
                    "replyto"    => "{$replyto}",
                    "name"       => "{$name}",
                    "email"      => "{$email}",
                    "website"    => "{$website}",
                    "comment"    => "{$comment}",
                    "ip"         => "{$ip}"
                ),

                array(
                    "%d",
                    "%d",
                    "%s",
                    "%s",
                    "%s",
                    "%s",
                    "%s"
                )
            );

            if ($query === false) {

                $wpdb->show_errors();
                //$err = new WP_Error("broke", "SQL Error: " . $wpdb->last_error);

                $err = "Unable to send comment";

                $result = array(
                    "status" => "error",
                    "error"  => "{$err}"
                );

            } else {
                ob_start();

                $commentid = (int)$wpdb->insert_id;
                $level     = $replyto != "0" ? "gallerix2-post-comment-level-1" : "";

                ?>

                <li data-gallerix2-comment-id="<?php echo $commentid; ?>" class="gallerix2-post-comment <?php echo $level; ?>">
                    <div class="gallerix2-post-comment-icon">
                        <?php
                            echo get_avatar( $email, 50 );
                        ?>
                    </div>
                    <div class="gallerix2-post-comment-info">
                        <div class="gallerix2-post-comment-author"><?php echo $name; ?></div>
                        <div class="gallerix2-post-comment-date">Just Now</div>
                    </div>
                    <div class="gallerix2-post-comment-text">
                        <?php echo nl2br(htmlspecialchars($comment));  ?>
                    </div>
                    <a href="#" class="galleri2-post-comment-reply">Reply to this post</a>
                </li>

                <?php

                $content = ob_get_clean();

                $result = array(
                    "status" => "ok",
                    "postid" => "{$postid}",
                    "replyto" => "{$replyto}",
                    "content" => "{$content}"
                );
            }

            echo json_encode($result);
        }
    }
    
    public static function post_viewed() {
        
         $data = self::REQUEST("gallerix2postdata", "POST", false);
         
         if (!$data || empty($data)) {
            $result = array(
                "status" => "error",
                "error"  => "No data found"
            );
            return json_encode($result);
        }
        
        $postid = (int)$data["postid"];
        
        if (!isset($_COOKIE["gallerix2-post-id-" . $postid . "-viewed"])) {
            setcookie("gallerix2-post-id-" . $postid . "-viewed", 1, time() + (1 * 365 * 24 * 60 * 60), "/");

            global $wpdb;
            $table_prefix = self::table_prefix();
            
            $query = $wpdb->query("UPDATE {$table_prefix}_posts SET `views` = `views`+1 WHERE `id` = {$postid}");
            
            if ($query === false) {

                $wpdb->show_errors();
                //$err = new WP_Error("broke", "SQL Error: " . $wpdb->last_error);

                $err = "Unable to update post views";

                $result = array(
                    "status" => "error",
                    "error" => "{$err}"
                );
            }
        }
    }
    
    public static function post_liked() {
         $data = self::REQUEST("gallerix2postdata", "POST", false);
         
         if (!$data || empty($data)) {
            $result = array(
                "status" => "error",
                "error"  => "No data found"
            );
            return json_encode($result);
        }
        
        $postid = (int)$data["postid"];
        
        if (!isset($_COOKIE["gallerix2-post-id-" . $postid . "-liked"])) {
            setcookie("gallerix2-post-id-" . $postid . "-liked", 1, time() + (4 * 365 * 24 * 60 * 60), "/");

            global $wpdb;
            $table_prefix = self::table_prefix();
            
            $query = $wpdb->query("UPDATE {$table_prefix}_posts SET `likes` = `likes`+1 WHERE `id` = {$postid}");
            
            if ($query === false) {

                $wpdb->show_errors();
                //$err = new WP_Error("broke", "SQL Error: " . $wpdb->last_error);

                $err = "Unable to update post likes";

                $result = array(
                    "status" => "error",
                    "error" => "{$err}"
                );
            }
        } else {
            $result = array(
                "status" => "error",
                "error"  => "Already liked"
            );
            return json_encode($result);
        }
    }
    
    public static function get_google_fonts() {
        if (!self::$google_fonts) {
            $file = file_get_contents(self::$__DIR__ . DS . "admin" . DS . "fonts" . DS . "google.fonts.json");
            $json = json_decode($file);
            $fonts = $json->items;
            self::$google_fonts = array();

            // Add default
            self::$google_fonts["default"] = __("Use Default", "gallerix2");

            foreach ($fonts as $font) {
                $key = $font->family;
                self::$google_fonts[$key] = $key;
                
                $variants = $font->variants;
                
                foreach ($variants as $var) {
                    if ($var != "regular") {
                        $key = $font->family . ":" . $var;
                        self::$google_fonts[$key] = $key;
                    }
                }
            }
        }

        return self::$google_fonts;
    }
    
    public static function font_to_css($font) {
        $font = explode(":", $font);
        if ($font[0] == "default") return;
        
        ob_start();
        
        echo "font-family: $font[0];";
        
        if (isset($font[1])) {
            $weight = preg_replace('/[a-zA-Z]/', '', $font[1] );
            $style  = preg_replace('/[0-9]/', '', $font[1] );
            if ($weight != "" ) echo "font-weight:$weight;";
            if ($style != ""  ) echo "font-style:$style;";
        }
        
        echo "\n\r";
        
        return ob_get_clean();
    }
    
    public static function get_options() {
        
        $prefix = self::$TB_PREFIX; 
        
        $options = (object) array(
            
            "titlecolor"                    => get_option($prefix."titlecolor","#999999"),
            "catpostwrapperbgcolor"         => get_option($prefix."catpostwrapperbgcolor","#ffffff"),
            "catpostwrappershadowcolor"     => get_option($prefix."catpostwrappershadowcolor","#000000"),
            "cattitlecolor"                 => get_option($prefix."cattitlecolor","#666666"),
            "posttitlecolor"                => get_option($prefix."posttitlecolor","#333333"),
            "postdesccolor"                 => get_option($prefix."postdesccolor","#666666"),
            "postdesccommentscolor"         => get_option($prefix."postdesccommentscolor","#666666"),
            "postdesclikescolor"            => get_option($prefix."postdesclikescolor","#666666"),
            "postdescviewscolor"            => get_option($prefix."postdescviewscolor","#666666"),
            "postdesccommentsiconcolor"     => get_option($prefix."postdesccommentsiconcolor","#666666"),
            "postdesclikesiconcolor"        => get_option($prefix."postdesclikesiconcolor","#666666"),
            "postdescviewsiconcolor"        => get_option($prefix."postdescviewsiconcolor","#666666"),
            
            "navigationbuttonscolor"        => get_option($prefix."navigationbuttonscolor","#999999"),
            "navigationbuttonscolorhover"   => get_option($prefix."navigationbuttonscolorhover","#000000"),
            
            "blackboxcolor"                 => get_option($prefix . "blackboxcolor", "#363636"),
            "lightboxbgcolor"               => get_option($prefix . "lightboxbgcolor", "#ffffff"),
            "lightboxleftnavbgcolor"        => get_option($prefix . "lightboxleftnavbgcolor", "#252525"),
            "lightboxshadowcolor"           => get_option($prefix . "lightboxshadowcolor", "#000000"),
            "lightboxtitlecolor"            => get_option($prefix . "lightboxtitlecolor", "#000000"),
            "lightboxdesccolor"             => get_option($prefix . "lightboxdesccolor", "#a4a4a4"),
            "lightboxsharelinkscolor"       => get_option($prefix . "lightboxsharelinkscolor", "#6d6d6d"),
            "lightboxsharelinkscolorhover"  => get_option($prefix . "lightboxsharelinkscolorhover", "#ffffff"),
            "lightboxcommentsheadercolor"   => get_option($prefix . "lightboxcommentsheadercolor", "#000000"),
            "lightboxcommentsauthorcolor"   => get_option($prefix . "lightboxcommentsauthorcolor", "#3a3d42"),
            "lightboxcommentsdatecolor"     => get_option($prefix . "lightboxcommentsdatecolor", "#9e9e9e"),
            "lightboxcommentstextcolor"     => get_option($prefix . "lightboxcommentstextcolor", "#7b808c"),
            "lightboxcommentsreplycolor"      => get_option($prefix . "lightboxcommentsreplycolor", "#6cb6f5"),
            "lightboxcommentsreplycolorhover" => get_option($prefix . "lightboxcommentsreplycolorhover", "#6cb6f5"),
            "lightboxloadmorebgcolor"         => get_option($prefix . "lightboxloadmorebgcolor", "#b3b3b3"),
            "lightboxloadmorecolor"           => get_option($prefix . "lightboxloadmorecolor", "#ffffff"),
            "lightboxloadmorebgcolorhover"    => get_option($prefix . "lightboxloadmorebgcolorhover", "#ed303c"),
            "lightboxloadmorecolorhover"      => get_option($prefix . "lightboxloadmorecolorhover", "#ffffff"),
            "lightboxloadmoreborders"         => get_option($prefix . "lightboxloadmoreborders", "#dedfe3"),
            
            
            "lightboxcommentformheadercolor"              => get_option($prefix . "lightboxcommentformheadercolor", "#3a3d42"),
            "lightboxcommentforminputbgcolor"             => get_option($prefix . "lightboxcommentforminputbgcolor", "#ffffff"),
            "lightboxcommentforminputcolor"               => get_option($prefix . "lightboxcommentforminputcolor", "#a5a5a5"),
            "lightboxcommentforminputbordercolor"         => get_option($prefix . "lightboxcommentforminputbordercolor", "#e8e8e8"),
            "lightboxcommentformsubmitbuttonbgcolor"      => get_option($prefix . "lightboxcommentformsubmitbuttonbgcolor", "#ed303c"),
            "lightboxcommentformsubmitbuttoncolor"        => get_option($prefix . "lightboxcommentformsubmitbuttoncolor", "#ffffff"),
            "lightboxcommentformsubmitbuttonbgcolorhover" => get_option($prefix . "lightboxcommentformsubmitbuttonbgcolorhover", "#ed303c"),
            "lightboxcommentformsubmitbuttoncolorhover"   => get_option($prefix . "lightboxcommentformsubmitbuttoncolorhover", "#ffffff"),
            "lightboxcommentformcancelreplycolor"         => get_option($prefix . "lightboxcommentformcancelreplycolor", "#959595"),
            
            "lightboxnavigationcolor"                     => get_option($prefix . "lightboxnavigationcolor", "#ffffff"),
            "lightboxnavigationcolorhover"                => get_option($prefix . "lightboxnavigationcolorhover", "#ffffff"),
            
            "lightboxmedianavigationcolor"                     => get_option($prefix . "lightboxmedianavigationcolor", "#ffffff"),
            "lightboxmedianavigationcolorhover"                => get_option($prefix . "lightboxmedianavigationcolorhover", "#000000"),
            
            "lightboxlikebuttonbgcolor"                   => get_option($prefix . "lightboxlikebuttonbgcolor", "#59b647"),
            "lightboxlikebuttoncolor"                     => get_option($prefix . "lightboxlikebuttoncolor", "#ffffff"),
            "lightboxlikedbuttonbgcolor"                  => get_option($prefix . "lightboxlikedbuttonbgcolor", "#ed303c"),
            "lightboxlikedbuttoncolor"                    => get_option($prefix . "lightboxlikedbuttoncolor", "#ffffff"),
            
            
            "titlefont"        => get_option($prefix."titlefont","default"),
            "cattitlefont"     => get_option($prefix."cattitlefont","default"),
            "posttitlefont"    => get_option($prefix."posttitlefont","default"),
            "postdescfont"     => get_option($prefix."postdescfont","default"),
            "postcommentsfont" => get_option($prefix."postcommentsfont","default"),
            "postlikesfont"    => get_option($prefix."postlikesfont","default"),
            "postviewsfont"    => get_option($prefix."postviewsfont","default"),
            
            "lightboxtitlefont"                   => get_option($prefix."lightboxtitlefont", "default"),
            "lightboxdescfont"                    => get_option($prefix."lightboxdescfont", "default"),
            "lightboxsharelinksfont"              => get_option($prefix."lightboxsharelinksfont", "default"),
            "lightboxcommentsheaderfont"          => get_option($prefix."lightboxcommentsheaderfont", "default"),
            "lightboxcommentsauthorfont"          => get_option($prefix."lightboxcommentsauthorfont", "default"),
            "lightboxcommentsdatefont"            => get_option($prefix."lightboxcommentsdatefont", "default"),
            "lightboxcommentstextfont"            => get_option($prefix."lightboxcommentstextfont", "default"),
            "lightboxcommentsreplylinkfont"       => get_option($prefix."lightboxcommentsreplylinkfont", "default"),
            "lightboxcommentsloadmorefont"        => get_option($prefix."lightboxcommentsloadmorefont", "default"),
            "lightboxcommentformheaderfont"       => get_option($prefix."lightboxcommentformheaderfont", "default"),
            "lightboxcommentforminputfont"        => get_option($prefix."lightboxcommentforminputfont", "default"),
            "lightboxcommentformbuttonfont"       => get_option($prefix."lightboxcommentformbuttonfont", "default"),
            "lightboxcommentformcancelreplyfont"  => get_option($prefix."lightboxcommentformcancelreplyfont", "default"),
            
            "titlefontsize"        => get_option($prefix."titlefontsize","30px"),
            "cattitlefontsize"     => get_option($prefix."cattitlefontsize","14px"),
            "posttitlefontsize"    => get_option($prefix."posttitlefontsize","16px"),
            "postdescfontsize"     => get_option($prefix."postdescfontsize","12px"),
            "postcommentsfontsize" => get_option($prefix."postcommentsfontsize","14px"),
            "postlikesfontsize"    => get_option($prefix."postlikesfontsize","14px"),
            "postviewsfontsize"    => get_option($prefix."postviewsfontsize","14px"),
            
            "lightboxtitlefontsize"                   => get_option($prefix."lightboxtitlefontsize", "42px"),
            "lightboxdescfontsize"                    => get_option($prefix."lightboxdescfontsize", "18px"),
            "lightboxsharelinksfontsize"              => get_option($prefix."lightboxsharelinksfontsize", "24px"),
            "lightboxcommentsheaderfontsize"          => get_option($prefix."lightboxcommentsheaderfontsize", "16px"),
            "lightboxcommentsauthorfontsize"          => get_option($prefix."lightboxcommentsauthorfontsize", "14px"),
            "lightboxcommentsdatefontsize"            => get_option($prefix."lightboxcommentsdatefontsize", "10px"),
            "lightboxcommentstextfontsize"            => get_option($prefix."lightboxcommentstextfontsize", "14px"),
            "lightboxcommentsreplylinkfontsize"       => get_option($prefix."lightboxcommentsreplylinkfontsize", "12px"),
            "lightboxcommentsloadmorefontsize"        => get_option($prefix."lightboxcommentsloadmorefontsize", "12px"),
            "lightboxcommentformheaderfontsize"       => get_option($prefix."lightboxcommentformheaderfontsize", "16px"),
            "lightboxcommentforminputfontsize"        => get_option($prefix."lightboxcommentforminputfontsize", "12px"),
            "lightboxcommentformbuttonfontsize"       => get_option($prefix."lightboxcommentformbuttonfontsize", "12px"),
            "lightboxcommentformcancelreplyfontsize"  => get_option($prefix."lightboxcommentformcancelreplyfontsize", "12px"),
            
            "title"                => get_option($prefix."title", "Gallery"),
            "cat"                  => get_option($prefix."cat", "0"),
            "catperpage"           => get_option($prefix."catperpage", "8"),
            "postperpage"          => get_option($prefix."postperpage", "8"),
            "stitlelimit"          => get_option($prefix."stitlelimit",  "15"),
            "stextlimit"           => get_option($prefix."stextlimit",  "120"),
            "catwrappertype"       => get_option($prefix."catwrappertype",  "strict"),
            "catpostwrapper"       => get_option($prefix."catpostwrapper",  "1"),
            "swapanimation"        => get_option($prefix."swapanimation", "random"),
            "enablecomments"       => get_option($prefix."enablecomments", "1"),
            "commentsrequireuser"  => get_option($prefix."commentsrequireuser", "1"),
            "commentsperload"      => get_option($prefix."commentsperload", "5"),
            "rtnavigation"         => get_option($prefix."rtnavigation", "0"),
            "thumbwidth"           => get_option($prefix."thumbwidth", "285"),
            "thumbheight"          => get_option($prefix."thumbheight", "215"),
            "disqus"               => get_option($prefix."disqus", "0"),
            "disqussite"           => get_option($prefix."disqussite", ""),
        );
        
        return $options;
    }
    
    public static function save_options() {
        
        $prefix = self::$TB_PREFIX;
        
        update_option($prefix . "titlecolor", self::REQUEST("titlecolor", "POST", "#999999"));
        update_option($prefix . "catpostwrapperbgcolor", self::REQUEST("catpostwrapperbgcolor", "POST", "#ffffff"));
        update_option($prefix . "catpostwrappershadowcolor", self::REQUEST("catpostwrappershadowcolor", "POST", "#000000"));
        update_option($prefix . "cattitlecolor", self::REQUEST("cattitlecolor", "POST", "#666666"));
        update_option($prefix . "posttitlecolor", self::REQUEST("posttitlecolor", "POST", "#333333"));
        update_option($prefix . "postdesccolor", self::REQUEST("postdesccolor", "POST", "#666666"));
        update_option($prefix . "postdesccommentscolor", self::REQUEST("postdesccommentscolor", "POST", "#666666"));
        update_option($prefix . "postdesclikescolor", self::REQUEST("postdesclikescolor", "POST", "#666666"));
        update_option($prefix . "postdescviewscolor", self::REQUEST("postdescviewscolor", "POST", "#666666"));
        update_option($prefix . "postdesccommentsiconcolor", self::REQUEST("postdesccommentsiconcolor", "POST", "#666666"));
        update_option($prefix . "postdesclikesiconcolor", self::REQUEST("postdesclikesiconcolor", "POST", "#666666"));
        update_option($prefix . "postdescviewsiconcolor", self::REQUEST("postdescviewsiconcolor", "POST", "#666666"));

        update_option($prefix . "navigationbuttonscolor", self::REQUEST("navigationbuttonscolor", "POST", "#999999"));
        update_option($prefix . "navigationbuttonscolorhover", self::REQUEST("navigationbuttonscolorhover", "POST", "#000000"));

        update_option($prefix . "blackboxcolor", self::REQUEST("blackboxcolor", "POST", "#363636"));
        update_option($prefix . "lightboxbgcolor", self::REQUEST("lightboxbgcolor", "POST", "#ffffff"));
        update_option($prefix . "lightboxleftnavbgcolor", self::REQUEST("lightboxleftnavbgcolor", "POST", "#252525"));
        update_option($prefix . "lightboxshadowcolor", self::REQUEST("lightboxshadowcolor", "POST", "#000000"));
        update_option($prefix . "lightboxtitlecolor", self::REQUEST("lightboxtitlecolor", "POST", "#000000"));
        update_option($prefix . "lightboxdesccolor", self::REQUEST("lightboxdesccolor", "POST", "#a4a4a4"));
        update_option($prefix . "lightboxsharelinkscolor", self::REQUEST("lightboxsharelinkscolor", "POST", "#6d6d6d"));
        update_option($prefix . "lightboxsharelinkscolorhover", self::REQUEST("lightboxsharelinkscolorhover", "POST", "#ffffff"));
        update_option($prefix . "lightboxcommentsheadercolor", self::REQUEST("lightboxcommentsheadercolor", "POST", "#000000"));
        update_option($prefix . "lightboxcommentsauthorcolor", self::REQUEST("lightboxcommentsauthorcolor", "POST", "#3a3d42"));
        update_option($prefix . "lightboxcommentsdatecolor", self::REQUEST("lightboxcommentsdatecolor", "POST", "#9e9e9e"));
        update_option($prefix . "lightboxcommentstextcolor", self::REQUEST("lightboxcommentstextcolor", "POST", "#7b808c"));
        update_option($prefix . "lightboxcommentsreplycolor", self::REQUEST("lightboxcommentsreplycolor", "POST", "#6cb6f5"));
        update_option($prefix . "lightboxcommentsreplycolorhover", self::REQUEST("lightboxcommentsreplycolorhover", "POST", "#6cb6f5"));
        update_option($prefix . "lightboxloadmorebgcolor", self::REQUEST("lightboxloadmorebgcolor", "POST", "#b3b3b3"));
        update_option($prefix . "lightboxloadmorecolor", self::REQUEST("lightboxloadmorecolor", "POST", "#ffffff"));
        update_option($prefix . "lightboxloadmorebgcolorhover", self::REQUEST("lightboxloadmorebgcolorhover", "POST", "#ed303c"));
        update_option($prefix . "lightboxloadmorecolorhover", self::REQUEST("lightboxloadmorecolorhover", "POST", "#ffffff"));
        update_option($prefix . "lightboxloadmoreborders", self::REQUEST("lightboxloadmoreborders", "POST", "#dedfe3"));

        update_option($prefix . "lightboxcommentformheadercolor", self::REQUEST("lightboxcommentformheadercolor", "POST", "#3a3d42"));
        update_option($prefix . "lightboxcommentforminputbgcolor", self::REQUEST("lightboxcommentforminputbgcolor", "POST", "#ffffff"));
        update_option($prefix . "lightboxcommentforminputcolor", self::REQUEST("lightboxcommentforminputcolor", "POST", "#a5a5a5"));
        update_option($prefix . "lightboxcommentforminputbordercolor", self::REQUEST("lightboxcommentforminputbordercolor", "POST", "#e8e8e8"));
        update_option($prefix . "lightboxcommentformsubmitbuttonbgcolor", self::REQUEST("lightboxcommentformsubmitbuttonbgcolor", "POST", "#ed303c"));
        update_option($prefix . "lightboxcommentformsubmitbuttoncolor", self::REQUEST("lightboxcommentformsubmitbuttoncolor", "POST", "#ffffff"));
        update_option($prefix . "lightboxcommentformsubmitbuttonbgcolorhover", self::REQUEST("lightboxcommentformsubmitbuttonbgcolorhover", "POST", "#ed303c"));
        update_option($prefix . "lightboxcommentformsubmitbuttoncolorhover", self::REQUEST("lightboxcommentformsubmitbuttoncolorhover", "POST", "#ffffff"));
        update_option($prefix . "lightboxcommentformcancelreplycolor", self::REQUEST("lightboxcommentformcancelreplycolor", "POST", "#959595"));

        update_option($prefix . "lightboxnavigationcolor", self::REQUEST("lightboxnavigationcolor", "POST", "#ffffff"));
        update_option($prefix . "lightboxnavigationcolorhover", self::REQUEST("lightboxnavigationcolorhover", "POST", "#ffffff"));

        update_option($prefix . "lightboxmedianavigationcolor", self::REQUEST("lightboxmedianavigationcolor", "POST", "#ffffff"));
        update_option($prefix . "lightboxmedianavigationcolorhover", self::REQUEST("lightboxmedianavigationcolorhover", "POST", "#000000"));

        update_option($prefix . "lightboxlikebuttonbgcolor", self::REQUEST("lightboxlikebuttonbgcolor", "POST", "#59b647"));
        update_option($prefix . "lightboxlikebuttoncolor", self::REQUEST("lightboxlikebuttoncolor", "POST", "#ffffff"));
        update_option($prefix . "lightboxlikedbuttonbgcolor", self::REQUEST("lightboxlikedbuttonbgcolor", "POST", "#ed303c"));
        update_option($prefix . "lightboxlikedbuttoncolor", self::REQUEST("lightboxlikedbuttoncolor", "POST", "#ffffff"));

        update_option($prefix . "titlefont", self::REQUEST("titlefont", "POST", "default"));
        update_option($prefix . "cattitlefont", self::REQUEST("cattitlefont", "POST", "default"));
        update_option($prefix . "posttitlefont", self::REQUEST("posttitlefont", "POST", "default"));
        update_option($prefix . "postdescfont", self::REQUEST("postdescfont", "POST", "default"));
        update_option($prefix . "postcommentsfont", self::REQUEST("postcommentsfont", "POST", "default"));
        update_option($prefix . "postlikesfont", self::REQUEST("postlikesfont", "POST", "default"));
        update_option($prefix . "postviewsfont", self::REQUEST("postviewsfont", "POST", "default"));

        update_option($prefix . "lightboxtitlefont", self::REQUEST("lightboxtitlefont", "POST", "default"));
        update_option($prefix . "lightboxdescfont", self::REQUEST("lightboxdescfont", "POST", "default"));
        update_option($prefix . "lightboxsharelinksfont", self::REQUEST("lightboxsharelinksfont", "POST", "default"));
        update_option($prefix . "lightboxcommentsheaderfont", self::REQUEST("lightboxcommentsheaderfont", "POST", "default"));
        update_option($prefix . "lightboxcommentsauthorfont", self::REQUEST("lightboxcommentsauthorfont", "POST", "default"));
        update_option($prefix . "lightboxcommentsdatefont", self::REQUEST("lightboxcommentsdatefont", "POST", "default"));
        update_option($prefix . "lightboxcommentstextfont", self::REQUEST("lightboxcommentstextfont", "POST", "default"));
        update_option($prefix . "lightboxcommentsreplylinkfont", self::REQUEST("lightboxcommentsreplylinkfont", "POST", "default"));
        update_option($prefix . "lightboxcommentsloadmorefont", self::REQUEST("lightboxcommentsloadmorefont", "POST", "default"));
        update_option($prefix . "lightboxcommentformheaderfont", self::REQUEST("lightboxcommentformheaderfont", "POST", "default"));
        update_option($prefix . "lightboxcommentforminputfont", self::REQUEST("lightboxcommentforminputfont", "POST", "default"));
        update_option($prefix . "lightboxcommentformbuttonfont", self::REQUEST("lightboxcommentformbuttonfont", "POST", "default"));
        update_option($prefix . "lightboxcommentformcancelreplyfont", self::REQUEST("lightboxcommentformcancelreplyfont", "POST", "default"));

        update_option($prefix . "titlefontsize", self::REQUEST("titlefontsize", "POST", "30px"));
        update_option($prefix . "cattitlefontsize", self::REQUEST("cattitlefontsize", "POST", "14px"));
        update_option($prefix . "posttitlefontsize", self::REQUEST("posttitlefontsize", "POST", "16px"));
        update_option($prefix . "postdescfontsize", self::REQUEST("postdescfontsize", "POST", "12px"));
        update_option($prefix . "postcommentsfontsize", self::REQUEST("postcommentsfontsize", "POST", "14px"));
        update_option($prefix . "postlikesfontsize", self::REQUEST("postlikesfontsize", "POST", "14px"));
        update_option($prefix . "postviewsfontsize", self::REQUEST("postviewsfontsize", "POST", "14px"));

        update_option($prefix . "lightboxtitlefontsize", self::REQUEST("lightboxtitlefontsize", "POST", "42px"));
        update_option($prefix . "lightboxdescfontsize", self::REQUEST("lightboxdescfontsize", "POST", "18px"));
        update_option($prefix . "lightboxsharelinksfontsize", self::REQUEST("lightboxsharelinksfontsize", "POST", "24px"));
        update_option($prefix . "lightboxcommentsheaderfontsize", self::REQUEST("lightboxcommentsheaderfontsize", "POST", "16px"));
        update_option($prefix . "lightboxcommentsauthorfontsize", self::REQUEST("lightboxcommentsauthorfontsize", "POST", "14px"));
        update_option($prefix . "lightboxcommentsdatefontsize", self::REQUEST("lightboxcommentsdatefontsize", "POST", "10px"));
        update_option($prefix . "lightboxcommentstextfontsize", self::REQUEST("lightboxcommentstextfontsize", "POST", "14px"));
        update_option($prefix . "lightboxcommentsreplylinkfontsize", self::REQUEST("lightboxcommentsreplylinkfontsize", "POST", "12px"));
        update_option($prefix . "lightboxcommentsloadmorefontsize", self::REQUEST("lightboxcommentsloadmorefontsize", "POST", "12px"));
        update_option($prefix . "lightboxcommentformheaderfontsize", self::REQUEST("lightboxcommentformheaderfontsize", "POST", "16px"));
        update_option($prefix . "lightboxcommentforminputfontsize", self::REQUEST("lightboxcommentforminputfontsize", "POST", "12px"));
        update_option($prefix . "lightboxcommentformbuttonfontsize", self::REQUEST("lightboxcommentformbuttonfontsize", "POST", "12px"));
        update_option($prefix . "lightboxcommentformcancelreplyfontsize", self::REQUEST("lightboxcommentformcancelreplyfontsize", "POST", "12px"));

        update_option($prefix . "title", self::REQUEST("title", "POST", "Gallery"));
        update_option($prefix . "cat", implode(",", self::REQUEST("cat", "POST", "0")));
        update_option($prefix . "catperpage", self::REQUEST("catperpage", "POST", "8"));
        update_option($prefix . "swapanimation", self::REQUEST("swapanimation", "POST", "random"));
        update_option($prefix . "postperpage", self::REQUEST("postperpage", "POST", "8"));
        update_option($prefix . "stitlelimit", self::REQUEST("stitlelimit", "POST", "15"));
        update_option($prefix . "stextlimit", self::REQUEST("stextlimit", "POST", "120"));
        update_option($prefix . "catwrappertype", self::REQUEST("catwrappertype", "POST", "strict"));
        update_option($prefix . "catpostwrapper", self::REQUEST("catpostwrapper", "POST", "1"));
        update_option($prefix . "enablecomments", self::REQUEST("enablecomments", "POST", "1"));
        update_option($prefix . "commentsrequireuser", self::REQUEST("commentsrequireuser", "POST", "1"));
        update_option($prefix . "commentsperload", self::REQUEST("commentsperload", "POST", "5"));
        update_option($prefix . "rtnavigation", self::REQUEST("rtnavigation", "POST", "0"));
        update_option($prefix . "thumbwidth", self::REQUEST("thumbwidth", "POST", "285"));
        update_option($prefix . "thumbheight", self::REQUEST("thumbheight", "POST", "215"));
        update_option($prefix . "disqus", self::REQUEST("disqus", "POST", "0"));
        update_option($prefix . "disqussite", self::REQUEST("disqussite", "POST", ""));
    }
    
    public static function reset_options() {
        
        $prefix = self::$TB_PREFIX;
        
        delete_option($prefix . "titlecolor");
        delete_option($prefix . "catpostwrapperbgcolor");
        delete_option($prefix . "catpostwrappershadowcolor");
        delete_option($prefix . "cattitlecolor");
        delete_option($prefix . "posttitlecolor");
        delete_option($prefix . "postdesccolor");
        delete_option($prefix . "postdesccommentscolor");
        delete_option($prefix . "postdesclikescolor");
        delete_option($prefix . "postdescviewscolor");
        delete_option($prefix . "postdesccommentsiconcolor");
        delete_option($prefix . "postdesclikesiconcolor");
        delete_option($prefix . "postdescviewsiconcolor");
        
        delete_option($prefix."navigationbuttonscolor");
        delete_option($prefix."navigationbuttonscolorhover");
        
        delete_option($prefix."blackboxcolor");
        delete_option($prefix."lightboxbgcolor");
        delete_option($prefix."lightboxleftnavbgcolor");
        delete_option($prefix."lightboxshadowcolor");
        delete_option($prefix."lightboxtitlecolor");
        delete_option($prefix."lightboxdesccolor");
        delete_option($prefix."lightboxsharelinkscolor");
        delete_option($prefix."lightboxsharelinkscolorhover");
        delete_option($prefix."lightboxcommentsheadercolor");
        delete_option($prefix."lightboxcommentsauthorcolor");
        delete_option($prefix."lightboxcommentsdatecolor");
        delete_option($prefix."lightboxcommentstextcolor");
        delete_option($prefix."lightboxcommentsreplycolor");
        delete_option($prefix."lightboxcommentsreplycolorhover");
        delete_option($prefix."lightboxloadmorebgcolor");
        delete_option($prefix."lightboxloadmorecolor");
        delete_option($prefix."lightboxloadmorebgcolorhover");
        delete_option($prefix."lightboxloadmorecolorhover");
        delete_option($prefix."lightboxloadmoreborders");
        
        delete_option($prefix."lightboxcommentformheadercolor");
        delete_option($prefix."lightboxcommentforminputbgcolor");
        delete_option($prefix."lightboxcommentforminputcolor");
        delete_option($prefix."lightboxcommentforminputbordercolor");
        delete_option($prefix."lightboxcommentformsubmitbuttonbgcolor");
        delete_option($prefix."lightboxcommentformsubmitbuttoncolor");
        delete_option($prefix."lightboxcommentformsubmitbuttonbgcolorhover");
        delete_option($prefix."lightboxcommentformsubmitbuttoncolorhover");
        delete_option($prefix."lightboxcommentformcancelreplycolor");
        
        delete_option($prefix."lightboxnavigationcolor");
        delete_option($prefix."lightboxnavigationcolorhover");
        
        delete_option($prefix."lightboxmedianavigationcolor");
        delete_option($prefix."lightboxmedianavigationcolorhover");
        
        delete_option($prefix."lightboxlikebuttonbgcolor");
        delete_option($prefix."lightboxlikebuttoncolor");
        delete_option($prefix."lightboxlikedbuttonbgcolor");
        delete_option($prefix."lightboxlikedbuttoncolor");
        
        delete_option($prefix."titlefont");
        delete_option($prefix."cattitlefont");
        delete_option($prefix."posttitlefont");
        delete_option($prefix."postdescfont");
        delete_option($prefix."postcommentsfont");
        delete_option($prefix."postlikesfont");
        delete_option($prefix."postviewsfont");
        
        delete_option($prefix."lightboxtitlefont");
        delete_option($prefix."lightboxdescfont");
        delete_option($prefix."lightboxsharelinksfont");
        delete_option($prefix."lightboxcommentsheaderfont");
        delete_option($prefix."lightboxcommentsauthorfont");
        delete_option($prefix."lightboxcommentsdatefont");
        delete_option($prefix."lightboxcommentstextfont");
        delete_option($prefix."lightboxcommentsreplylinkfont");
        delete_option($prefix."lightboxcommentsloadmorefont");
        delete_option($prefix."lightboxcommentformheaderfont");
        delete_option($prefix."lightboxcommentforminputfont");
        delete_option($prefix."lightboxcommentformbuttonfont");
        delete_option($prefix."lightboxcommentformcancelreplyfont");
        
        delete_option($prefix."titlefontsize");
        delete_option($prefix."cattitlefontsize");
        delete_option($prefix."posttitlefontsize");
        delete_option($prefix."postdescfontsize");
        delete_option($prefix."postcommentsfontsize");
        delete_option($prefix."postlikesfontsize");
        delete_option($prefix."postviewsfontsize");
        
        delete_option($prefix."lightboxtitlefontsize");
        delete_option($prefix."lightboxdescfontsize");
        delete_option($prefix."lightboxsharelinksfontsize");
        delete_option($prefix."lightboxcommentsheaderfontsize");
        delete_option($prefix."lightboxcommentsauthorfontsize");
        delete_option($prefix."lightboxcommentsdatefontsize");
        delete_option($prefix."lightboxcommentstextfontsize");
        delete_option($prefix."lightboxcommentsreplylinkfontsize");
        delete_option($prefix."lightboxcommentsloadmorefontsize");
        delete_option($prefix."lightboxcommentformheaderfontsize");
        delete_option($prefix."lightboxcommentforminputfontsize");
        delete_option($prefix."lightboxcommentformbuttonfontsize");
        delete_option($prefix."lightboxcommentformcancelreplyfontsize");
        
        delete_option($prefix . "title");
        delete_option($prefix . "cat");
        delete_option($prefix . "catperpage");
        delete_option($prefix . "postperpage");
        delete_option($prefix . "stitlelimit");
        delete_option($prefix . "stextlimit");
        delete_option($prefix . "catwrappertype");
        delete_option($prefix . "catpostwrapper");
        delete_option($prefix . "swapanimation");
        delete_option($prefix . "enablecomments");
        delete_option($prefix . "commentsrequireuser");
        delete_option($prefix . "commentsperload");
        delete_option($prefix . "rtnavigation");
        delete_option($prefix . "thumbwidth");
        delete_option($prefix . "thumbheight");
        delete_option($prefix . "disqus");
        delete_option($prefix . "disqussite");
    }
    
    public static function hex2rgba($color, $opacity = false) {

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if(empty($color))
          return $default; 

	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
    }
}