<?php

$task = isset($_REQUEST["task"]) ? $_REQUEST["task"] : null;

switch (strtolower($task)) :
    case "save" : 
        $return = gallerix2::save_options();
        if (is_wp_error($return))
        echo "<p class='error'>".$return->get_error_message()."</p>";
    break;
    case "reset" : 
        $return = gallerix2::reset_options();
        if (is_wp_error($return))
        echo "<p class='error'>".$return->get_error_message()."</p>";
    break;
endswitch;

require (dirname(__FILE__) . DS . "options.php");