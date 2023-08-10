<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class ReadGallery
{
    public static function read()
    {
        $directory_path = "storage/" . config("lfm.folder_categories.file.folder_name") . "/" . config("lfm.shared_folder_name");
        if (!is_dir(public_path($directory_path))) {
            return [];
        }
        $storage_path = public_path($directory_path);
        $asset_path =  asset($directory_path);
        $listFile = array_map(
            function ($item) use ($asset_path) {
                return $asset_path . "/" . $item;
            },
            array_filter(
                array_diff(scandir($storage_path, SCANDIR_SORT_DESCENDING), array('.', '..')),
                function ($file) use ($storage_path) {
                    return !is_dir($storage_path . "/$file");
                }
            )
        );
        return $listFile;
    }
}
