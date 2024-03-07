<?php

namespace App\Service\BlogPost;

use App\Entity\BlogPost;
use App\Service\Image\ImageUploaderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BlogPostProcessor implements BlogPostProcessorInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly  ImageUploaderInterface $imageUploader
    ) {
    }

    public function processBlogPost(BlogPost $blogPost, UploadedFile $imageFile): void
    {
        $imageFileName = $this->imageUploader->upload($imageFile);
        $blogPost->setFeaturedImage($imageFileName);
        $this->entityManager->persist($blogPost);
        $this->entityManager->flush();
    }
}
