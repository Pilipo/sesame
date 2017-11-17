<?php

if (php_sapi_name() !== 'cli') {
    fwrite(STDERR, "Please execute via PHP CLI.");
    die();
}