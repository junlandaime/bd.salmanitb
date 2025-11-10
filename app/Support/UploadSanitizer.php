<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadSanitizer
{
    /**
     * Store an uploaded file using a sanitized, randomised filename.
     */
    public static function store(UploadedFile $file, string $directory, string $disk = 'public', array $allowedMimeTypes = []): string
    {
        if (! $file->isValid()) {
            throw new \RuntimeException('Uploaded file is not valid.');
        }

        if ($allowedMimeTypes !== []) {
            self::assertAllowedMime($file, $allowedMimeTypes);
        }

        $directory = collect(explode('/', $directory))
            ->filter()
            ->map(fn(string $segment) => trim($segment))
            ->implode('/');

        $directory = trim($directory, '/');

        $extension = strtolower($file->guessExtension() ?: $file->getClientOriginalExtension() ?: 'bin');
        $extension = preg_replace('/[^a-z0-9]+/i', '', $extension) ?: 'bin';

        $filename = Str::uuid()->toString();

        Storage::disk($disk)->makeDirectory($directory);

        return $file->storeAs($directory, $filename . '.' . $extension, $disk);
    }

    protected static function assertAllowedMime(UploadedFile $file, array $allowedMimeTypes): void
    {
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $detectedMime = $finfo->file($file->getRealPath()) ?: $file->getMimeType();

        if (! in_array($detectedMime, $allowedMimeTypes, true)) {
            throw new \RuntimeException('Uploaded file type is not allowed.');
        }
    }
}
