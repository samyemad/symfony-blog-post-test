<?php

namespace App\Service\Image;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface ImageUploaderInterface
{
    public function upload(UploadedFile $file): string;
}
