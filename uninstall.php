<?php
defined("DS") ? NULL : define("DS", DIRECTORY_SEPARATOR);

require_once dirname(__FILE__) . DS . "admin" . DS . "class" . DS . "gallerix2.php";

Gallerix2::set_filename_path(__FILE__);

global $wpdb;

$table_prefix = Gallerix2::table_prefix();

$wpdb->query("DROP TABLE IF EXISTS ".$table_prefix."_categories");
$wpdb->query("DROP TABLE IF EXISTS ".$table_prefix."_posts");
$wpdb->query("DROP TABLE IF EXISTS ".$table_prefix."_comments");
$wpdb->query("DROP TABLE IF EXISTS ".$table_prefix."_bans");

gallerix2::reset_options();

delete_option($table_prefix."_db_version");