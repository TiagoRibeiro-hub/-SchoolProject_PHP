<?php
session_start();

//removeFolder('setupcopy');
session_unset();
session_destroy();
header("location: ../../Raizes.Artezanato/home.php");

function removeFolder($folder)
{

    if (is_dir($folder) === true) {

        $folderContent = scandir($folder); //  List files and directories 
        unset($folderContent[0], $folderContent[1]); // standard[0,1]

        foreach ($folderContent as $content => $contentName) {
            $curentPath = $folder . '/' . $contentName;
            $filetype = filetype($curentPath);
            // remove os ficheiros dentro da pasta
            if ($filetype == 'dir') {
                removeFolder($curentPath);
            } else {
                unlink($curentPath);
            }
            unset($folderContent[$content]);
        }
        rmdir($folder);
    }
}
