<?php

namespace App\Controller\API\BlogPost;

use App\Entity\BlogPost;
use App\Form\BlogPostType;
use App\Service\BlogPost\BlogPostProcessorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Trait\FormSubmitTrait;
use App\Trait\SuccessResponseTrait;
use App\Trait\ErrorResponseTrait;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/api/blogpost', name: 'api_blogpost_create', methods: ['POST'])]
class CreateBlogPostController extends AbstractController
{
    use FormSubmitTrait;
    use SuccessResponseTrait;
    use ErrorResponseTrait;
    public function __invoke(Request $request, BlogPostProcessorInterface $blogPostProcessor): Response
    {
        $blogPost = new BlogPost();
        $form = $this->createForm(BlogPostType::class, $blogPost);
        $this->submitFormWithRequestData($form, $request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('featuredImage')->getData();
            if (!$imageFile instanceof UploadedFile) {
                return $this->errorJson(
                    'You Must Provide Featured Image for BlogPost'
                );
            }
            $blogPostProcessor->processBlogPost($blogPost, $imageFile);
            return $this->successJson(
                ['blogPostId' => $blogPost->getId()]
            );
        }
        return $this->errorJson(
            (string)$form->getErrors(true)
        );
    }
}
