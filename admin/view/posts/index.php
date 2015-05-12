<?php

$view = isset($_REQUEST["view"]) ? $_REQUEST["view"] : null;
$task = isset($_REQUEST["task"]) ? $_REQUEST["task"] : null;

switch (strtolower($task)) :
    case "create" : 
        $return = Gallerix2::create_post();
        if (is_wp_error($return))
        echo "<p class='error'>".$return->get_error_message()."</p>";
    break;
    
    case "delete" : 
        $return = Gallerix2::delete_post();
        if (is_wp_error($return))
        echo "<p class='error'>".$return->get_error_message()."</p>";
    break;
    
    case "updateorder" : 
        $return = Gallerix2::order_posts();
        if (is_wp_error($return))
        echo "<p class='error'>".$return->get_error_message()."</p>";
    break;
    
endswitch;


switch (strtolower($view)) :
    case "addedit" : 
        require (dirname(__FILE__) . DS . "addedit.php");
    break;

    case "list" : default: require (dirname(__FILE__) . DS . "list.php");
endswitch;