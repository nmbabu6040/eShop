<?php

namespace App\Repositories;

use App\Models\Media;
use Arafat\LaravelRepository\Repository;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MediaRepository extends Repository
{
    /**
     * base method
     *
     * @method model()
     */
    public static function model()
    {
        return Media::class;
    }

    /**
     * Store a media file in the database and file system.
     *
     * @param UploadedFile $file The file to store.
     * @param string $path The path to store the file in.
     * @param string|null $type The type of media to store. If null, the type will be automatically determined.
     * @return Media The stored media.
     */
    public static function storeByRequest(UploadedFile $file, string $path, ?string $type = null): Media
    {
        $path = Storage::disk('public')->put('/' . trim($path, '/'), $file);
        $extension = $file->extension();
        if (!$type) {
            $type = in_array($extension, ['jpeg', 'jpg', 'png', 'gif', 'svg', 'webp']) ? 'image' : $extension;
        }

        $media = self::create([
            'type' => $type,
            'src' => $path,
            'name' => $file->getClientOriginalName(),
            'extension' => $extension
        ]);

        return $media;
    }

    /**
     * Update a media file in the database and file system.
     *
     * @param UploadedFile $file The file to update.
     * @param string $path The path to update the file in.
     * @param string|null $type The type of media to update. If null, the type will be automatically determined.
     * @param Media $media The media to update.
     * @return Media The updated media.
     */
    public static function updateByRequest(UploadedFile $file, string $path, ?string $type = null, Media $media): Media
    {
        $path = Storage::disk('public')->put('/' . trim($path, '/'), $file);
        $extension = $file->extension();
        if (!$type) {
            $type = in_array($extension, ['jpeg', 'jpg', 'png', 'gif', 'svg', 'webp']) ? 'image' : $extension;
        }

        if (Storage::exists($media->src)) {
            Storage::delete($media->src);
        }

        $media->update([
            'type' => $type,
            'src' => $path,
            'name' => $file->getClientOriginalName(),
            'extension' => $extension
        ]);

        return $media;
    }

    public static function deleteByRequest(Media $media)
    {

        if (Storage::exists($media->src)) {
            Storage::delete($media->src);
        }

        $media->delete();
    }
}
