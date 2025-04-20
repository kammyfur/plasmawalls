<?php

// Set this to true to display errors (INSECURE)
$debug = false;

function pw_errors() {
    global $debug;

    if ($debug) {
        return false;
    } else {
        return true;
    }
}

set_error_handler("pw_errors");
