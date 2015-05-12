<?php

$view = isset($_REQUEST["view"]) ? $_REQUEST["view"] : null;
$task = isset($_REQUEST["task"]) ? $_REQUEST["task"] : null;

switch (strtolower($task)) :
    
    case "unbanall" : 
        $return = Gallerix2::unban_user(TRUE);
        if (is_wp_error($return))
        echo "<p class='error'>".$return->get_error_message()."</p>";
    break;
    
    case "unban" : 
        $return = Gallerix2::unban_user();
        if (is_wp_error($return))
        echo "<p class='error'>".$return->get_error_message()."</p>";
    break;
    
endswitch;


switch (strtolower($view)) :
    case "list" : default: require (dirname(__FILE__) . DS . "list.php");
endswitch;