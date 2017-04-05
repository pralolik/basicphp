<?php

function showDirectoryTree($folder, $indent, $transferSymbol, $indentSymbol)
{
    if ($files = scandir($folder)) {
        foreach ($files as $file) {
            if (($file == '.') || ($file == '..')) {
                continue;
            }
            $path = $folder . '/' . $file;
            $resultString = $indent . $file . $transferSymbol;
            if (is_readable($path)) {
                if (is_dir($path)) {
                    echo $resultString;
                    if (realpath($path) == realpath(__DIR__)) {
                        continue;
                    }
                    showDirectoryTree(
                        $path,
                        $indent . $indentSymbol,
                        $transferSymbol,
                        $indentSymbol
                    );
                } else {
                    echo $resultString;
                }
            }
        }
    }
}

$sapi = php_sapi_name();
if ($sapi == 'cli') {
    showDirectoryTree('./', '', "\n", '-');
} else {
    showDirectoryTree('./', '', '<br>', '&nbsp;&nbsp;');
}
