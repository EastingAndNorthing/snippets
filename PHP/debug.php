<?php

// George Dimitriadis, 2017

function dbg($input) {
    echo "<pre>";
    var_export($input);
    echo "</pre>";
}


function dd() {
    $trace = debug_backtrace();
    // Creating a dummy ini setting and parsing it is partially a hack, check if you can do this better
    // I did a fast check with filter_var() but it doesn't treat the integer '2' as true, TODO: dig further
    $xdebug = !empty(parse_ini_string('xdebug.overload_var_dump=' . ini_get('xdebug.overload_var_dump'))['xdebug.overload_var_dump']);
    if($xdebug) {
        // get rid of xdebug top margin the hacky way (Or maybe add a CSS rule somewhere else)
        echo '<small style="margin-bottom: -1em; display: block;">';
    } else {
        echo '<small>';
    }
    // Maybe it would be nice to add the whole backtrace here instead of only last file
    highlight_string($trace[0]['file'] . ':' . $trace[0]['line'] . ':' . PHP_EOL);
    echo '</small>';
    if($xdebug) {
        ini_set("xdebug.overload_var_dump", "1"); // This omit the triggering line
        ini_set('xdebug.var_display_max_depth', 20);
        ini_set('xdebug.var_display_max_children', 10);
        ini_set('xdebug.var_display_max_data', 1024);
    }

    $args = func_get_args();
    foreach ($args as $arg) {
        if($xdebug) {
            var_dump($arg);
        } else {
            highlight_string("<?php\n" . var_export($arg, true) . "\n?>");
        }
    }

    die();
}