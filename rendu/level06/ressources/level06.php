#!/usr/bin/php
<?php
    function y($m) {
        $m = preg_replace("/\./", "x", $m);
        $m = preg_replace("/@/", "y", $m);
        return $m;
    }
    function x($y, $z) {
        $a = file_get_contents($y);
        $a = preg_replace("/(\[x (.*)\])/e", "y(\"\\2\")", $a);
        $a = preg_replace("/\[/", "(", $a);
        $a = preg_replace("/\]/", ")", $a);
        return $a;
    }
    $r = x($argv[1], $argc[2]);
    print $r;
?>

/* So if ever we want to protect a php code like this to avoid that
someone try to inject something in it, is possible to modify it like
this or in a similar way :

#!/usr/bin/php
<?php

if ($argc < 2) {
    fwrite(STDERR, "Usage: php {$argv[0]} <input_file>\n");
    exit(1);
}

$inputPath = $argv[1];

if (!file_exists($inputPath) || !is_readable($inputPath)) {
    fwrite(STDERR, "Error: file not found or not readable: $inputPath\n");
    exit(2);
}

function y($m) {
    $m = preg_replace("/\./", "x", $m);
    $m = preg_replace("/@/", "y", $m);
    return $m;
}

function x($filename) {
    $a = @file_get_contents($filename);
    if ($a === false) {
        return "";
    }

    $a = preg_replace_callback(
        '/(\[x (.*?)\])/s',          // non-greedy capture of the inner text
        function ($m) {
            $inner = $m[2];

            if (!preg_match('/\A[a-zA-Z0-9 .@_-]{0,200}\z/', $inner)) {
                return '[x INVALID_INPUT]';
            }

            return y($inner);
        },
        $a
    );

    $a = str_replace('[', '(', $a);
    $a = str_replace(']', ')', $a);

    return $a;
}

$r = x($inputPath);
print $r;
?>

*/