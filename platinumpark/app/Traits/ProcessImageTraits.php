<?php

namespace App\Traits;

use App\Banner;
use App\Images;
use App\OutletImage;
use App\ServiceImage;
use App\BannerImages;
use App\MobileAppBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Description of UploadImageTraits
 *
 * @author ETC
 */
trait ProcessImageTraits
{

    private function uploadImage($file, Request $request, $type, $banner_id, $others = [])
    {

        $extensions = config("files.images.extensions.allow");

        $file_orginal_name = strtolower($file->getClientOriginalName());
        $file_extension = strtolower($file->getClientOriginalExtension());
        
        if (!in_array($file_extension, $extensions)) {
            return 'Invalid file format';
        }

        $size = config("files.images.size");
        $file_new_size = $file->getSize() / $size;

        if ($file_new_size > $size) {
            return 'Invalid file size';
        }

        $destination_path = app()->make('path.public') . "/uploads/" . $type;
        $file_new_name = $type . '_' . rand(1111111, 9999999) . date("Ymdhis") . '.' . $file_extension;
        $upload_success = $file->move($destination_path, $file_new_name);

        if ($upload_success) {
        } else {
            return 'Upload error';
        }

        $record = null;
        $max_sequence = 0;
        // dd($max_sequence);
        switch ($type) {
            case "banner":
                $record = new BannerImages();
                $max_sequence = BannerImages::where('banner_id', $banner_id)->max('sequence');
                break;
        }

        $image_sequence = (empty($max_sequence)) ? 1 : $max_sequence + 1;
        
        if (!is_null($record)) {
            $record->banner_id = $banner_id;
            $record->image = "uploads/$type/" . $file_new_name;
            $record->sequence = $image_sequence;
            // $record->created_by = Auth::user()->id;
            $record->save();
        }
    }

    private function unlinkImage($record, $type)
    {
        $file = public_path('uploads/' . $type . '/' . basename($record->url ?? $record->image_path));

        if (file_exists($file)) {
            $delete_file = unlink($file);

            if (!$delete_file) {
                return response()->json(['success' => false, 'message' => 'Error deleting file']);
            }
        }
    }

    private function responseJson($msg, $code = 400)
    {
        return response()->json($msg, $code);
    }
}
