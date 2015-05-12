<?php

$view = isset($_REQUEST["view"]) ? $_REQUEST["view"] : null;
$task = isset($_REQUEST["task"]) ? $_REQUEST["task"] : null;

switch (strtolower($task)) :
    case "ban" : 
        $return = Gallerix2::ban_user();
        if (is_wp_error($return))
        echo "<p class='error'>".$return->get_error_message()."</p>";
    break;
    
    case "edit" : 
        $return = Gallerix2::edit_comment();
        if (is_wp_error($return))
        echo "<p class='error'>".$return->get_error_message()."</p>";
    break;
    
    case "delete" : 
        $return = Gallerix2::delete_comment();
        if (is_wp_error($return))
        echo "<p class='error'>".$return->get_error_message()."</p>";
    break;
    
    case "deleteall" : 
        $return = Gallerix2::delete_comment(TRUE);
        if (is_wp_error($return))
        echo "<p class='error'>".$return->get_error_message()."</p>";
    break;
endswitch;


switch (strtolower($view)) :
    case "edit" : 
        require (dirname(__FILE__) . DS . "edit.php");
    break;

    case "list" : default: require (dirname(__FILE__) . DS . "list.php");
endswitch;