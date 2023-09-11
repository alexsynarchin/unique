<?php

namespace App\Services;

use Spatie\MediaLibrary\Conversions\Conversion;
use Spatie\MediaLibrary\Conversions\ConversionFileNamer;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UniqueConversionFileNamer extends ConversionFileNamer
{
    public function getFileName(Conversion $conversion, Media $media): string
    {
        $fileName = pathinfo($media->file_name, PATHINFO_FILENAME);

        return "{$fileName}";
    }
}
