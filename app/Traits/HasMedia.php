<?php

namespace App\Traits;

use App\Models\MediaFile;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasMedia
{
    /**
     * Get all media files associated with the model.
     */
    public function mediaFiles(): MorphMany
    {
        return $this->morphMany(MediaFile::class, 'mediable');
    }

    /**
     * Get the primary image media file associated with the model.
     */
    public function mediaFile(): MorphOne
    {
        return $this->morphOne(MediaFile::class, 'mediable')
            ->where('collection', 'image');
    }

    /**
     * Get the URL of the primary image from media_files.
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->mediaFile?->url;
    }

    /**
     * Store or replace the image in media_files for this model.
     */
    public function syncMediaFile(UploadedFile $file, string $directory, string $collection = 'image', string $disk = 'public'): MediaFile
    {
        $this->deleteMediaFiles($collection);

        $path = $file->store($directory, $disk);

        return $this->mediaFiles()->create([
            'disk' => $disk,
            'path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'collection' => $collection,
        ]);
    }

    /**
     * Delete existing media files for the given collection from storage and database.
     */
    public function deleteMediaFiles(string $collection = 'image'): void
    {
        $existingMedia = $this->mediaFiles()
            ->where('collection', $collection)
            ->get();

        foreach ($existingMedia as $media) {
            $disk = $media->disk ?: 'public';

            if ($media->path && Storage::disk($disk)->exists($media->path)) {
                Storage::disk($disk)->delete($media->path);
            }

            $media->delete();
        }
    }
}
