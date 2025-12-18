<?php

namespace App\Repositories;

use App\Models\Media;
use Arafat\LaravelRepository\Repository;
use Illuminate\http\UploadedFile;
use Illuminate\Http\Request;
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

    public static function storeByRequest(UploadedFile $file, string $path, ?string $type = null): Media
    {
        $path = Storage::disk('public')->put('/' . trim($path, '/'), $file);
        $extension = $file->extension();
        if (! $type) {
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

    public static function updateByRequest(UploadedFile $file, string $path, ?string $type = null, Media $media): Media
    {
        $path = Storage::disk('public')->put('/' . trim($path, '/'), $file);
        $extension = $file->extension();
        if (! $type) {
            $type = in_array($extension, ['jpeg', 'jpg', 'png', 'gif', 'svg', 'webp']) ? 'image' : $extension;
        }

        if (Storage::exists($media->src)) {
            Storage::delete($media->src);
        }

        $media->update([
            'type' => $type,
            'src' => $path,
            'name' => $file->getClientOriginalName(),
            'extension' => $extension,
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
