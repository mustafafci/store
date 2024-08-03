<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait UploadImageTrait
{
    public function uploadImage($request, $disk, $folderName, $inputName, $imageable_type, $imageable_id)
    {
        if ($request->hasFile($inputName)) {

            if (is_array($request->file($inputName))) {
                foreach ($request->file($inputName) as $file) {
                    $this->saveImage($file, $disk, $folderName, $imageable_type, $imageable_id);
                }
                return true;
            }

            $this->saveImage($request->file($inputName), $disk, $folderName, $imageable_type, $imageable_id);
            return true;
        }
    }


    protected function saveImage($file, $disk, $folderName, $imageable_type, $imageable_id)
    {

        $filename = Str::slug($file->getClientOriginalName()) . '-' . time();
        $extension = $file->getClientOriginalExtension();
        $path = $filename . '.' . $extension;
        $url = $file->storeAs($folderName, $path, $disk);

        Image::create([
            'url' => $url,
            'imageable_id' => $imageable_id,
            'imageable_type' => $imageable_type,
        ]);
    }

    public function deleteImage($disk, $url, $imageable_id)
    {
        if (Storage::disk($disk)->exists($url)) {
            Storage::disk($disk)->delete($url);
        }

        Image::where('imageable_id', $imageable_id)->delete();
    }
}
