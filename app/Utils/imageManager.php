<?php

namespace App\Utils;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class imageManager
{
    public static function uploadImages($request, $post): void
    {
        if ($request->hasFile('images')) {

            $images = $request->file('images');

            foreach ($images as $image) {

                $filename = Str::uuid() . '_' . time() . '.' . $image->getClientOriginalExtension();

                $path = $image->storeAs('uploads/posts', $filename, 'uploads');

                $post->images()->create([
                    'path' => $path,
                ]);
            }
        }
    }

    public static function deleteImages($post): void
    {
        if ($post->images->count() > 0) {

            foreach ($post->images as $image) {

                $imagePath = public_path($image->path);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
        }
    }
}