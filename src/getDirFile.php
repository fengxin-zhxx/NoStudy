<?php
function getFile(&$Dir) {
    if (is_dir($Dir)) {
        if (false != ($Handle = opendir($Dir))) {
            while (false != ($File = readdir($Handle))) {
                if ($File != '.' && $File != '..' && strpos($File, '.')) {
                    $FileArray[] = $File;
                }
            }
            closedir($Handle);
        }
    } else {
        $FileArray[] = '[Path]:\'' . $Dir . '\' is not a dir or not found!';
    }
    return $FileArray;
}
