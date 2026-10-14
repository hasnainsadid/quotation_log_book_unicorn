<?php

use Illuminate\Support\Facades\Storage;

function imageUploadManager($image, $slug, $path)
{
    $path       = trim($path, '/'); // e.g., 'images'
    $extension  = $image->getClientOriginalExtension();
    $image_name = $slug . '_' . time() . '.' . $extension;

    // Store the file in storage/app/public/{path}/
    Storage::disk('public')->putFileAs($path, $image, $image_name);

    // Return the path relative to 'storage/app/public'
    return $path . '/' . $image_name;
}

function imageUpdateManager($image, $slug, $path, $old_image)
{
    $path      = trim($path, '/');
    $extension = $image->getClientOriginalExtension();
    $imageName = $slug . '_' . time() . '.' . $extension;

    // Store new image
    Storage::disk('public')->putFileAs($path, $image, $imageName);

    // Delete old image if exists and not default
    if ($old_image && $old_image !== 'default.png') {
        if (Storage::disk('public')->exists($old_image)) {
            Storage::disk('public')->delete($old_image);
        }
    }

    return $path . '/' . $imageName;
}

function imageDeleteManager($old_image)
{
    if ($old_image && $old_image !== 'default.png') {
        if (Storage::disk('public')->exists($old_image)) {
            Storage::disk('public')->delete($old_image);
        }
    }
}

function imageShow($image)
{
    if ($image) {
        return Storage::disk('public')->exists($image) ? Storage::disk('public')->url($image) : '';
    }
}
