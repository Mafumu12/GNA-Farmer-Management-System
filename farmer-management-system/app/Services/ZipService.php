<?php
namespace App\Services;
use ZipArchive;

class ZipService
{


    public function extractZip($zipPath, $extractTo)
    {
        $zip = new ZipArchive();

        if ($zip->open($zipPath) === true) {
            $zip->extractTo($extractTo);
            $zip->close();
            return true;
        }

        return false;
    }

}