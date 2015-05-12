<?php
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
global $wpdb;
$table_prefix = Gallerix2::table_prefix();

$table = $table_prefix . "_categories";

$sql = "CREATE TABLE $table (
       `id`       int(11)      NOT NULL AUTO_INCREMENT,
       `title`    varchar(300) NOT NULL,
       `thumb`    varchar(500) NOT NULL,
       `ordering` int(6)       NOT NULL,
        PRIMARY KEY (`id`)
) CHARSET=utf8;";

dbDelta($sql);
 
$table = $table_prefix . "_posts";

$sql = "CREATE TABLE $table (
       `id`        int(11)        NOT NULL AUTO_INCREMENT,
       `catid`     varchar(500)   NOT NULL,
       `title`     varchar(300)   NOT NULL,
       `thumb`     varchar(500)   NOT NULL,
       `image`     text           NOT NULL,
       `short`     varchar(500)   NOT NULL,
       `content`   text           NOT NULL,
       
       `likes`     int(6)         NOT NULL,
       `views`     int(6)         NOT NULL,

       `ordering`  int(6)        NOT NULL,
       
        PRIMARY KEY (`id`)
) CHARSET=utf8;";

dbDelta($sql);
 

$table = $table_prefix . "_comments";

$sql = "CREATE TABLE $table (
    
       `id`        int(11)        NOT NULL AUTO_INCREMENT,
       `postid`    int(11)        NOT NULL,
       `replyto`   int(11)        NOT NULL,
       `date`      timestamp      NOT NULL,
       `comment`   text           NOT NULL,
       `ip`        varchar(50)    NOT NULL,
       `name`      varchar(300)   NOT NULL,
       `website`   varchar(500)   NOT NULL,
       `email`     varchar(300)   NOT NULL,

        PRIMARY KEY (`id`)
) CHARSET=utf8;";

dbDelta($sql);
 

$table = $table_prefix . "_bans";

$sql = "CREATE TABLE $table (
       `id`        int(11)        NOT NULL AUTO_INCREMENT,
       `ip`        varchar(50)        NOT NULL,

        PRIMARY KEY (`id`)
) CHARSET=utf8;";

dbDelta($sql);

update_option($table_prefix."_db_version","1.4");