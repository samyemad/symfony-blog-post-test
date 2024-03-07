<?php

namespace App\Service\Image;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RequestStack;
use Exception;

class ImageUploader implements ImageUploaderInterface
{
    public function __construct(
        private readonly string $targetDirectory,
    ) {
    }

    /**
     * @throws Exception
     */
    public function upload(UploadedFile $file): string
    {
        $fileName = uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->targetDirectory, $fileName);
        } catch (FileException $e) {
            throw new Exception($e->getMessage());
        }
       return $fileName;
    }
}
