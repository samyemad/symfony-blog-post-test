<?php

namespace App\Service\BlogPost;

use App\Entity\BlogPost;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface BlogPostProcessorInterface
{
    public function processBlogPost(BlogPost $blogPost, UploadedFile $imageFile): void;
}
