<?php

namespace App\Utils;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageManager
{
    public static function uploadImages($request, $post = null, $user = null): void
    {
        if ($request->hasFile('images')) {

            $images = $request->file('images');

            foreach ($images as $image) {

                $filename = self::generateImageName($image);
                $path = self::storeImageInLocal($image, 'posts', $filename);

                $post->images()->create([
                    'path' => $path,
                ]);
            }
        }
        // Upload a single image
        if ($request->hasFile('image')) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $old_image = $user->image;

                self::deleteImageFromLocal($old_image);

                $filename = self::generateImageName($image);
                $path = self::storeImageInLocal($image, 'users', $filename);

                $user->update([
                    'image' => $path
                ]);
            }
        }
    }

    public static function deleteImages($post): void
    {
        if ($post->images->count() > 0) {

            foreach ($post->images as $image) {
                self::deleteImageFromLocal($image->path);
                $image->delete();
            }
        }
    }

    public static function generateImageName($image): string
    {
        return $imageName = Str::uuid() . '_' . time() . '.' . $image->getClientOriginalExtension();
    }

    public static function storeImageInLocal($image, $path, $filename): string
    {
        $uploadPath = public_path('uploads/' . $path);
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }
        return $path = $image->storeAs('uploads/' . $path, $filename, 'uploads');
    }

    public static function deleteImageFromLocal($image_path): void
    {
        if (File::exists(public_path($image_path))) {
            File::delete(public_path($image_path));
        }
    }
}