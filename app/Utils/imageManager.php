<?php

namespace App\Utils;

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
}