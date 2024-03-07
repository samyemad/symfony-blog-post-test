<?php

namespace App\Service\Author;

use App\Entity\Author;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface AuthorProcessorInterface
{
    public function processAuthor(Author $author, UploadedFile $imageFile): void;
}
