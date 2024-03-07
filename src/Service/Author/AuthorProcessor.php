<?php

namespace App\Service\Author;

use App\Entity\Author;
use App\Service\Image\ImageUploaderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AuthorProcessor implements AuthorProcessorInterface
{
    public function __construct(private readonly EntityManagerInterface $entityManager, private readonly ImageUploaderInterface $imageUploader)
    {
    }

    public function processAuthor(Author $author, UploadedFile $imageFile): void
    {
        $imageFileName = $this->imageUploader->upload($imageFile);
        $author->setImage($imageFileName);
        // add event before add author
        $this->entityManager->persist($author);
        $this->entityManager->flush();
        // add event after add author
    }
}
