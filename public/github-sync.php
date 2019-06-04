<?php

`git pull https://hess3077:T3R2GAvp@github.com/fodekar/seo_tools/`; // On lance la synchronisation du serveur de PROD avec le serveur Github

function rrmdir($src)
{
    if (is_dir($src)) {
        $dir = opendir($src);

        while (false !== ($file = readdir($dir))) {
            if (('.' != $file) && ('..' != $file)) {
                $full = $src.'/'.$file;
                if (is_dir($full)) {
                    rrmdir($full);
                } else {
                    if (file_exists($full)) {
                        unlink($full);
                    }
                }
            }
        }

        closedir($dir);
        rmdir($src);
    }
}

rrmdir('../var/cache/prod');
